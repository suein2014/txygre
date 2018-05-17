<!-- in  tr <- table <- div.card-body <- wordlist -->
<td>
  <a href="{{ url('wordlist/'.$wordlist->id.'?page='.$currentPage.'&type='.$type.'#'.$wordlist->id) }}">
  <span style="font-size:15px;color:black">{{ $wordlist->word }}</span>
  </a>
  <!-- @if ( !empty($wordlist->contents=json_decode($wordlist->contents)) )
    <span style="font-size:10px;color: blue;">{{$wordlist->contents->phonitic}}</span>
  @endif -->

  <!-- <button style="color:grey" type="button" class="btn btn-light" onclick="hideWordline({{$wordlist->id}})" >隐藏</button>
  <a style="color: grey;" type="button" target="_blank" href="{{url('admin/wordlists/'.$wordlist->id.'/edit')}}">编辑</a> -->

</td>

@if( $loopId %2 !=0)
  <td style="background-color: #E9F7EF">
@else
  <td style="background-color: #F5EEF8">
@endif

  @if(!empty($wordlist->contents))
    @includeIf('wordlist.subview.show_contents',['list'=>true,'quicklearn'=>true])
  @endif
  <!-- <hr>
  @if(!empty($wordlist->example=json_decode($wordlist->example)))
    @includeIf('wordlist.subview.show_example',['showCount'=>'2'])
  @endif -->
</td>
