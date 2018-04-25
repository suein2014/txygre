@if( is_string($wordlist->example))
    <span style="color:grey"> {{ $wordlist->example }}</span>
@else
    @foreach ($wordlist->example as $lid => $ex)
      @if(!empty($showCount))
        @if ($lid >= $showCount)
          @break
        @endif
      @endif
      <p>
        {{$ex->en}}<br>
        <i style="color:cadetblue">{{$ex->zh}}</i>
      </p>
      <p></p>
    @endforeach
@endif
