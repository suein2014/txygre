@if( is_string($wordlist->phrase))
    <span style="color:grey"> {{ $wordlist->phrase }}  </span>
@else
    @if (is_array($wordlist->phrase))
      @foreach ($wordlist->phrase as $lid => $ph)
        @if(!empty($showCount))
          @if ($lid >= $showCount)
            @break
          @endif
        @endif
        <p>
          <i style="color:green;font-size:16px;font-weight:bold">{{$ph->en}}</i>
          <br>
          {{$ph->zh}}
        </p>
        <p></p>
      @endforeach
    @endif
@endif
