@if( is_string($wordlist->contents))
  {{ $wordlist->contents }}
@else
    <span style="color: blue;">{{$wordlist->contents->phonitic}}</span>
    @if (count($wordlist->contents->explain) > 1 )
      <ol>
        @foreach ($wordlist->contents->explain as $exp)
          <li>{!! html_entity_decode($exp) !!}</li>
        @endforeach
      </ol>
    @else
      @foreach ($wordlist->contents->explain as $exp)
        <div> {!! html_entity_decode($exp) !!} </div>
      @endforeach
    @endif
@endif
