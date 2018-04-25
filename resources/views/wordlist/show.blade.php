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
            page: {{ $wordlist->page_number }} |  id:{{ $wordlist->id }}
        </p>
    </div>

    <div>
      @if( is_string($wordlist->contents))
        {!! $wordlist->contents !!}
      @else
          <span style="color: blue;">{{$wordlist->contents->phonitic}}</span>
          @if (count($wordlist->contents->explain) > 1 )
            <ol>
              @foreach ($wordlist->contents->explain as $exp)
                <li>{{$exp}}</li>
              @endforeach
            </ol>
          @else
            @foreach ($wordlist->contents->explain as $exp)
              <div> {{$exp}} </div>
            @endforeach
          @endif
      @endif
    </div>

    <hr>
    <h5>词组</h5>
    @if( is_string($wordlist->phrase))
        <span style="color:grey"> {{ $wordlist->phrase }}  </span>
    @else
        @if (is_array($wordlist->phrase))
          @foreach ($wordlist->phrase as $ph)
            <p>
              <i style="color:green;font-size:16px;font-weight:bold">{{$ph->en}}</i>
              <br>
              {{$ph->zh}}
            </p>
            <p></p>
          @endforeach
        @endif
    @endif

    <hr>
    <h5>例句</h5>
    @if( is_string($wordlist->example))
        <span style="color:grey"> {{ $wordlist->example }}</span>
    @else
        @foreach ($wordlist->example as $ex)
          <p>
            {{$ex->en}}<br>
            <i style="color:cadetblue">{{$ex->zh}}</i>
          </p>
          <p></p>
        @endforeach
    @endif


</div>
@endsection
