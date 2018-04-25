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

                    <!-- Modal -->
                    <div class="modal fade" id="{{$wordlist->word}}" tabindex="-1" role="dialog" aria-labelledby="{{$wordlist->word}}label" aria-hidden="true">
                      <!-- <div class="modal-dialog modal-lg" role="document"> -->
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="{{$wordlist->word}}label" style="color:deeppink;">{{$wordlist->word}}</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              @if( empty($e = json_decode($wordlist->contents)) )
                                <!-- 兼容脏数据 -->
                                <div>{{ $wordlist->contents }}</div>
                              @else
                                <div>
                                  <span style="color: blue;">{{$e->phonitic}}</span>
                                  @if (count($e->explain) > 1 )
                                    <ol>
                                      @foreach ($e->explain as $exp)
                                        <li>{{$exp}}</li>
                                      @endforeach
                                    </ol>
                                  @else
                                    @foreach ($e->explain as $exp)
                                      <div> {{$exp}} </div>
                                    @endforeach
                                  @endif
                                </div>
                              @endif
                              <hr>
                              <div class="table-responsive">
                                <table class="table" >
                                  <thead>
                                    <tr>
                                      <th scope="col"> 词组</th>
                                      <th scope="col"> 例句</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <tr>
                                    <td class="border-right">
                                        @if( empty($f = json_decode($wordlist->phrase)))
                                          {{ $wordlist->phrase }}
                                        @elseif(is_array($f))
                                            @foreach ($f as $lid=> $ph)
                                                @if ($lid<3)
                                                  <p>
                                                    <i style="color:green;font-size:16px;font-weight:bold">{{$ph->en}}</i>
                                                    <br>
                                                    {{$ph->zh}}
                                                  </p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>

                                    <td>
                                        @if( empty($g = json_decode($wordlist->example)))
                                          {{ $wordlist->example }}
                                        @elseif(is_array($g))
                                            @foreach ($g as $lid=> $ph)
                                                @if ($lid<3)
                                                <p>
                                                  {{$ph->en}}<br>
                                                  <i style="color:cadetblue">{{$ph->zh}}</i>
                                                </p>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
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
