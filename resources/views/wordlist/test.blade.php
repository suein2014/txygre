@extends('layouts.app')

@section('content')

<div>
  <span style="color: blue;">{{$contents->phonitic}}</span>
  @if (count($contents->explane) > 1 )
    <ol>
      @foreach ($contents->explane as $ph)
        <li>{{$ph}}</li>
      @endforeach
    </ol>
  @else
    @foreach ($contents->explane as $ph)
      <div> {{$ph}} </div>
    @endforeach
  @endif
</div>


@endsection
