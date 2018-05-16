<!-- in table <- div.card-body <- wordlist -->
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<div id="content">
  <div class="table-responsive">
    <table class="table table-striped table-sm" style="line-height:15px">
      <thead>
        <tr>
          <!-- <th>#</th> -->
          <th width="18%">word</th>
          <th width="82%">contents</th>
        </tr>
      </thead>
      <tbody>
          @foreach ($wordlists as $loopId=>$wordlist)
          <tr id="hwl{{$wordlist->id}}">
            <!-- <td>{{$loopId+1}}</td> -->
            @includeIf('wordlist.subview.page_word')
          </tr>
          @endforeach
      </tbody>
    </table>
    
  </div>
</div>
