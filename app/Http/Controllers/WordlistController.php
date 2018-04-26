<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wordlist;

class WordlistController extends Controller
{

    protected $colors= [
      1=>'darkgrey','burlywood','darkseagreen','cadetblue','darkturquoise',
      'coral','darkgoldenrod','deeppink','darkorchid','red',
    ];

    protected $alphabet=[
      'A','B','C','D','E','F','G','H','I','J',
      'K','L','M','N','O','P','Q','R','S','T',
      'U','V','W','X','Y','Z',
    ];

    protected $pageCount=50;

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

    public function test()
    {
      list($contents,$phrase,$example) = $this->wordModel->getWordInfoTest();
      return view('wordlist/test',['phrase'=>$phrase,
            'contents'=>$contents,'example'=>$example]);
    }

    /*卡片页*/
    public function card(Request $request){
      $type = $request->has('type') ? $request->type : 'random';
      $initial = $request->has('initial') ? $request->initial : 'A';
      $listNumber = $request->has('list_number') ? $request->list_number : 1;
      $familiar = $request->has('hard') ? $request->hard : 10;

      $cardType=array('random','alphabet','hard','list');

      $showCount = 52;
      $showColumn=4;

      //库支持直接rand取 LOL
      if($type=="random"){
        $wordlists= Wordlist::orderByRaw('RAND()')->take($showCount)->get();
      }else{
        switch($type){
          case 'alphabet':
            $wordlists= Wordlist::where('initial',$initial); break;
          case 'hard':
            $wordlists= Wordlist::where('familiar',$familiar); break;
          case 'list':
            $wordlists= Wordlist::where('list_number',$listNumber); break;
        }
        $wordlists= $wordlists->orderByRaw('RAND()')->take($showCount)->get();
      }

      //遍历数组，闭包实现解码json_encode部分，如果是字符串解码为空则保留原串
      $wordlists = array_map(function($e){
        $e = (object)$e ;
        list($e->contents,$e->phrase,$e->example)
          = $this->wordModel->getJsonDecodeData(array($e->contents,$e->phrase,$e->example));
        return $e;
      },$wordlists->toArray());

      return view('wordlist/card',['showColumn'=>$showColumn,
        'initial'=>$initial,'list_number'=>$listNumber,
        'familiar'=>$familiar,'alphabet'=>$this->alphabet,
        'cardTypes'=>$cardType,'type'=>$type])
        ->withWordlists($wordlists);
    }






    /*乱序版*/
    public function list($listNumber,Request $request)
    {
      $type = $request->has('type') ? $request->type : 'list';
      $currentPage = $request->has('page') ? $request->page : 1;

      //default type 'list', will skip switch-clause
      $wordlist = Wordlist::where('list_number',$listNumber);
      switch($type){
        case 'list_desc':
          $wordlist = $wordlist->orderBy('id','desc'); break;
        case 'hard': //familiar desc
          $wordlist = $wordlist->orderBy('familiar','desc'); break;
        case 'hard_desc':
          $wordlist = $wordlist->orderBy('familiar'); break;
        case 'alphabet':
          $wordlist = $wordlist->orderBy('word'); break;
        case 'alphabet_desc':
          $wordlist = $wordlist->orderBy('word','desc'); break;
      }
      $wordlist = $wordlist->paginate($this->pageCount);

      return view('wordlist/list',['list_number'=>$listNumber,'type'=>$type,
          'colors'=>$this->colors,'currentPage'=>$currentPage])
          ->withWordlists($wordlist);
    }


    /*有序版*/
    public function olist($initial,Request $request)
    {
      $type = $request->has('type') ? $request->type : 'alphabet';
      $currentPage = $request->has('page') ? $request->page : 1;

      $wl = Wordlist::where('initial',$initial);
      switch($type){
        case 'alphabet':
            $wordlist = $wl->orderBy('word'); break;
        case 'alphabet_desc':
            $wordlist = $wl->orderBy('word','desc'); break;
        case 'hard':
            $wordlist = $wl->orderBy('familiar','desc'); break;
        case 'hard_desc':  //familiar desc
            $wordlist = $wl->orderBy('familiar'); break;
        case 'olist':
            $wordlist = $wl->orderBy('id'); break;
        case 'olist_desc':
            $wordlist = $wl->orderBy('id','desc');  break;
      }
      $wordlist = $wordlist->paginate($this->pageCount);

      return view('wordlist/olist',['initial'=>$initial,'type'=>$type,
          'colors'=>$this->colors,'currentPage'=>$currentPage,
          'alphabet'=>$this->alphabet])
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

        return view('wordlist/familiar',['hardLevel'=>$hardLevel,'type'=>$type,
          'currentPage'=>$currentPage,'colors'=>$this->colors,
          'alphabet'=>$this->alphabet])
          ->withWordlists($wordlist);
    }

    /*搜索框*/
    public function search(Request $request){
      $searchWord = $request->has('searchword') ? $request->searchword : '';
      $type = 'list';
      $currentPage = 1;

      $wordlist = Wordlist::where('word',$searchWord)->first();
      if (empty($wordlist)){
        return view('wordlist/noresult',['type'=>$type]);
      }

      list($wordlist->contents,$wordlist->phrase,$wordlist->example)
        = $this->wordModel->getJsonDecodeData(
          array($wordlist->contents,$wordlist->phrase,$wordlist->example));

      //需要抓Online Dict数据，（目前支持搜索后跟随入库）
      if( empty($wordlist->contents) || empty($wordlist->phrase) ||
          empty($wordlist->example) ) {

          list($contents,$phrase,$example) = $this->wordModel->getWordInfoFromOnlineDict($wordlist->word);

          //for Update DB
          $updateWordlist = Wordlist::find($wordlist->id);
          $updateWordlist->contents = $contents;
          $updateWordlist->phrase = $phrase;
          $updateWordlist->example = $example;
          $updateWordlist->save();

          // for Showing in Search page
          $wordlist->contents = json_decode($contents);
          $wordlist->phrase = json_decode($phrase);
          $wordlist->example = json_decode($example);
      }


      return view('wordlist/show',['type'=>$type,'colors'=>$this->colors,
              'currentPage'=>$currentPage])
              ->withWordlist($wordlist);

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

      return view('wordlist/show',['type'=>$type,'colors'=>$this->colors,
              'currentPage'=>$currentPage])
              ->withWordlist($wordlist);
    }





}
