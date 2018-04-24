<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use QL\QueryList;

class Wordlist extends Model
{
  
  //Test
  public function getWordInfoTest(){
    $htmlContents = file_get_contents(dirname(dirname(__FILE__)).'/tests/test.html');
    list($contents,$phrase,$example) = $this->getWordInfoByHtmlContents($htmlContents);
    return array(json_decode($contents),json_decode($phrase),json_decode($example));
  }



  /*从Online Dict抓取单词的 含义、美式发音、词组和例句*/
  public function getWordInfoFromOnlineDict($word){
    $url = "https://dict.eudic.net/dicts/en/".$word;
    $htmlContents = file_get_contents($url);
    return $this->getWordInfoByHtmlContents($htmlContents);

  }

  /*具体抽取方法 - 路由， 用QueryList库抽取html内容*/
  public function getWordInfoByHtmlContents($htmlContents){
    $contents = $this->getWordContents($htmlContents);
    $phrase = $this->getWordPhrase($htmlContents);
    $example = $this->getWordExample($htmlContents);
    return array($contents,$phrase,$example);
  }


  /*具体抽取方法 - 1.抽取单词含义和美式发音*/
  public function getWordContents($htmlContents){
    $ql = QueryList::html($htmlContents) ;
    /*匹配美式读音*/
    $phonitic = $ql->find('span.Phonitic:last')->html();
    /*匹配单词意思*/
    $explain = $ql->find('ol')->children('li')->htmls();
    $explain = array_map(function($e){return str_replace(array('<i>','</i>'),'',$e);},
              $explain->toArray()); //去掉数组里多余的i标签
    if(! isset($explain[0])){
      //重新抽取
      $explain = $ql->find('#ExpFCChild')->children('div.exp')->htmls();
      if(! isset($explain[0])){
          //正则匹配
          preg_match_all("/ExpFCChild(.*?)<\/div><\/div>(.*?)<\/div/",$htmlContents,$explain);
          if( !empty($explain[2]) ){
            $explain = $explain[2][0]; //得到一个串
            $explain = $this->execReplace($explain); //过滤无用标签
            if( strpos($explain,'<div')!==false ){
              //丢弃词义后面跟着的<div里的派生词
              list($explain,) = explode('<div',$explain);
            }
          }
          $explain = array($explain); //将正则匹配后处理得到的串包装为数组
      }
    }
    $contents = array('phonitic'=>$phonitic,'explain'=>$explain);
    return json_encode($contents);
  }


  /*具体抽取方法 - 2.抽取词组*/
  public function getWordPhrase($htmlContents){
    $phrase = QueryList::html($htmlContents)->find('#ExpSPECChild')->htmls();
    if(!empty($phrase[0])){
        $phrase = $this->execReplace($phrase[0],'phrase');
        //有两种结构：<p id="XX"><i>英语词组</i><br></p><div class="XX">中文翻译</div>
        //或 <p id="XX"><i>英语词组</i><br>中文翻译</p>
        if(strpos($phrase,'</div>')!==false){
          //此情况抛弃了只有p对的词组
          $phrase = str_replace('</p>','',$phrase);
          $phrase = explode('</div>',$phrase); //use this to sepearte total string
        }else{
          $phrase = explode('</p>',$phrase);
        }

        $insertPhrase = $this->filterWordInfo($phrase,'phrase');
    }
    $insertPhrase = !empty($insertPhrase) ? $insertPhrase : '查不到';
    return json_encode($insertPhrase);
  }



  /*具体抽取方法 - 3.抽取例句*/
  public function getWordExample($htmlContents){
    $example = QueryList::html($htmlContents)->find('div.content')->htmls();
    $insertExample = $this->filterWordInfo($example,'example');
    $insertExample = !empty($insertExample) ? $insertExample : '查不到';
    return json_encode($insertExample);
  }

  /**
   * 处理html片段的 路由
   * @param  array $source    待处理的数组，装着多个形似的html片段
   * @param  string $type     类别:是词组，例句还是什么等
   * @return array
   */
  public function filterWordInfo($source,$type){
    $exFilter = array(
        'phrase'=>array('sep_char'=>'<br>','max_count'=>20,'split'=>2,
              'type'=>'phrase'),
        'example'=>array('sep_char'=>'</p>','max_count'=>10,'split'=>3,
              'type'=>'example'),
    );
    list($sepChar,$maxCount,$split)=array_values($exFilter[$type]);
    return $this->wordInsertBase($source,$sepChar,$maxCount,$split,$type);
  }

  /**
   * 处理html片段的 具体方法
   * @param  array  $arr         待处理的数组，装着html片段
   * @param  string $sepChar     分隔符，将串里的英文和中文翻译分隔开
   * @param  int    $ArrMax      最大个数
   * @param  int    $sepCount    将串分割成数组时，过滤掉分歌后个数大于此数字的
   * @param  string $replaceType 当前处理的类别：词组、例句等
   * @param  string $replaceTo   要批量替换成的串
   * @return array               返回数组包含英文和对应中文翻译的对，[['en':'','zh':''],]
   */
  private function wordInsertBase($arr, $sepChar,$ArrMax,$sepCount,$replaceType='',$replaceTo=''){
    if( empty($arr) || empty($sepChar) || empty($ArrMax)  || empty($sepCount)) {
      return array();
    }
    $return = array();
    foreach($arr as $ar ){
      if(count($return) > $ArrMax){  break;  } //控制个数，以便不超过db字段规定的长度
      if($replaceType){
        $ar = $this->execReplace($ar,$replaceType,$replaceTo);//str_replace($replaceArr,$repTo,$ar);
      }
      $ar  = explode($sepChar,$ar); //分隔符分割英文中文
      if(count($ar)==$sepCount ){ //过滤html不是大多数结构的，嫌麻烦，不想细处理，直接丢掉
        $return[] = array('en'=>trim($ar[0]),'zh'=>trim($ar[1])); //English, Chinese
      }
    }
    return $return;
  }



  /*替换无关的html标签*/
  protected function execReplace($str,$type='contents',$replaceTo = ''){
    $toReplaceArr =array(
      'contents'=> array(
            '<script>initThumbnail()</script>',
            '<script>initThumbnail()</script><div class="exp">','<i>','</i>',
          ),
      'phrase'=>array(
            '<!--word-thumbnail-image-->',
            '<p id="phrase">','<i>','</i>','<div class="exp">',

      ),
      'example'=>array(
            '<p class="line">','<p class="exp">','<lj>','</lj>',
      ),
    );

    $toReplaceTypeArr = $toReplaceArr[$type];
    if(is_string($str) ){
      $str = str_replace($toReplaceTypeArr,$replaceTo,$str);
    }
    return $str;
  }


}
