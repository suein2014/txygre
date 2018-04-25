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

    public function card(Request $request){
      $type = $request->has('type') ? $request->type : 'random';
      $initial = $request->has('initial') ? $request->initial : 'A';
      $listNumber = $request->has('list_number') ? $request->list_number : 1;
      $familiar = $request->has('hard') ? $request->hard : 10;

      $cardType=array('random','alphabet','hard','list');

      $showCount = 52;
      $showColumn=4;

      //库支持直接rand取 LOL
      switch($type){
        case 'random':
          $wordlists= Wordlist::orderByRaw('RAND()')->take($showCount)->get();
          break;
        case 'alphabet':
          $wordlists= Wordlist::where('initial',$initial)
            ->orderByRaw('RAND()')->take($showCount)->get();
          break;
        case 'hard':
          $wordlists= Wordlist::where('familiar',$familiar)
            ->orderByRaw('RAND()')->take($showCount)->get();
          break;
        case 'list':
          $wordlists= Wordlist::where('list_number',$listNumber)
            ->orderByRaw('RAND()')->take($showCount)->get();
          break;
      }

      //遍历数组，解码json_encode部分，如果是字符串解码为空则保留原串
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

      switch($type){
        case 'list':
          $wordlist = Wordlist::where('list_number',$listNumber)
            ->paginate($this->pageCount);
          break;
          case 'list_desc':
            $wordlist = Wordlist::where('list_number',$listNumber)
              ->orderBy('id','desc')
              ->paginate($this->pageCount);
            break;
        case 'hard':
          $wordlist = Wordlist::where('list_number',$listNumber)
            ->orderBy('familiar','desc')
            ->paginate($this->pageCount);
          break;
        case 'hard_desc':  //familiar desc
            $wordlist = Wordlist::where('list_number',$listNumber)
              ->orderBy('familiar')
              ->paginate($this->pageCount);
            break;
        case 'alphabet':
          $wordlist = Wordlist::where('list_number',$listNumber)
            ->orderBy('word')
            ->paginate($this->pageCount);
          break;
        case 'alphabet_desc':
          $wordlist = Wordlist::where('list_number',$listNumber)
            ->orderBy('word','desc')
            ->paginate($this->pageCount);
          break;
      }

      return view('wordlist/list',['list_number'=>$listNumber,'type'=>$type,
          'colors'=>$this->colors,'currentPage'=>$currentPage])
          ->withWordlists($wordlist);
    }

    /*有序版*/
    public function olist($initial,Request $request)
    {
      $type = $request->has('type') ? $request->type : 'alphabet';
      $currentPage = $request->has('page') ? $request->page : 1;

      switch($type){
        case 'alphabet':
            $wordlist = Wordlist::where('initial',$initial)
              ->orderBy('word')
              ->paginate($this->pageCount);
             break;
        case 'alphabet_desc':
            $wordlist = Wordlist::where('initial',$initial)
              ->orderBy('word','desc')
              ->paginate($this->pageCount);
            break;
        case 'hard':
            $wordlist = Wordlist::where('initial',$initial)
              ->orderBy('familiar','desc')
              ->paginate($this->pageCount);
            break;
        case 'hard_desc':  //familiar desc
            $wordlist = Wordlist::where('initial',$initial)
              ->orderBy('familiar')
              ->paginate($this->pageCount);
            break;
        case 'olist':
            $wordlist = Wordlist::where('initial',$initial)
                ->orderBy('id')
                 ->paginate($this->pageCount);
            break;
        case 'olist_desc':
            $wordlist = Wordlist::where('initial',$initial)
              ->orderBy('id','desc')
              ->paginate($this->pageCount);
            break;
      }

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

        switch($type){
          case 'alphabet':  //familiar desc
              $wordlist = Wordlist::where('familiar',$hardLevel)
                ->orderBy('word')
                ->paginate($this->pageCount);
              break;
          case 'alphabet_desc':
            $wordlist = Wordlist::where('familiar',$hardLevel)
              ->orderBy('word','desc')
              ->paginate($this->pageCount);
            break;
          case 'list':
            $wordlist = Wordlist::where('familiar',$hardLevel)
              ->orderBy('id')
              ->paginate($this->pageCount);
            break;
          case 'list_desc':
            $wordlist = Wordlist::where('familiar',$hardLevel)
              ->orderBy('id','desc')
              ->paginate($this->pageCount);
            break;
        }

      return view('wordlist/familiar',['hardLevel'=>$hardLevel,'type'=>$type,
          'currentPage'=>$currentPage,'colors'=>$this->colors,
          'alphabet'=>$this->alphabet])
          ->withWordlists($wordlist);
    }

    public function search(Request $request){
      $searchWord = $request->has('searchword') ? $request->searchword : '';

      $wordlist = Wordlist::where('word',$searchWord)->first();
      if($wordlist->contents){
        $wordlist->contents = json_decode($wordlist->contents);
      }

      if($wordlist->phrase){
        $wordlist->phrase = json_decode($wordlist->phrase);
      }
      if($wordlist->example){
        $wordlist->example = json_decode($wordlist->example);
      }

      //需要抓Online Dict数据，（目前支持搜索后跟随入库）
      if( empty($wordlist->contents) || empty($wordlist->phrase) ||
          empty($wordlist->example) ) {

          $wordModel = new Wordlist();
          list($contents,$phrase,$example) = $wordModel->getWordInfoFromOnlineDict($wordlist->word);

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

      $type = 'list';
      $currentPage = 1;
      return view('wordlist/show',['type'=>$type,'colors'=>$this->colors,
              'currentPage'=>$currentPage])
              ->withWordlist($wordlist);

    }



    public function show($id, Request $request)
    {
      $type = $request->has('type') ? $request->type : 'list';
      $currentPage = $request->has('page') ? $request->page : 1;

      $wordlist = Wordlist::findOrFail($id);

      if($wordlist->contents){
        $wordlist->contents = json_decode($wordlist->contents);
      }

      if($wordlist->phrase){
        $wordlist->phrase = json_decode($wordlist->phrase);
      }
      if($wordlist->example){
        $wordlist->example = json_decode($wordlist->example);
      }

 // var_dump($wordlist->contents);exit;
      if( empty($wordlist->contents) ||
          empty($wordlist->phrase) ||
          empty($wordlist->example) ) {

          $wordModel = new Wordlist();
          list($contents,$phrase,$example) = $wordModel->getWordInfoFromOnlineDict($wordlist->word);

          $wordlist->contents = $wordlist->contents ? $wordlist->contents : json_decode($contents);
          $wordlist->phrase = $wordlist->phrase ? $wordlist->phrase : json_decode($phrase);
          $wordlist->example = $wordlist->example ? $wordlist->example : json_decode($example);
      }

      return view('wordlist/show',['type'=>$type,'colors'=>$this->colors,
              'currentPage'=>$currentPage])
              ->withWordlist($wordlist);
    }





}
