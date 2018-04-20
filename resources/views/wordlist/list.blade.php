@extends('layouts.app')

@section('content')
  <!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> -->
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Wordlist</th>
                  <th>Words-{{$type}}</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <div class="card">
                    <ul class="list-group">
                        @for ($i=1; $i<51;$i++)
                          @if ($list_number==$i)
                            <li class="list-group-item active" >
                          @else
                            <li class="list-group-item">
                          @endif
                            <div class="list">
                                <a href="{{ url('wordlist/list/'.$i) }}"
                                style="text-decoration:none;color:black;font-weight:bold;" >
                                    <h4>Wordist  {{$i}}</h4>
                                </a>
                            </div>
                          </li>
                        @endfor
                    </ul>
                  </div>
                </td>
                <td>
                  <div class="card">
                    <div class="card-header">
                        排序:
                        <a class="btn btn-primary" role="button" href="{{ url('wordlist/card') }}">
                          card
                        </a>
                        <a class="btn btn-primary" role="button" href="{{ url('wordlist/list/'.$list_number) }}">
                          List {{$list_number}}
                        </a>
                        <a class="btn btn-primary" role="button" href="{{ url('wordlist/list/'.$list_number.'?type=list_desc')}}">
                          List {{$list_number}} Desc
                        </a>
                        <a class="btn btn-danger" role="button" href="{{ url('wordlist/list/'.$list_number.'?type=hard') }}">
                          Hard
                        </a>
                        <a class="btn btn-info" role="button" href="{{ url('wordlist/list/'.$list_number.'?type=hard_desc') }}">
                          Hard Desc
                        </a>
                        <a class="btn btn-success" role="button" href="{{ url('wordlist/list/'.$list_number.'?type=alphabet') }}">
                          Alphabet
                        </a>
                        <a class="btn btn-warning" role="button" href="{{ url('wordlist/list/'.$list_number.'?type=alphabet_desc') }}">
                          Alphabet Desc
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
                                    <th>Hard</th>
                                    <th>page</th>
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
                                         href="{{ url('wordlist/'.$wordlist->id.'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id) }}">
                                      @else
                                        <a style="color:{{$colors[$wordlist->familiar]}}" href="{{ url('wordlist/'.$wordlist->id.'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id) }}">
                                      @endif
                                      {{ $wordlist->word }}

                                      </a>

                                    </td>
                                    <td>{{ $wordlist->familiar }}</td>
                                    <td>{{ $wordlist->page_number  }}</td>
                                    <!-- <td>{!! $wordlist->contents !!}</td> -->

                                    <td>{{$wordlist->id}}</td>
                                </tr>
                                  @endforeach
                            <!-- <ol>
                                @foreach ($wordlists as $wordlist)
                                <li style="margin: 50px 0;">
                                    <div class="word">
                                        <a href="{{ url('wordlist/'.$wordlist->id) }}">
                                            <h4>{{ $wordlist->word }}</h4>
                                        </a>
                                    </div>
                                    <span>page:{{ $wordlist->page_number }}</span>
                                        <p>{{ $wordlist->contents }}</p>
                                </li>
                                @endforeach
                            </ol> -->
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
        <!-- </div>
    </div>
</div> -->
@endsection
