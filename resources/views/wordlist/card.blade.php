@extends('layouts.app')

@section('content')
<table class="table  table-sm">
  <thead>
    <tr>
      <th>Type</th>
      <th>Card</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>
        <div class="card">
          <ul class="list-group">
            @foreach ($cardTypes as $cardType)
              @if( $type == $cardType)
                <li class="list-group-item active" >
              @else
                <li class="list-group-item" >
              @endif

              <div class="list">
                  <a href="{{ url('wordlist/card?type='.$cardType) }}"
                  style="text-decoration:none;color:black;font-weight:bold;" >
                      <h4>{{ucfirst($cardType)}}</h4>
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
            @if ($type=='alphabet')
              @foreach ($alphabet as $ab)
                <a class="btn btn-{{ $initial==$ab?'primary':'success'}}" role="button" href="{{ url('wordlist/card?type=alphabet&initial='.$ab) }}">
                {{$ab}}
                </a>
              @endforeach
            @endif

            @if ($type=='hard')
              @for($i=10;$i>0;$i--)
                <a class="btn btn-{{ $hard==$i?'primary':'success'}}" role="button" href="{{ url('wordlist/card?type=hard&hard='.$i) }}">
                H{{$i}}
                </a>
              @endfor
            @endif

            @if ($type=='list')
              @for($i=1;$i<51;$i++)
                <a class="btn btn-{{ $list_number==$i?'primary':'light'}}" role="button" href="{{ url('wordlist/card?type=list&list_number='.$i) }}">
                L{{$i}}
                </a>
              @endfor
            @endif

          </div>


          <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

            <a href="{{ url('wordlist/card?subtype=1&type='.$type.'&initial='.$initial.'&hard='.$hard.'&list_number='.$list_number) }}" class="btn btn-lg btn-{{$subType==0||$subType==1 ? 'warning':'light'}}">刷新</a>
            @if ($type!='random')
            <a href="{{ url('wordlist/card?subtype=2&type='.$type.'&initial='.$initial.'&hard='.$hard.'&list_number='.$list_number) }}" class="btn btn-lg btn-{{$subType==2 ? 'warning':'light'}}">随机刷新</a>
            @endif
            @if ($type=='list')
            <a href="{{ url('wordlist/card?subtype=3&type='.$type.'&hard='.$hard.'&list_number='.$list_number) }}" class="btn btn-lg btn-{{$subType==3 ? 'warning':'light'}}">生词刷新</a>
            @endif
            &nbsp;<span style="color:Grey">计数:{{$count}}</span>
            <table class="table table-sm" >
              <tr>
               @foreach ($wordlists as $loopId=>$wordlist)

                @if( ($loopId+1) == ($showColumn+1) ||  $loopId>$showColumn && $loopId%$showColumn == 0)
                </tr><tr>
                @endif

                <td id="cw{{$wordlist->id}}">
                    <!-- Button trigger modal -->
                    <button type="button" style="background-color:{{$wordlist->familiar>7?'floralwhite':($wordlist->familiar>4? 'lightblue':'honeydew')}};color:{{$wordlist->familiar>7? 'red':($wordlist->familiar>4 ? 'black':'grey')}}" class="btn btn-outline-secondary" data-toggle="modal" data-target="#{{$wordlist->word}}">
                      <span style="font-size:1.5em;"> {{$wordlist->word}} </span>
                    </button>
                    <button type="button" class="btn btn-light" onclick="hideWord({{$wordlist->id}})" >隐藏</button>

                    <!-- Modal Begin -->
                    @includeIf('wordlist.subview.word_modal')
                    <!-- Modal End -->
                </td>
            @endforeach
            </tr>
          </table>
        </div>
      </div>
    </div>
    </td>
  </tr>
  </tbody>
</table>

@endsection
