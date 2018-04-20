@extends('layouts.app')

@section('content')
<table class="table table-striped table-sm">

  <tbody>
  <tr>

  <td>
    <div class="card">
        <div class="card-header">Wordlist-有序</div>
        <div class="card-body">
          <div id="content2">
            <ul>
              @foreach($alphabet as $ab)
                <li style="margin: 50px 0;">
                    <div class="list">
                        <a href="{{ url('wordlist/olist/'.$ab) }}">
                            <h4>{{$ab}}</h4>
                        </a>
                    </div>
                </li>
                @endforeach
            </ul>
          </div>
        </div>
    </div>
  </td>
  <td>
  <div class="card">
      <div class="card-header">Wordlist-乱序(50单元)</div>
      <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success">
                  {{ session('status') }}
              </div>
          @endif

          <div id="content">
            <ul>
                @for ($i=1; $i<51;$i++)
                <li style="margin: 50px 0;">
                    <div class="list">
                        <a href="{{ url('wordlist/list/'.$i) }}">
                            <h4>Wordist  {{$i}}</h4>
                        </a>
                    </div>
                </li>
                @endfor
            </ul>
          </div>
      </div>
  </div>
</td>

<td>
<div class="card">
    <div class="card-header">Wordlist-难度</div>
    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <div id="content">
          <ul>
              @for ($i=10; $i>0;$i--)
              <li style="margin: 50px 0;">
                  <div class="list">
                      <a href="{{ url('wordlist/familiar/'.$i) }}">
                          <h4>Hard  {{$i}}</h4>
                      </a>
                  </div>
              </li>
              @endfor
          </ul>
        </div>
    </div>
</div>
</td>
</tr>
</tbody>
</table>

@endsection
