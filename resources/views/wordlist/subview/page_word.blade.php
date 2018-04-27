<!-- in  tr <- table <- div.card-body <- wordlist -->
<td>
  @if ($wordlist->familiar>5)
    <i style="color:{{$colors[$wordlist->familiar]}}" class="fas fa-star"></i>
    <a class="btn btn-outline-secondary btn"
     style="color:{{$colors[$wordlist->familiar]}}"
     href="{{ url('wordlist/'.$wordlist->id.'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id) }}">
  @else
    <a style="color:{{$colors[$wordlist->familiar]}}" href="{{ url('wordlist/'.$wordlist->id.'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id) }}">
  @endif
  <b>{{ $wordlist->word }}</b>
  </a>
  @if ( !empty($wordlist->contents=json_decode($wordlist->contents)) )
    <p><span style="color: black;">{{$wordlist->contents->phonitic}}</span></p>
  @endif
</td>

@if( $loopId %2 !=0)
  <td style="background-color: #E9F7EF">
@else
  <td style="background-color: #F5EEF8">
@endif

  @if(!empty($wordlist->contents))
    @includeIf('wordlist.subview.show_contents',['list'=>true])
  @endif
  <hr>
  @if(!empty($wordlist->example=json_decode($wordlist->example)))
    @includeIf('wordlist.subview.show_example',['showCount'=>'2'])
  @endif
</td>
