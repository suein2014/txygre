<!-- in  tr <- table <- div.card-body <- wordlist -->
<td>
  <a title="list:{{$wordlist->list_number}}|hard:{{$wordlist->familiar}}" href="{{ url('wordlist/'.$wordlist->id.'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id) }}">
  <!-- <a  style="color:black" href="" data-toggle="modal" data-target="#{{$wordlist->word}}"> -->
    <span style="font-size:15px;color:black">{{ $wordlist->word }}</span>
  </a>
  <!-- includeIf('wordlist.subview.word_modal') -->
</td>

@if( $loopId %2 !=0)
  <td style="background-color: #E9F7EF">
@else
  <td style="background-color: #F5EEF8">
@endif

  @if(!empty($wordlist->contents=(json_decode($wordlist->contents) ? json_decode($wordlist->contents) : $wordlist->contents ) ) )
    @includeIf('wordlist.subview.show_contents',['list'=>true,'quicklearn'=>true])
  @endif
  @if($wordlist->familiar > 6)
    <a class="arrow" style="right:10px;color:gainsboro" href="#"><span>顶部</span></a>
    <span style="color: gainsboro;">|</span>
      <a style="color: gainsboro;" type="button" target="_blank" href="{{url('admin/wordlists/'.$wordlist->id.'/edit')}}">编辑</a>
  @endif
</td>
