
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset(get_option('favicon'))}}">

    <title>{{$title ?? 'Untilted'}}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('template/esurat/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('template/esurat/form-validation.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-touch-fullscreen" content="yes">
  <meta name="theme-color" content="#07c">
  <!-- home screen icon defaults - 48x48 -->
  <link rel="apple-touch-icon" href="https://kelurahankota.bengkaliskab.go.id/logs.png"/>
  <meta name="HandheldFriendly" content="True">
  <link rel="apple-touch-startup-image" href="https://kelurahankota.bengkaliskab.go.id/logs.png">
  <meta name="application-name" content="Simpel Kelurahan Kota">

  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="mb-4 img-fluid" src="{{asset('logs.png')}}" alt="">
        <center>
        <a href="{{url('/')}}" class="btn btn-primary btn-sm"><i class="fa fa-home" aria-hidden="true"></i> </a>
        @if(session()->has('rt'))
        <a href="{{url('rt')}}" class="btn btn-success btn-sm">Ruang RT.{{session('rtname')}} / RW.{{session('rwname')}}</a>
        <a href="{{url('logout')}}" class="btn btn-danger btn-sm">Logout <i class="fa fa-sign-out" aria-hidden="true"></i> </a>

        @else
        <a href="{{url('login')}}" class="btn btn-info btn-sm">Login RT <i class="fa fa-sign-in" aria-hidden="true"></i></a>

        @endif
      </center>
      </div>
    

@yield('content')
<a class="btn btn-md btn-danger btn-block text-white" href="https://{{get_option('site_url')}}"> <i class="fa fa-globe" aria-hidden="true"></i> Kembali ke Website Kelurahan Kota</a>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2023 - {{get_option('nama_organisasi')}}</p>
        <ul class="list-inline">
          <li class="list-inline-item"><a href="#">Tentang</a></li>
          <li class="list-inline-item"><a href="#">Ketentuan Layanan</a></li>
          <li class="list-inline-item"><a href="#">Kontak</a></li>
        </ul>
      </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script src="{{asset('template/esurat/assets/js/vendor/popper.min.js')}}"></script>
    <script src="{{asset('template/esurat/dist/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/esurat/assets/js/vendor/holder.min.js')}}"></script>


    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
