@extends('layouts.app')

@section('content')
<table class="table table-striped table-sm table-hover">
  <thead>
    <tr>
      <th width="12%">Wordlist</th>
      <th width="88%">Words-{{$pathId}}-{{$type}}</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
      <div class="card">
        <ul class="list-group">
          @for ($i=3; $i<19;$i++)
            @if ($pathId==$i)
              <li class="list-group-item active" >
            @else
              <li class="list-group-item">
            @endif
              <div class="list">
                  <a href="{{ url('wordlist/length/'.$i) }}"
                  style="text-decoration:none;color:black;font-weight:bold;" >
                      <h4>{{$i}}个字母</h4>
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
            <a class="btn btn-danger" role="button" href="{{ url('wordlist/length/'.$pathId.'?type=alphabet') }}">
              Alphabet
            </a>
            <a class="btn btn-info" role="button" href="{{ url('wordlist/length/'.$pathId.'?type=alphabet_desc') }}">
              Alphabet Desc
            </a>
            <a class="btn btn-success" role="button" href="{{ url('wordlist/length/'.$pathId.'?type=list') }}">
              List
            </a>
            <a class="btn btn-info" role="button" href="{{ url('wordlist/length/'.$pathId.'?type=list_desc') }}">
              List Desc
            </a>
            <div style="float:right">{{$wordlists->appends(['type'=>$type])->links()}}</div>
            <br/>


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
