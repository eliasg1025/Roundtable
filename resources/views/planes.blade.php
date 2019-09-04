
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Roboto|Amatic+SC:700|Poppins" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>{{ config('app.name', 'Roundtable') }}  | Conectamos compradores de todo el mundo con alimentos peruanos 100% orgánicos y ecológicos</title>

      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito|Roboto|Amatic+SC:700|Poppins" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="shortcut icon" href="/img/logo/favicon.png" type="image/x-icon">

      <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.1/tiny-slider.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div id="app">
  <nav id="navbar" class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">

      <a class="navbar-brand" href="{{ url('/') }}" style="font-family: 'Amatic SC', cursive; font-size:25px;">
        <img src="/img/logo/logo-v2.png" width="30" height="30" class="d-inline-block align-top" alt="">
        {{ config('app.name', 'Roundtable') }}
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <!--eft Side Of Navbar-->
        <ul class="navbar-nav mr-auto">
          <li class="nav-item mr-3">
            <a href="" class="nav-link navbar-list__link">Empresas</a>
          </li>
          <li class="nav-item mr-3">
            <a href="{{ url('/planes') }}" class="nav-link navbar-list__link">Planes</a>
          </li>
          <li class="nav-item mr-3">
            <a href="" class="nav-link navbar-list__link">Contacto</a>
          </li>
        </ul>
        <!-- Center Side Of Navbar-->
        <a id="logo" href="{{ url('/') }}" class="logo-main">
          <span style="font-family: 'Amatic SC', cursive; font-size:25px;" class="logo-main-title d-none">Rountable</span>
          <img src="/img/logo/logo-v3.png" alt="" class="img-fluid">
        </a>
        <!-- Right Side Of Navbar-->
        <ul class="navbar-nav ml-auto">
          <!-- Authentication Links-->
          @guest
            <li class="nav-item">
              <a class="nav-link navbar-list__link" href="#" data-toggle="modal" data-target="#login" id="button_login">{{ __('Iniciar Sesion') }}</a>
            </li>
            @if (Route::has('register'))
              <li class="nav-item">
                <a class="nav-link navbar-list__link" href="#" data-toggle="modal" data-target="#login" id="button_register">{{ __('Registrate') }}</a>
              </li>
            @endif
          @else
            <li class="nav-item">
              <a href="{{ route('profile') }}" class="nav-link navbar-list__link">{{ Auth::user()->name }}</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();"
                class="nav-link navbar-list__link">
                Cerrar Sesión
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
              </form>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')
</div>

      <section class="banner" style="background-image: url('/img/slider/prueba.jpeg');  background-repeat: no-repeat; background-size: cover; background-position: center center;">
      <div class="mask rgba-black-light align-item-center">
          <div class="container">
              <div class="row">
                  <div class="contenido col-md-12 mb-4 white-text text-center">
                      <h1 class="title h1-reponsive white-text text-uppercase font-weight-bold mb-0 pt-md-5 pt-5"><strong>Rountable Perú</strong></h1>

                      <h5 class="subtitle text-uppercase mt-3 mb-4 white-text"><strong>La Rueda de Negocios Online de Productos Peruanos</strong></h5>
                  </div>
              </div>
          </div>
      </div>
  </section>
<!-- Empieza los cards-->
  <div class="box">
  <div class="container">
    <div class="row">

        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <div class="box-part text-center">

                      <img src="/img/tabla-precio/fondo_basico.jpg" aria-hidden="true">

          <div class="title">
            <h4>Free</h4>
          </div>

          <div class="text">
            <span>Información de lo que se ofrece</span>
          </div>

          <a href="#">Adquirir</a>

         </div>
      </div>

       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <div class="box-part text-center">

            <img src="/img/tabla-precio/fondo_premium.jpg" aria-hidden="true">

          <div class="title">
            <h4>Premium</h4>
          </div>

          <div class="text">
            <span>Información de lo que se ofrece</span>
          </div>

          <a href="#">Adquirir</a>

         </div>
      </div>

       <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

        <div class="box-part text-center">

                      <img src="/img/tabla-precio/fondo_basico.jpg" aria-hidden="true">

          <div class="title">
            <h4>Basic</h4>
          </div>

          <div class="text">
            <span>Información de lo que se ofrece</span>
          </div>

          <a href="#">Adquirir</a>

         </div>
      </div>
    </div>
  </div>
</div>
<page-footer></page-footer>
</body>

</html>

<script>
export default {

}
window.onscroll = () => {
	const nav = document.querySelector('#navbar');
	const logo = document.querySelector('#logo');

    if (window.scrollY <= 150) {
		nav.style = 'transition: all ease 1500ms;';
		logo.classList.add('logo-main');
		logo.classList.remove('small-logo-main');
    } else {
		nav.style = "background-color: #09122e; transition: all ease 1000ms;"
		logo.classList.add('small-logo-main');
		logo.classList.remove('logo-main');
    }
};

</script>

<style>
.banner {
height: 99vh;
    color: #f8fafc !important;
background-attachment: fixed;
position: relative;
}
@media (max-width: 578px) {
  .banner {
    height: 100vh;
    width: 100vmin;
  }
}

.banner:before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: #000;
  opacity: .2;
}

  .top-nav-collapse {
      background-color: #09122E !important;
  }

  .navbar:not(.top-nav-collapse) {
      background: transparent;
  }

  @media (max-width: 991px) {
      .navbar:not(.top-nav-collapse) {
          background: #09122E !important;
      }
  }

  .title {
  letter-spacing: 3px;
  font-family: 'Noto Sans TC', sans-serif;
  /* font-family: 'Amatic SC', cursive; */
  }

  .subtitle {
  letter-spacing: 2px;
  font-family: 'Nunito', sans-serif;
  }

  .hr-light {
      border-top: 3px solid #fff;
      width: 80px;
  }

  .contenido {
      margin-top: 200px;
  }

  nav.scroll {
      background-color: #09122E;
  }


  body{
        background: #eee;
    }
    span{
        font-size:15px;
    }

    .box{
      background-image: url('/img/fondo/latest-product-bg.png');
        padding:60px;
    }

    .box-part{
        width:348px;
        height: 530px;
        background:#FFF;
        border-radius:8px;
        padding:0px 0px;
        margin:30px 0px;

    }
    .container .box-part:hover{
      transform: translateY(-15px);
      box-shadow:0 12px 16px rgba(0,0,0,0.2);
    }
    .container .box-part img{
      width:348px;
      height: 230px;
      border-radius:8px;
        opacity: 0.9;

    }

    .text{
        margin:20px 0px;
    }

    .fa{
         color:#4183D7;
    }


  }
</style>
