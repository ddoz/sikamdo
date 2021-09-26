<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,300,400,500,700,900" rel="stylesheet">

    <title>SIKAMDO LAMPUNG UTARA</title>
<!--
SOFTY PINKO
https://templatemo.com/tm-535-softy-pinko
-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{url('assets/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{url('assets/assets/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{url('assets/assets/css/templatemo-softy-pinko.css')}}">

    </head>
    
    <body>
    
    <!-- ***** Preloader Start ***** -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    
    
    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="#" class="logo">
                            <img width="30" src="{{url('assets/assets/images/logo.png')}}" alt="SIKAMDO LAMPUNG TENGAH"/>
                            SIKAMDO LAMPUNG UTARA
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{url('')}}" class="{{($link=='beranda')?'active':''}}">Beranda</a></li>
                            <li><a href="{{url('tentang')}}" class="{{($link=='tentang')?'active':''}}">Tentang</a></li>
                            <li><a href="{{url('daftar_media')}}" class="{{($link=='daftar')?'active':''}}">Daftar Media</a></li>
                            <li><a href="{{url('faq')}}" class="{{($link=='faq')?'active':''}}">FAQ</a></li>
                            <li><a href="{{url('bantuan')}}" class="{{($link=='bantuan')?'active':''}}">Bantuan</a></li>
                            <li><a href="{{url('survey')}}" class="{{($link=='survey')?'active':''}}">Survey</a></li>
                            <li><a href="{{url('login')}}" class="{{($link=='signin')?'active':''}}">Sign In</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Welcome Area Start ***** -->
    @yield('welcome-area')
    <!-- ***** Welcome Area End ***** -->

    
    @yield('content')
    
    
    <!-- ***** Footer Start ***** -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <ul class="social">
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="copyright">Copyright &copy; 2021</p>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- jQuery -->
    <script src="{{url('assets/assets/js/jquery-2.1.0.min.js')}}"></script>

    <!-- Bootstrap -->
    <script src="{{url('assets/assets/js/popper.js')}}"></script>
    <script src="{{url('assets/assets/js/bootstrap.min.js')}}"></script>

    <!-- Plugins -->
    <script src="{{url('assets/assets/js/scrollreveal.min.js')}}"></script>
    <script src="{{url('assets/assets/js/waypoints.min.js')}}"></script>
    <script src="{{url('assets/assets/js/jquery.counterup.min.js')}}"></script>
    <script src="{{url('assets/assets/js/imgfix.min.js')}}"></script> 
    
    <!-- Global Init -->
    <script src="{{url('assets/assets/js/custom.js')}}"></script>

  </body>
</html>