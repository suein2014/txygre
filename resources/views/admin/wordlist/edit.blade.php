@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">修改单词内容</div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>修改失败</strong> 修改不符合要求<br><br>
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{ url('admin/wordlists/'.$wordlist->id).'?page='.$currentPage.'#'.$wordlist->id }}" method="POST">
                      <input name="_method" type="hidden" value="PUT">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <button class="btn btn-lg btn-info">修改</button>
                        <br>
                        <div>单词:</div>
                        <input type="text" name="word" class="form-control"
                            required="required" value="{{$wordlist->word}}">
                        <div>内容:</div>
                        <textarea name="contents" rows="5" class="form-control">

                        </textarea>
                        <div>词组:</div>
                        <textarea name="phrase" rows="5" class="form-control">

                        </textarea>
                        <div>例句:</div>
                        <textarea name="example" rows="5" class="form-control">
                          
                        </textarea>
                        <br>
                        <div>熟悉程度(10为最不熟悉):</div>
                        <select name="familiar" class="form-control">
                          @for ($i = 10; $i>0; $i--)
                              @if ( $wordlist->familiar == $i )
                                <option  selected="selected" value="{{ $i }}">{{ $i }}</option>
                              @else
                                <option  value="{{ $i }}">{{ $i }}</option>
                              @endif

                          @endfor
                        </select>
                        <div>单元:</div>
                        <input type="text" name="list_number" class="form-control"
                            required="required" value="{{$wordlist->list_number}}">
                        <div>页码:</div>
                        <input type="text" name="page_number" class="form-control"
                            required="required" value="{{$wordlist->page_number}}">
                        <br>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
