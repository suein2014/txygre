@extends('layouts.app')

@section('content')
  <!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> -->
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th width="12%">Wordlist</th>
                  <th width="88%">Words-{{$type}}</th>
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

                        @includeIf('wordlist.subview.hard_color')

                    </div>


                    <div class="card-body">
                          @includeIf('wordlist.subview.table_word')
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
