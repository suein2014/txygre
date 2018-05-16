<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\DB;
use App\Wordlist;

class WordlistController extends Controller
{

    protected $alphabet=[
      'A','B','C','D','E','F','G','H','I','J',
      'K','L','M','N','O','P','Q','R','S','T',
      'U','V','W','X','Y','Z',
    ];

    protected $pageCount=10;

    protected $wordModel;




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->wordModel = new Wordlist();
        // $this->type=Request::request('type') ? ;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('wordlist',['alphabet'=>$this->alphabet]);
    }

    public function test(Request $request)
    {
      $word = $request->has('w') ? $request->w : 'china';

      // $this->wordModel->translate();

      list($write,$d) = $this->wordModel->translateByWord($word);
      var_dump($write);var_dump($d);exit;
      // return view('wordlist/test',['data'=>$data]);

      // list($contents,$phrase,$example) = $this->wordModel->getWordInfoTest();
      // return view('wordlist/test',['phrase'=>$phrase,
      //       'contents'=>$contents,'example'=>$example]);

    }

    /*卡片页*/
    public function card(Request $request){
      $type = $request->has('type') ? $request->type : 'random';
      $initial = $request->has('initial') ? $request->initial : 'A';
      $listNumber = $request->has('list_number') ? $request->list_number : 1;
      $hard = $request->has('hard') ? $request->hard : 10;
      $isRandom = $request->has('random') ? $request->random : 0;
      $listHard = $request->has('listhard') ? $request->listhard : 0;

      //Three types, 1=>'sort_by_word',2=>'refresh_randomly',3=>'filter_by_hard'. see in card templates.
      $subType = $request->has('subtype') ? $request->subtype : 0;

      $cardType=array('random','alphabet','hard','list');

      $showCount = 300;
      $showColumn=4;

      //库支持直接rand取 LOL
      if($type=="random"){
        $wordlists= Wordlist::orderByRaw('RAND()');
      }else{
          switch($type){
            case 'alphabet':
              $wordlists= Wordlist::where('initial',$initial); break;
            case 'hard':
              $wordlists= Wordlist::where('familiar',$hard); break;
            case 'list':
              $wordlists= Wordlist::where('list_number',$listNumber);
              if($subType==3){ // filter by hard
                $wordlists= $wordlists->where('familiar','>',7);
              }
              break;
          }
          if($subType==2){ //refresh randomly
            $wordlists= $wordlists->orderByRaw('RAND()');
          }else{
            $wordlists= $wordlists->orderBy('word');
          }
      }
      $count = $wordlists->count();
      $wordlists= $wordlists->take($showCount)->get();

      //遍历数组，闭包实现解码json_encode部分，如果是字符串解码为空则保留原串
      $wordlists = array_map(function($e){
        $e = (object)$e ;
        list($e->contents,$e->phrase,$e->example)
          = $this->wordModel->getJsonDecodeData(array($e->contents,$e->phrase,$e->example));
        return $e;
      },$wordlists->toArray());

      return view('wordlist/card',['showColumn'=>$showColumn,'count'=>$count,
        'initial'=>$initial,'list_number'=>$listNumber,
        'hard'=>$hard,'alphabet'=>$this->alphabet,'subType'=>$subType,
        'cardTypes'=>$cardType,'type'=>$type,'colors'=>WordList::colors])
        ->withWordlists($wordlists);
    }






    /*乱序版*/
    public function list($listNumber,Request $request)
    {
      $type = $request->has('type') ? $request->type : 'list'; //sort
      $currentPage = $request->has('page') ? $request->page : 1;
      $hardLevel = $request->has('hard') ? $request->hard : 0;

      //default type 'list', will skip switch-clause
      $wordlists = Wordlist::where('list_number',$listNumber);
      if($hardLevel>0){
        $wordlists = $wordlists->where('familiar',$hardLevel);
      }

      switch($type){
        case 'list_desc':
          $wordlists = $wordlists->orderBy('id','desc'); break;
        case 'hard': //familiar desc
          $wordlists = $wordlists->orderBy('familiar','desc'); break;
        case 'hard_desc':
          $wordlists = $wordlists->orderBy('familiar'); break;
        case 'alphabet':
          $wordlists = $wordlists->orderBy('word'); break;
        case 'alphabet_desc':
          $wordlists = $wordlists->orderBy('word','desc'); break;
      }
      $wordlists = $wordlists->paginate($this->pageCount);

      return view('wordlist/list',['pathId'=>$listNumber,'type'=>$type,
          'colors'=>WordList::colors,'currentPage'=>$currentPage,'path'=>'list',
          'hard'=>$hardLevel])
          ->withWordlists($wordlists);
    }


    /*有序版*/
    public function olist($initial,Request $request)
    {
      $type = $request->has('type') ? $request->type : 'alphabet';
      $currentPage = $request->has('page') ? $request->page : 1;
      $hardLevel = $request->has('hard') ? $request->hard : 0;

      $wordlists = Wordlist::where('initial',$initial);
      if($hardLevel>0){
        $wordlists = $wordlists->where('familiar',$hardLevel);
      }
      switch($type){
        case 'alphabet':
            $wordlist = $wordlists->orderBy('word'); break;
        case 'alphabet_desc':
            $wordlist = $wordlists->orderBy('word','desc'); break;
        case 'hard':
            $wordlist = $wordlists->orderBy('familiar','desc'); break;
        case 'hard_desc':  //familiar desc
            $wordlist = $wordlists->orderBy('familiar'); break;
        case 'olist':
            $wordlist = $wordlists->orderBy('id'); break;
        case 'olist_desc':
            $wordlist = $wordlists->orderBy('id','desc');  break;
      }
      $wordlist = $wordlist->paginate($this->pageCount);

      return view('wordlist/olist',['pathId'=>$initial,'type'=>$type,
          'colors'=>WordList::colors,'currentPage'=>$currentPage,
          'alphabet'=>$this->alphabet,'path'=>'olist','hard'=>$hardLevel])
          ->withWordlists($wordlist);

    }




      /*难度版*/
    public function familiar($hardLevel,Request $request)
    {
        $type = $request->has('type') ? $request->type : 'alphabet';
        $currentPage = $request->has('page') ? $request->page : 1;

        $wl = Wordlist::where('familiar',$hardLevel);
        switch($type){
          case 'alphabet':  //familiar desc
            $wordlist = $wl->orderBy('word'); break;
          case 'alphabet_desc':
            $wordlist = $wl->orderBy('word','desc'); break;
          case 'list':
            $wordlist = $wl->orderBy('id'); break;
          case 'list_desc':
            $wordlist = $wl->orderBy('id','desc'); break;
        }
        $wordlist = $wordlist->paginate($this->pageCount);

        return view('wordlist/familiar',['pathId'=>$hardLevel,'type'=>$type,
          'currentPage'=>$currentPage,'colors'=>WordList::colors,
          'alphabet'=>$this->alphabet])
          ->withWordlists($wordlist);
    }

    /*搜索框*/
    public function search(Request $request){
      $searchWord = $request->has('searchword') ? $request->searchword : '';
      $type = 'list';
      $currentPage = 1;

      $strType= $this->wordModel->getStrType($searchWord);
      if($strType=='en'){
        $wordlist = Wordlist::where('word','LIKE','%'.$searchWord.'%')->get();
      }elseif($strType=='zh'){
        //搜索中文
        // 1. 去掉转成json串后自动加的""双引号,
        // 2. 中文为形如\u...的格式，将\替换为_(通配符)，,要不然mysql需转义需写为一模一样才能匹配
       $searchWord = str_replace('\\','_',trim(json_encode($searchWord), '"'));
       $wordlist = Wordlist::where('contents','LIKE','%'.$searchWord.'%')->get();
      }

      if ($wordlist->isEmpty()){
        return view('wordlist/noresult',['type'=>$type]);
      }

      // list($wordlist->contents,$wordlist->phrase,$wordlist->example)
      //   = $this->wordModel->getJsonDecodeData(
      //     array($wordlist->contents,$wordlist->phrase,$wordlist->example));

      // //需要抓Online Dict数据，（目前支持搜索后跟随入库）
      // if( empty($wordlist->contents) || empty($wordlist->phrase) ||
      //     empty($wordlist->example) ) {
      //
      //     list($contents,$phrase,$example) = $this->wordModel->getWordInfoFromOnlineDict($wordlist->word);
      //
      //     //for Update DB
      //     $updateWordlist = Wordlist::find($wordlist->id);
      //     $updateWordlist->contents = $contents;
      //     $updateWordlist->phrase = $phrase;
      //     $updateWordlist->example = $example;
      //     $updateWordlist->save();
      //
      //     // for Showing in Search page
      //     $wordlist->contents = json_decode($contents);
      //     $wordlist->phrase = json_decode($phrase);
      //     $wordlist->example = json_decode($example);
      // }


      return view('wordlist/search',['type'=>$type,'colors'=>WordList::colors,
              'currentPage'=>$currentPage])
              ->withWordlists($wordlist);

    }


    /*详情页*/
    public function show($id, Request $request)
    {
      $type = $request->has('type') ? $request->type : 'list';
      $currentPage = $request->has('page') ? $request->page : 1;

      $wordlist = Wordlist::findOrFail($id);

      list($wordlist->contents,$wordlist->phrase,$wordlist->example)
        = $this->wordModel->getJsonDecodeData(
          array($wordlist->contents,$wordlist->phrase,$wordlist->example));

      if( empty($wordlist->contents) ||
          empty($wordlist->phrase) ||
          empty($wordlist->example) ) {

          list($contents,$phrase,$example) = $this->wordModel->getWordInfoFromOnlineDict($wordlist->word);

          $wordlist->contents = $wordlist->contents ? $wordlist->contents : json_decode($contents);
          $wordlist->phrase = $wordlist->phrase ? $wordlist->phrase : json_decode($phrase);
          $wordlist->example = $wordlist->example ? $wordlist->example : json_decode($example);
      }

      return view('wordlist/show',['type'=>$type,'colors'=>WordList::colors,
              'currentPage'=>$currentPage])
              ->withWordlist($wordlist);
    }






}
