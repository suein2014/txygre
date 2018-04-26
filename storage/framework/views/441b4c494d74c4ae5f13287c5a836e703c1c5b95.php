<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <link rel="shortcut icon" href="<?php echo e(url('favicon.ico')); ?>">

    <title><?php echo e(config('app.name', 'GRE Learning')); ?></title>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('css/mysidebar.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(url('css/fontawesome-all.min.css')); ?>" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md sticky-top navbar-light navbar-laravel" style="background-color:#A9DFBF;" >
            <div class="container-fluid">
                <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo e(url('/')); ?>">
                    <?php echo e(config('app.name', 'GRE Learning')); ?>

                </a>

                <form class="form-inline" action="<?php echo e(url('wordlist/search')); ?>">
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
                        <?php if(auth()->guard()->guest()): ?>
                            <li><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('Login')); ?></a></li>
                            <li><a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('Register')); ?></a></li>
                        <?php else: ?>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <?php echo e(__('Logout')); ?>

                                    </a>

                                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                        <?php echo csrf_field(); ?>
                                    </form>
                                </div>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
        </nav>

        <div class="container-fluid">
          <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
              <div class="sidebar-sticky">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <?php if( Request::path() == 'wordlist'): ?>
                      <a class="nav-link active" href="<?php echo e(url('wordlist')); ?>">
                    <?php else: ?>
                      <a class="nav-link" href="<?php echo e(url('wordlist')); ?>">
                    <?php endif; ?>
                      <span data-feather="wordlist"></span>
                      <i class="far fa-list-alt"></i>
                      Wordlist
                    </a>
                  </li>
                  <li class="nav-item">
                    <?php if( Request::path() == 'wordlist/card'): ?>
                      <a class="nav-link active" href="<?php echo e(url('wordlist/card')); ?>">
                    <?php else: ?>
                      <a class="nav-link" href="<?php echo e(url('wordlist/card')); ?>">
                    <?php endif; ?>
                      <span data-feather="wordlistcard"></span>
                      <i class="far fa-clipboard"></i>
                      Wordlistcard
                    </a>
                  </li>
                  <li class="nav-item">
                    <?php if( Request::path() == 'wordlist/test'): ?>
                      <a class="nav-link active" href="<?php echo e(url('wordlist/test')); ?>">
                    <?php else: ?>
                      <a class="nav-link" href="<?php echo e(url('wordlist/test')); ?>">
                    <?php endif; ?>
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
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>
</body>

<script>
  // $function(){
  //   $('sortTab a').click(function e){
  //     e.preventDefault();
  //     $(this).tab('show');
  //   }
  // }
  //
  function hideWord($id){
     var $cwid = 'cw'+ $id;

    // $("#"+$cwid).hide(); //不保留物理空间
    document.getElementById($cwid).style.visibility="hidden"; //保留物理空间


  }


</script>



</html>
