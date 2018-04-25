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
              <a class="btn btn-primary" role="button" href="{{ url('wordlist/card?type=alphabet&initial='.$ab) }}">
                {{$ab}}
              </a>
              @endforeach
            @endif

            @if ($type=='hard')
              @for($i=10;$i>0;$i--)
              <a class="btn btn-success" role="button" href="{{ url('wordlist/card?type=hard&hard='.$i) }}">
                H{{$i}}
              </a>
              @endfor
            @endif

            @if ($type=='list')
              @for($i=1;$i<51;$i++)
              <a class="btn btn-light" role="button" href="{{ url('wordlist/card?type=list&list_number='.$i) }}">
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

            <a href="{{ url('wordlist/card?type='.$type.'&initial='.$initial.'&hard='.$familiar.'&list_number='.$list_number) }}" class="btn btn-lg btn-warning">刷新</a>
            <table class="table table-sm" >
              <tr>
               @foreach ($wordlists as $loopId=>$wordlist)

                @if( ($loopId+1) == ($showColumn+1) ||  $loopId>$showColumn && $loopId%$showColumn == 0)
                </tr><tr>
                @endif

                <td id="cw{{$wordlist->id}}">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#{{$wordlist->word}}">
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
