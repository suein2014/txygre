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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
      return view('wordlist/test');
    }

    public function card(){
      $showCount = 52;
      $showColumn=4;
      // $all = Wordlist::all();
      // $totalCount = count($all);
      // $randNum = rand(1,$totalCount);
      // if ( $randNum >= ($totalCount-$showCount) ){
      //   $randNum = $totalCount-$showCount;
      // }elseif($randNum < $showCount){
      //   $randNum = 1;
      // }
      // $wordlist =  Wordlist::skip($randNum)->take($showCount)->get();

      //库支持直接rand取 LOL
      $wordlist = Wordlist::orderByRaw('RAND()')->take($showCount)->get();


      return view('wordlist/card',['showColumn'=>$showColumn])->withWordlists($wordlist);
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
      $type = $request->has('type') ? $request->type : 'olist';
      $currentPage = $request->has('page') ? $request->page : 1;

      switch($type){
        case 'olist':
          $wordlist = Wordlist::where('initial',$initial)->orderBy('word')
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
        case 'olist_desc':
          $wordlist = Wordlist::where('initial',$initial)
            ->orderBy('word','desc')
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
        $type = $request->has('type') ? $request->type : 'hard';
        $currentPage = $request->has('page') ? $request->page : 1;

        switch($type){
          case 'hard':
            $wordlist = Wordlist::where('familiar',$hardLevel)
              ->orderBy('familiar','desc')
              ->paginate($this->pageCount);
            break;
          case 'hard_desc':
            $wordlist = Wordlist::where('familiar',$hardLevel)
              ->orderBy('familiar')
              ->paginate($this->pageCount);
            break;
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




    public function show($id, Request $request)
    {
      $type = $request->has('type') ? $request->type : 'list';
      $currentPage = $request->has('page') ? $request->page : 1;

      $wordlist = Wordlist::findOrFail($id);
      if(empty($wordlist->contents)){
        $wordModel = new Wordlist();
        $wordlist->contents = $wordModel->getWordExplanationFromOnlineDict($wordlist->word);
      }

      return view('wordlist/show',['type'=>$type,'colors'=>$this->colors,
              'currentPage'=>$currentPage])
              ->withWordlist($wordlist);
    }





}