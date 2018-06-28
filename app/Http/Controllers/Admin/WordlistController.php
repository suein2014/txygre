<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Wordlist;

class WordlistController extends Controller
{
    protected $fields = [
      'word' =>'',
      'familiar' =>10,
      'list_number' =>'',
      'page_number' =>'',
      'contents' =>'',
      'phrase' =>'',
      'example' => '',
    ];

    public function index(Request $request){
        $currentPage = $request->has('page') ? $request->page : 1;
        $pageCount = 15;
        $wordlists = Wordlist::orderBy('id','desc')->paginate($pageCount);
        $wordModel = new Wordlist();
        foreach($wordlists as $wordlist){
          list($wordlist->contents,$wordlist->phrase,$wordlist->example)
            = $wordModel->getJsonDecodeData(
              array($wordlist->contents,$wordlist->phrase,$wordlist->example));
        }

        return view('admin/wordlist/index',['colors'=>Wordlist::colors,
          'currentPage'=>$currentPage])->withWordlists($wordlists);
    }

    /*增功能-对应页面*/
    public function create(){
      return view('admin/wordlist/create');
    }

    /*编辑功能-对应页面*/
    public function edit($id,Request $request){
      $currentPage = $request->has('page') ? $request->page : 1;
      return view('admin/wordlist/edit',['currentPage'=>$currentPage])->withWordlist(Wordlist::findOrFail($id));
    }

    /*增-入库*/
    public function store(Request $request)
    {

        /*简易输入版，输入在一行上，*/
        $this->validate($request, [
          'wordinfo' => 'required',
        ]);
        $wordlist = new Wordlist;
        list($word,$familiar,$listNumber,$pageNumbber) = preg_split('[,|，]',$request->get('wordinfo'));
        $word = trim($word);
        $familiar =trim($familiar);
        $listNumber = trim($listNumber);
        $pageNumbber = trim($pageNumbber);

        if($word && is_numeric($familiar)&&is_numeric($listNumber)&&is_numeric($pageNumbber))
        {
           $wordlist->word = $word;
           $wordlist->initial = ucfirst(substr($word,0,1));
           $wordlist->familiar = $familiar;
           $wordlist->list_number = $listNumber;
           $wordlist->page_number = $pageNumbber;
           $wordlist->length = strlen($wordlist->word);


           if(empty($wordlist->contents) ||
               empty($wordlist->phrase) ||
               empty($wordlist->example) ){
             $wordModel = new Wordlist();
             list($contents,$phrase,$example) = $wordModel->getWordInfoFromOnlineDict($wordlist->word);
             $wordlist->contents = $wordlist->contents ? $wordlist->contents : $contents;
             $wordlist->phrase = $wordlist->phrase ? $wordlist->phrase : $phrase;
             $wordlist->example = $wordlist->example ? $wordlist->example : $example;
           }


           if ($wordlist->save()) {
               return redirect('admin/wordlists')->withSuccess('保存成功!');
           }
        }
        return redirect()->back()->withInput()->withErrors('保存失败！');


        /*详细版*/
        // $this->validate($request, [
        //     'word' => 'required|unique:wordlists|max:45',
        //     'familiar' => 'required',
        //     'list_number' => 'required',
        //     'page_number' => 'required',
        // ]);
        //
        // $wordlist = new Wordlist;
        // $wordlist->word = $request->get('word');
        // $wordlist->initial = ucfirst(substr($word,0,1));
        // $wordlist->familiar = $request->get('familiar');
        // $wordlist->list_number = $request->get('list_number');
        // $wordlist->page_number = $request->get('page_number');
        // $wordlist->contents = $request->get('contents');
        //
        //
        // if ($wordlist->save()) {
        //     return redirect('admin/wordlists')->withSuccess('保存成功!');
        // } else {
        //     return redirect()->back()->withInput()->withErrors('保存失败！');
        // }
    }


    /*编辑功能 - 入库*/
    public function update(Request $request,$id)
    {
        $currentPage = $request->has('page') ? $request->page : 1;
        $this->validate($request, [
            'word' => 'required',
            'familiar' => 'required',
            'list_number' => 'required',
            'page_number' => 'required',
        ]);

        $wordlist = Wordlist::findOrFail($id);
        //if(empty($wordlist->initial)){
        $wordlist->initial= ucfirst(substr($wordlist->word,0,1));
        $wordlist->length = strlen($wordlist->word);
        //}

        foreach (array_keys($this->fields) as $field) {
          $wordlist->$field = $request->get($field);
         }

         if(empty($wordlist->contents) ||
             empty($wordlist->phrase) ||
             empty($wordlist->example) ){
           $wordModel = new Wordlist();
           list($contents,$phrase,$example) = $wordModel->getWordInfoFromOnlineDict($wordlist->word);
           $wordlist->contents = $wordlist->contents ? $wordlist->contents : $contents;
           $wordlist->phrase = $wordlist->phrase ? $wordlist->phrase : $phrase;
           $wordlist->example = $wordlist->example ? $wordlist->example : $example;
         }

        if($wordlist->save())
          return  redirect('admin/wordlists?page='.$currentPage)->withSuccess('保存成功!');
        else{
          return redirect()->back()->withInput()->withErrors('保存失败！');
        }
    }

}
