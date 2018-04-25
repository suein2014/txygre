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
                            <th>phrase</th>
                            <th >example</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($wordlists as $wordlist)
                              <tr>
                                  <td>{{ $wordlist->id}}</td>
                                  <td>{{ $wordlist->initial}}</td>
                                  <td>
                                    <!-- <a target="_blank" style="color:black" href="{{url('wordlist/'.$wordlist->id)}}">{{ $wordlist->word }}</a> -->
                                    <a  style="color:black" href="" data-toggle="modal" data-target="#{{$wordlist->word}}">
                                      {{$wordlist->word}}
                                    </a>
                                    @includeIf('wordlist.subview.word_modal')

                                  </td>
                                  <td>
                                    <a href="{{ url('admin/wordlists/'.$wordlist->id.'/edit?page='.$currentPage.'#'.$wordlist->id ) }}" class="btn btn-success btn-sm">编辑</a>
                                  </td>
                                  <td>{{ $wordlist->familiar }}</td>
                                  <td>{{ $wordlist->list_number }}</td>
                                  <td>{{ $wordlist->page_number }}</td>

                                  <td>
                                    @includeIf('wordlist.subview.show_contents')
                                  </td>

                                    @if( is_string($wordlist->phrase))
                                      <span style="color:grey"> {{ $wordlist->phrase }}</span>
                                    @else
                                    <p>
                                      <i style="color:green;font-size:16px;font-weight:bold">{{$wordlist->phrase->en}}</i>
                                      <br>
                                      {{$wordlist->phrase->zh}}...
                                    </p>

                                    @endif
                                  </td>
                                  <td>
                                    @if( is_string($wordlist->example))
                                      <span style="color:grey"> {{ $wordlist->example }}</span>
                                    @else
                                    <p>
                                      {{$wordlist->example->en}}<br>
                                      <i style="color:cadetblue">{{$wordlist->example->zh}}...</i>
                                    </p>
                                  </td>

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
