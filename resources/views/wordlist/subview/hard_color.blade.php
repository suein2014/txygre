<div style="float:left">
  Hard:
  @if(isset($path))
    @for($i=1;$i<11;$i++)
      <a type="button"
      href="{{url('wordlist/'.$path.'/'.$pathId.'?page='.$currentPage.'&type='.$type.'&hard='.$i)}}"
       class="btn-sm" style="color:{{$colors[$i]}}" >{{$i}}</a>
    @endfor
  @else
    @for($i=1;$i<11;$i++)
      <button class="btn-sm" style="background-color:{{$colors[$i]}}" disabled="disabled">{{$i}}</button>
    @endfor
  @endif
</div>
