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
      $wordlists = Wordlist::orderBy('id','desc')->paginate(15);//paginate(10,['*'],'page',$currentPage);
      $showLength = 20;
      foreach($wordlists as $wordlist){
        // if(strlen($wordlist->contents) > $showLength){
        //    $wordlist->contents = substr($wordlist->contents,0,10).'...';
        // }
        if(strlen($wordlist->example) > $showLength){
           $wordlist->example = substr($wordlist->example,0,$showLength).'...';
        }
        if(strlen($wordlist->phrase) > $showLength){
           $wordlist->phrase = substr($wordlist->phrase,0,$showLength).'...';
        }
    }
      return view('admin/wordlist/index',['currentPage'=>$currentPage])->withWordlists($wordlists);
    }

    public function create(){
      return view('admin/wordlist/create');
    }

    public function edit($id,Request $request){
      $currentPage = $request->has('page') ? $request->page : 1;
      return view('admin/wordlist/edit',['currentPage'=>$currentPage])->withWordlist(Wordlist::findOrFail($id));
    }

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


           if(empty($wordlist->contents) ||
               empty($wordlist->phrase) ||
               empty($wordlist->example) ){
             $wordModel = new Wordlist();
             list($contents,$phrase,$example) = $wordModel->getWordInfoFromOnlineDict($wordlist->word);

             $phrase = str_replace('<p id="phrase">','<p id="phrase" style="color:green;font-size:16px;font-weight:bold">',$phrase);
             $example = str_replace('<p class="exp">','<p style="color:cadetblue">',$example);

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
        if(empty($wordlist->initial)){
          $wordlist->initial= ucfirst(substr($wordlist->word,0,1));
        }

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
