@extends('layouts.app')

@section('content')
  <!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8"> -->
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th width="13%"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                  <div class="card">
                    <ul class="list-group">
                    </ul>
                  </div>
                </td>
                <td>
                  <div class="card">
                    <div class="card-header">
                        @includeIf('wordlist.subview.hard_color')
                    </div>


                    <div class="card-body">
                          @includeIf('wordlist.subview.table_word')
                    </div>
                  </div>

                </td>
              </tr>
            </tbody>
          </table>
        <!-- </div>
    </div>
</div> -->
@endsection
