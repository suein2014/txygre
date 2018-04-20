<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wordlist extends Model
{
  /*从Online Dict抓取单词含义和美式发音，保留截取的富文本*/
  public function getWordExplanationFromOnlineDict($word){
    $url = "https://dict.eudic.net/dicts/en/".$word;
    $contents = file_get_contents($url);
    /*匹配词典解释*/
    preg_match("/<ol>(.*?)<\/ol>/",$contents,$explain);
    if(!empty($explain[0])){
      $explain = $explain[0];
    }else{
      preg_match_all("/ExpFCChild(.*?)<\/div><\/div>(.*?)<\/div>/",$contents,$explain);
      if(!empty($explain[2])){
        $explain = $explain[2][0];
      }else{
        $explain = '';
      }
    }

    $explain = !empty($explain) ? trim($explain) : '';
    $explain = $this->execReplace($explain);


    /*匹配读音*/
    preg_match_all("/<span class=\"Phonitic\">(.*?)<\/span>/",$contents,$phonitic);
    ///*without html<span> */
    //  if(!empty($phonitic[1][1])){
    //   $phonitic = $phonitic[1][1];
    // }elseif(!empty($phonitic[1][0])){
    //   $phonitic = $phonitic[1][0];
    // }

    /*with <span>*/
    if(!empty($phonitic[0][1])){
      $phonitic = $phonitic[0][1];
    }elseif(!empty($phonitic[0][0])){
      $phonitic = $phonitic[0][0];
    }else{
      $phonitic = '';
    }
    $phonitic =!empty($phonitic) ?
              preg_replace('/class="Phonitic"/', 'style="color:blue"', trim($phonitic)) : '';

    $return = $phonitic.$explain;
    return  $return ? $return : '查不到' ;
  }




  /*替换无关的富文本*/
  protected function execReplace($str){
    $toReplaceArr =array(
      '<script>initThumbnail()</script>',
      '<script>initThumbnail()</script><div class="exp">'
    );
    $replaceTo='';
    if(is_string($str) ){
      foreach($toReplaceArr as $toReplace){
        if( strpos($str,$toReplace) !== false){
          $str = str_replace($toReplace,$replaceTo,$str);
        }
      }
    }

    return $str;
  }


}
