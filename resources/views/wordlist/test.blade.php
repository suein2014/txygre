@extends('layouts.app')

@section('content')

<div>
  <span style="color: blue;">{{$contents->phonitic}}</span>
  @if (count($contents->explain) > 1 )
    <ol>
      @foreach ($contents->explain as $ph)
        <li>{{$ph}}</li>
      @endforeach
    </ol>
  @else
    @foreach ($contents->explain as $ph)
      <div> {{$ph}} </div>
    @endforeach
  @endif
</div>


@endsection
