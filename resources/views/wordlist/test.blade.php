@extends('layouts.app')

@section('content')

@foreach ($phrase as $ph)
  <p>
    <i style="color:green;font-size:16px;font-weight:bold">{{$ph->en}}</i>
    <br>
    {{$ph->zh}}
  </p>
  <p></p>
@endforeach
<hr>
@foreach ($example as $ex)
  <p>
    {{$ex->en}}<br>
    <i style="color:cadetblue">{{$ex->zh}}</i>
  </p>
  <p></p>
@endforeach


@endsection
