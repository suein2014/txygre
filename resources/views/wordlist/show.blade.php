@extends('layouts.app')

@section('content')
<div id="content" style="padding: 50px;">

    <h4>
        <a href="{{url('wordlist/list/'.$wordlist->list_number).'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id}}"><< 返回列表</a>
    </h4>
    <div style="float:right">
      Hard:
      <button style="background-color:darkgrey" disabled="disabled">1</button>
      <button style="background-color:burlywood" disabled="disabled">2</button>
      <button style="background-color:darkseagreen" disabled="disabled">3</button>
      <button style="background-color:cadetblue" disabled="disabled">4</button>
      <button style="background-color:darkturquoise" disabled="disabled">5</button>
      <button style="background-color:coral" disabled="disabled">6</button>
      <button style="background-color:darkgoldenrod" disabled="disabled">7</button>
      <button style="background-color:deeppink" disabled="disabled">8</button>
      <button style="background-color:darkorchid" disabled="disabled">9</button>
      <button style="background-color:red" disabled="disabled">10</button>
    </div>

    <h1 style="text-align: center; margin-top: 50px;color:{{$colors[$wordlist->familiar]}} ">{{ $wordlist->word }}</h1>
    <hr>
    <div id="date" style="text-align: right;">
        {{ $wordlist->updated_at }}
    </div>
    <div id="content" style="margin: 20px;">
        <p>
            page: {{ $wordlist->page_number }} |  id:{{ $wordlist->id }} |
              <a style="color: grey;" type="button" target="_blank" href="{{url('admin/wordlists/'.$wordlist->id.'/edit')}}">编辑</a>
        </p>
    </div>

    <div>
      @include('wordlist.subview.show_contents')
    </div>

    <hr>
    <h5>词组</h5>
    @include('wordlist.subview.show_phrase')

    <hr>
    <h5>例句</h5>
    @include('wordlist.subview.show_example')


</div>
@endsection
