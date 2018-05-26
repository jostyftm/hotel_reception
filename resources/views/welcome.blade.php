<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hotel Costa rica</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    
    {{-- Fonts --}}
    <link rel="stylesheet" href="{{ asset('plugin/fontawesome/css/fontawesome-all.css') }}">

    <!-- Custom styles for this template -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-light bg-light static-top">
      <div class="container">
        <a class="navbar-brand" href="#">Hotel Costa Rica</a>
        <a class="nav-link btn btn-primary" href="{{ route('login') }}">Iniciar sesión</a>
    </div>
</nav>

<!-- Masthead -->
<header class="masthead text-white text-center">
  <div class="overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-xl-9 mx-auto">
        <h1 class="mb-5">
            Hotel Costa Rica, Su hogar fuera de casa!
        </h1>
    </div>
    <div class="col-md-10 col-lg-8 col-xl-7 mx-auto">
        
</div>
</div>
</div>
</header>


<!-- Image Showcases -->
<section class="showcase">
  <div class="container-fluid p-0">
    <div class="row no-gutters">

      <div class="col-lg-6 order-lg-2 text-white showcase-img" style="background-image: url('img/bg-showcase-1.jpg');"></div>
      <div class="col-lg-6 order-lg-1 my-auto showcase-text">
        <h2>Nuestros paquetes ofrecen</h2>
        <p class="lead mb-0">
        Cada una de nuestras habitaciones para huéspedes ofrece una gran variedad de comodidades y servicios dependiendo del tipo. Además de un gimnasio completo y opciones gastronómicas en las instalaciones, disfrutará de lo siguiente:
        <ul>
          <li>Acceso a Internet inalámbrica de alta velocidad</li>
          <li>Secador de pelo</li>
          <li>Plancha y tabla de planchar</li>
          <li>Televisión por cable</li>
        </ul>
      </p>
    </div>
</div>
<div class="row no-gutters">
  <div class="col-lg-6 text-white showcase-img" style="background-image: url('img/bg-showcase-2.jpg');"></div>
  <div class="col-lg-6 my-auto showcase-text">
    <h2></h2>
    <p class="lead mb-0">
  Ademas de tener un amplio espacio de recreacion especialmente para los  niños y jovenes menores de 18 años, contamos con uno de los mejores sistemas de seguridad y con esto vigilantes que patrullan cada determinado tiempo por los alrededores del hotel para que sienta plena seguridad
  </p>
</div>
</div>

</div>
</section>

<!-- Footer -->
<footer class="footer bg-light">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
    <p class="text-muted small mb-4 mb-lg-0">&copy; Todos los derechos reservados hotel costarica.</p>
</div>
<div class="col-lg-6 h-100 text-center text-lg-right my-auto">
</div>
</div>
</div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ asset('js/app.js') }}" defer></script>

</body>

</html>
