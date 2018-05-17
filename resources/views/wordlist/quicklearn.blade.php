@extends('layouts.app')

@section('content')

  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th width="13%"></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
        <div class="card">
          <ul class="list-group">
              @for ($i=1; $i<51;$i++)
                @if ($pathId==$i)
                  <li class="list-group-item active" >
                @else
                  <li class="list-group-item">
                @endif
                  <div class="list">
                      <a href="{{ url('wordlist/quicklearn/'.$i) }}"
                      style="text-decoration:none;color:black;font-weight:bold;" >
                          <h4>Wordist  {{$i}}  {{ $pathId==$i ? '('.$count.')' : '' }} </h4>
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
              <!-- 排序:
              <a class="btn btn-primary" role="button" href="{{ url('wordlist/list/'.$pathId) }}">
                List {{$pathId}}
              </a>
              <a class="btn btn-primary" role="button" href="{{ url('wordlist/list/'.$pathId.'?type=list_desc')}}">
                List {{$pathId}} Desc
              </a>
              <a class="btn btn-danger" role="button" href="{{ url('wordlist/list/'.$pathId.'?type=hard') }}">
                Hard
              </a>
              <a class="btn btn-info" role="button" href="{{ url('wordlist/list/'.$pathId.'?type=hard_desc') }}">
                Hard Desc
              </a>
              <a class="btn btn-success" role="button" href="{{ url('wordlist/list/'.$pathId.'?type=alphabet') }}">
                Alphabet
              </a>
              <a class="btn btn-warning" role="button" href="{{ url('wordlist/list/'.$pathId.'?type=alphabet_desc') }}">
                Alphabet Desc
              </a> -->
              <div style="float:right">{{$wordlists->appends(['type'=>$type,'hard'=>$hard])->links()}}</div>
              <!-- <br/> -->

          </div>


          <div class="card-body">
                @includeIf('wordlist.subview.table_word',['wtype'=>'quicklist'])
          </div>
        </div>

      </td>
    </tr>
  </tbody>
</table>

@endsection
