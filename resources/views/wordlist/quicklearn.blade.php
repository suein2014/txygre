@extends('layouts.app')

@section('content')
<ul class="nav nav-tabs" style="font-size:20px">
  <li class="nav-item">
    <a  class="nav-link {{$type=='alphabet'?'active':''}}" style="{{$type=='alphabet'?'background-color: yellow;':'color:black'}}" href="{{url('wordlist/quicklearn/A?type=alphabet')}}">Alphabet</a>
  </li>
  <li class="nav-item">
    <a class="nav-link  {{$type=='list'?'active':''}}" style="{{$type=='list'?'background-color: yellow;':'color:black'}}"  href="{{url('wordlist/quicklearn/1?type=list')}}">List</a>
  </li>
</ul>
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <!-- <th width="13%">
       </th> -->
       <th>
       </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>
        <!-- <div class="card">
          <ul class="list-group">
            @if (!isset($type) || $type == 'list')
                  @for ($i=1; $i<51;$i++)
                    @if ($pathId==$i)
                      <li class="list-group-item active" >
                    @else
                      <li class="list-group-item">
                    @endif
                      <div class="list">
                          <a href="{{ url('wordlist/quicklearn/'.$i.'?type=list') }}"
                          style="text-decoration:none;color:black;font-weight:bold;" >
                              <h4>Wordist  {{$i}}  {{ $pathId==$i ? '('.$count.')' : '' }} </h4>
                          </a>
                      </div>
                    </li>
                  @endfor
            @else
                  @foreach ($alphabet as $ab)
                    @if ($pathId==$ab)
                      <li class="list-group-item active" >
                    @else
                      <li class="list-group-item">
                    @endif
                      <div class="list">
                          <a href="{{ url('wordlist/quicklearn/'.$ab.'?type=alphabet') }}"
                          style="text-decoration:none;color:black;font-weight:bold;" >
                              <h4>{{$ab}} {{ $pathId==$ab ? '('.$count.')' : '' }}</h4>
                          </a>
                      </div>
                    </li>
                  @endforeach
            @endif
          </ul>
        </div> -->
      <!-- </td>
      <td> -->
        <div class="card">
          <div class="card-header">
          @if ($type=='alphabet')
              @foreach ($alphabet as $ab)
                <a class="btn btn-{{ $pathId==$ab?'primary':'success'}}" role="button" href="{{ url('wordlist/quicklearn/'.$ab.'?type=alphabet') }}">
                {{$ab}}{{ $pathId==$ab ? '('.$count.')' : '' }}
                </a>
              @endforeach
              <div style="float:right">{{$wordlists->appends(['type'=>$type,'hard'=>$hard])->links()}}</div>
          @else
              @for($i=1;$i<51;$i++)
                <a class="btn btn-{{ $pathId==$i?'primary':'light'}}" role="button" href="{{ url('wordlist/quicklearn/'.$i.'?type=list') }}">
                L{{$i}}{{ $pathId==$i ? '('.$count.')' : '' }}
                </a>
              @endfor
          @endif
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
