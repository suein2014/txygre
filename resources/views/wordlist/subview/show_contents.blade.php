@if( is_string($wordlist->contents))
  {{ $wordlist->contents }}
@else
    @if (!isset($list))
      <span style="color: blue;">{{$wordlist->contents->phonitic}}</span>
    @endif
    @if (count($wordlist->contents->explain) > 1 )
      <ol>
        @foreach ($wordlist->contents->explain as $exp)
          @if (isset($list))
            <li style="font-weight:bold">
          @else
            <li>
          @endif
          {!! html_entity_decode($exp) !!}</li>
        @endforeach
      </ol>
    @else
      @foreach ($wordlist->contents->explain as $exp)
        @if (isset($list))
          <div style="font-weight:bold">
        @else
          <div>
        @endif
        {!! html_entity_decode($exp) !!} </div>
      @endforeach
    @endif
@endif
