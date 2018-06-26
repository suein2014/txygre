<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{url('favicon.ico')}}">

    <title>{{ config('app.name', 'GRE Learning') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ url('css/mysidebar.css') }}" rel="stylesheet">
    <link href="{{ url('css/mysbacktop.css') }}" rel="stylesheet">
    <link href="{{ url('css/fontawesome-all.min.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light navbar-laravel" style="background-color:#A9DFBF;" >
            <div class="container-fluid">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="{{ url('/') }}">
                    {{ config('app.name', 'GRE Learning') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <form class="form-inline" action="{{url('wordlist/search')}}">
                  <input class="form-control mr-sm-2" name="searchword" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-dark my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                </form>
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
        </nav>

        <div class="container-fluid">
          <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
              <div class="sidebar-sticky">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    @if ( Request::path() == 'wordlist'
                      || substr(Request::path(),0,13) == 'wordlist/list'
                      || substr(Request::path(),0,14) == 'wordlist/olist'
                      || substr(Request::path(),0,17) == 'wordlist/familiar'
                      )
                      <a  style="font-size:25px" class="nav-link active" href="{{url('wordlist')}}">
                    @else
                      <a class="nav-link" href="{{url('wordlist')}}">
                    @endif
                      <span data-feather="wordlist"></span>
                      <i class="far fa-list-alt"></i>
                      Wordlist
                    </a>
                  </li>
                  <li class="nav-item">
                    @if ( substr(Request::path(),0,13) == 'wordlist/card')
                      <a style="font-size:20px" class="nav-link active" href="{{url('wordlist/card?type=list')}}">
                    @else
                      <a class="nav-link" href="{{url('wordlist/card?type=list')}}">
                    @endif
                      <span data-feather="wordlistcard"></span>
                      <i class="far fa-clipboard"></i>
                      Wordlistcard
                    </a>
                  </li>
                  <li class="nav-item">
                    @if ( substr(Request::path(),0,19) == 'wordlist/quicklearn')
                      <a style="font-size:20px" class="nav-link active" href="{{url('wordlist/quicklearn/1?type=list')}}">
                    @else
                      <a class="nav-link" href="{{url('wordlist/quicklearn/1?type=list')}}">
                    @endif
                      <span data-feather="wordlistquicklearn"></span>
                      <i class="fas fa-clipboard"></i>
                      QuickLearn
                    </a>
                  </li>
                  <li class="nav-item">
                    @if ( substr(Request::path(),0,13) == 'wordlist/test')
                      <a style="font-size:25px" class="nav-link active" href="{{url('wordlist/test')}}">
                    @else
                      <a class="nav-link" href="{{url('wordlist/test')}}">
                    @endif
                      <span data-feather="wordlisttest"></span>
                      <i class="fas fa-question"></i>
                      test
                    </a>
                  </li>
                  <!-- <li class="nav-item">
                    <a class="nav-link " href="#">
                      <span data-feather="read"></span>
                      Reading
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">
                      <span data-feather="listen"></span>
                      Listen
                    </a>
                  </li> -->
                </ul>
              </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                @yield('content')
            </main>
        </div>
    </div>
</body>

<script>
$(function(){
    $("a.arrow").eq(0).click(function(){
      $("html,body").animate({scrollTop :0}, 300);
      return false;
    });
    // $("a.arrow").eq(1).click(function(){
    //   $("html,body").animate({scrollTop : $(document).height()}, 300);
    //   return false;
    // });

});
  function hideWord($id){
     var $cwid = 'cw'+ $id;

    // $("#"+$cwid).hide(); //不保留物理空间
    document.getElementById($cwid).style.visibility="hidden"; //保留物理空间


  }

  function hideWordline($id){
     var $hwlid = 'hwl'+ $id;

     $("#"+$hwlid).hide(); //不保留物理空间
    //document.getElementById($hwlid).hide(); //保留物理空间
  }


</script>



</html>
