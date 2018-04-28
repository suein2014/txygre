@extends('layouts.app')

@section('content')
<table class="table table-striped table-sm table-hover">
  <thead>
    <!-- <tr>
      <th width="7%">Wordlist</th>
      <th width="93%">Words-{{$type}}</th>
    </tr> -->
  </thead>
  <tbody>
    <tr>
      <td>
      <div class="card">
        <ul class="list-group">
            @foreach ($alphabet as $ab)
              @if ($pathId==$ab)
                <li class="list-group-item active" >
              @else
                <li class="list-group-item">
              @endif
                <div class="list">
                    <a href="{{ url('wordlist/olist/'.$ab) }}"
                    style="text-decoration:none;color:black;font-weight:bold;" >
                        <h4>{{$ab}}</h4>
                    </a>
                </div>
              </li>
            @endforeach
        </ul>
      </div>
    </td>
    <td>
      <div class="card">
        <div class="card-header">
            排序:
            <a class="btn btn-primary" role="button" href="{{ url('wordlist/olist/'.$pathId) }}">
              Alphabet {{$pathId}}
            </a>
            <a class="btn btn-warning" role="button" href="{{ url('wordlist/olist/'.$pathId.'?type=alphabet_desc') }}">
              Alphabet Desc
            </a>
            <a class="btn btn-danger" role="button" href="{{ url('wordlist/olist/'.$pathId.'?type=hard') }}">
              Hard
            </a>
            <a class="btn btn-info" role="button" href="{{ url('wordlist/olist/'.$pathId.'?type=hard_desc') }}">
              Hard Desc
            </a>
            <a class="btn btn-primary" role="button" href="{{ url('wordlist/olist/'.$pathId.'?type=olist') }}">
              Olist {{$pathId}}
            </a>
            <a class="btn btn-warning" role="button" href="{{ url('wordlist/olist/'.$pathId.'?type=olist_desc') }}">
              Olist Desc
            </a>
            <div style="float:right">{{$wordlists->appends(['type'=>$type,'hard'=>$hard])->links()}}</div>
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
@endsection
