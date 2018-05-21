@if( is_string($wordlist->contents))
  <span style="{{ !isset($quicklearn) ? '' :'font-size:12px;'}}"> {{ $wordlist->contents }} </span>
@else
    @if (!isset($list))
      <span style="color: blue;">{{$wordlist->contents->phonitic}}</span>
    @endif
    @if(!isset($quicklearn))
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
    @else
      <!-- For QuickLearn word -->
      @if($wordlist->familiar>6)
        @if (count($wordlist->contents->explain) > 1 )
            @foreach ($wordlist->contents->explain as $k => $exp)
              <span style="font-size:12px;">{{$k+1}}. {!! html_entity_decode($exp) !!}</span><br>
            @endforeach
        @else
            @foreach ($wordlist->contents->explain as $k => $exp)
              <span style="font-size:12px;">{{$exp}}</span>
            @endforeach
        @endif
        <span style="font-size:10px;color: blue;font-style:italic">{{$wordlist->contents->phonitic}}</span>
      @endif
    @endif


@endif
