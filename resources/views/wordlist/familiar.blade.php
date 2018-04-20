@extends('layouts.app')

@section('content')
<table class="table table-striped table-sm table-hover">
  <thead>
    <tr>
      <th>Wordlist</th>
      <th>Words-{{$hardLevel}}-{{$type}}</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
      <div class="card">
        <ul class="list-group">
          @for ($i=10; $i>0;$i--)
            @if ($hardLevel==$i)
              <li class="list-group-item active" >
            @else
              <li class="list-group-item">
            @endif
              <div class="list">
                  <a href="{{ url('wordlist/familiar/'.$i) }}"
                  style="text-decoration:none;color:black;font-weight:bold;" >
                      <h4>Hard  {{$i}}</h4>
                  </a>
              </div>
            </li>
          @endfor
      </ul>
        </ul>
      </div>
    </td>
    <td>
      <div class="card">
        <div class="card-header">
            排序:
            <a class="btn btn-primary" role="button" href="{{ url('wordlist/familiar/'.$hardLevel) }}">
              Hard {{$hardLevel}}
            </a>
            <a class="btn btn-warning" role="button" href="{{ url('wordlist/familiar/'.$hardLevel.'?type=hard_desc') }}">
              Hard Desc
            </a>
            <a class="btn btn-danger" role="button" href="{{ url('wordlist/familiar/'.$hardLevel.'?type=alphabet') }}">
              Alphabet
            </a>
            <a class="btn btn-info" role="button" href="{{ url('wordlist/familiar/'.$hardLevel.'?type=alphabet_desc') }}">
              Alphabet Desc
            </a>
            <a class="btn btn-success" role="button" href="{{ url('wordlist/familiar/'.$hardLevel.'?type=list') }}">
              List
            </a>
            <a class="btn btn-info" role="button" href="{{ url('wordlist/familiar/'.$hardLevel.'?type=list_desc') }}">
              List Desc
            </a>
            <div style="float:right">{{$wordlists->appends(['type'=>$type])->links()}}</div>
            <br/>
            <div style="float:left">
              Hard:
              <button class="btn-sm" style="background-color:darkgrey" disabled="disabled">1</button>
              <button class="btn-sm" style="background-color:burlywood" disabled="disabled">2</button>
              <button class="btn-sm" style="background-color:darkseagreen" disabled="disabled">3</button>
              <button class="btn-sm" style="background-color:cadetblue" disabled="disabled">4</button>
              <button class="btn-sm" style="background-color:darkturquoise" disabled="disabled">5</button>
              <button class="btn-sm" style="background-color:coral" disabled="disabled">6</button>
              <button class="btn-sm" style="background-color:darkgoldenrod" disabled="disabled">7</button>
              <button class="btn-sm" style="background-color:deeppink" disabled="disabled">8</button>
              <button class="btn-sm" style="background-color:darkorchid" disabled="disabled">9</button>
              <button class="btn-sm" style="background-color:red" disabled="disabled">10</button>
          </div>
        </div>


        <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif


              <div id="content">
                <div class="table-responsive">
                  <table class="table table-striped table-sm" style="line-height:15px">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>word</th>
                        <th>List</th>
                        <th>Page</th>
                        <!-- <th>contents</th> -->
                        <th>db_id</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($wordlists as $loopId=>$wordlist)
                      <tr>
                        <td>{{$loopId+1}}</td>
                        <td>
                          @if ($wordlist->familiar>5)
                            <a class="btn btn-outline-secondary btn-sm"
                             style="color:{{$colors[$wordlist->familiar]}}"
                             href="{{ url('wordlist/'.$wordlist->id) }}">
                          @else
                            <a style="color:{{$colors[$wordlist->familiar]}}" href="{{ url('wordlist/'.$wordlist->id) }}">
                          @endif
                          {{ $wordlist->word }}

                          </a>

                        </td>
                        <td>{{ $wordlist->list_number  }}</td>
                        <td>{{ $wordlist->page_number  }}</td>
                        <!-- <td>{!! $wordlist->contents !!}</td> -->

                        <td>{{$wordlist->id}}</td>
                    </tr>
                      @endforeach
                </tbody>
              </table>
              <div style="float:right">{{$wordlists->appends(['type'=>$type])->links()}}</div>
              </div>
            </div>

          </div>
        </div>
      </td>
    </tr>
  </tbody>
</table>
@endsection
