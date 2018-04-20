@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                  单词管理
                </div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <a href="{{ url('admin/wordlists/create') }}" class="btn btn-lg btn-primary">新增</a>
                    <div style="float:right">
                      {{$wordlists->links()}}
                     </div>

                    <div class="table-responsive">
                      <table class="table table-striped table-sm" >
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Initial</th>
                            <th>word</th>
                            <th>操作</th>
                            <th>familiar</th>
                            <th>list</th>
                            <th>page</th>
                            <th>contents</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($wordlists as $wordlist)
                              <tr>
                                  <td>{{ $wordlist->id}}</td>
                                  <td>{{ $wordlist->initial}}</td>
                                  <td>{{ $wordlist->word }}</td>
                                  <td>
                                    <a href="{{ url('admin/wordlists/'.$wordlist->id.'/edit?page='.$currentPage.'#'.$wordlist->id ) }}" class="btn btn-success btn-sm">编辑</a>
                                  </td>
                                  <td>{{ $wordlist->familiar }}</td>
                                  <td>{{ $wordlist->list_number }}</td>
                                  <td>{{ $wordlist->page_number }}</td>
                                  <td>{!! $wordlist->contents !!}</td>

                              <!--<form action="{{ url('admin/wordlists/'.$wordlist->id) }}" method="POST" style="display: inline;">
                                  {{ method_field('DELETE') }}
                                  {{ csrf_field() }}
                                  <button type="submit" class="btn btn-danger">删除</button>
                              </form> -->
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
