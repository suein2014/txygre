@extends('layouts.app')

@section('content')

<a href="{{ url('wordlist/card') }}" class="btn btn-lg btn-warning">刷新</a>
<table class="table table-sm" >

  <!-- <button type="button" class="btn btn-secondary" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus.">
    Popover on top
  </button> -->

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
</div>

  <!-- Modal -->
  <div class="modal fade" id="{{$wordlist->word}}" tabindex="-1" role="dialog" aria-labelledby="{{$wordlist->word}}label" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="{{$wordlist->word}}label" style="color:deeppink;">{{$wordlist->word}}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="color:green">
          {!! $wordlist->contents !!}
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>




</td>
@endforeach
</tr>
</table>

@endsection
