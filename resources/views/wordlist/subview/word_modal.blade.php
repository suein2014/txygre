<div class="modal fade" id="{{$wordlist->word}}" tabindex="-1" role="dialog" aria-labelledby="{{$wordlist->word}}label" aria-hidden="true">
  <!-- <div class="modal-dialog modal-lg" role="document"> -->
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="{{$wordlist->word}}label" style="color:deeppink;">
            <i style="color:{{$colors[$wordlist->familiar]}}" class="fas fa-star"></i>
            <span> {{$wordlist->word}} </span>
          </h4>
          &nbsp;&nbsp;&nbsp;
          @includeIf('wordlist.subview.hard_color')
          &nbsp;<span style="color:Grey"> Page:{{$wordlist->page_number}}</span>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div>
              @include('wordlist.subview.show_contents')
            </div>
            <hr>
            <div class="table-responsive">
              <table class="table" >
                <thead>
                  <tr>
                    <th scope="col"> 词组</th>
                    <th scope="col"> 例句</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border-right">
                      @include('wordlist.subview.show_phrase')
                    </td>
                    <td>
                      @include('wordlist.subview.show_example')
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            </div>
      </div>
    </div>
  </div>
</div>
