@if( is_string($wordlist->contents))
  {{ $wordlist->contents }}
@else
    <span style="color: blue;">{{$wordlist->contents->phonitic}}</span>
    @if (count($wordlist->contents->explain) > 1 )
      <ol>
        @foreach ($wordlist->contents->explain as $exp)
          <li>{{$exp}}</li>
        @endforeach
      </ol>
    @else
      @foreach ($wordlist->contents->explain as $exp)
        <div> {{$exp}} </div>
      @endforeach
    @endif
@endif
