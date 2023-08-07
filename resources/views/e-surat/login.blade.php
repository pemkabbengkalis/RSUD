
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset(get_option('favicon'))}}">

    <title>Login RT</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('template/esurat/dist/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{asset('template/esurat/signin.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  </head>

  <body class="text-center">

    <form class="form-signin" action="{{URL::full()}}" method="post">
      @csrf
      <img class="mb-4 img-fluid" src="{{asset('logs.png')}}" alt="" >
      <h1 class="h3 mb-3 font-weight-normal">Login RT</h1>
      @if(session()->has('danger'))
      <div class="alert alert-danger">{{session('danger')}}</div>
      @endif
      <label for="inputEmail" class="sr-only">Nama Pengguna</label>
      <input type="text" name="username" id="inputEmail" class="form-control" placeholder="Masukkan Nama Penguna" autofocus>
      <label for="inputPassword" class="sr-only">Kata Sandi</label>
      <input type="password" name="password" class="form-control" placeholder="Masukkan Password">
 
      <button class="btn btn-md btn-primary btn-block" type="submit" name="login" value="true">Login <i class="fa fa-sign-in" aria-hidden="true"></i> </button>
      <a href="{{url('/')}}" class="btn btn-md btn-warning btn-block" type="submit" name="login" value="true">Kembali <i class="fa fa-undo" aria-hidden="true"></i> </a>

      <p class="mt-5 mb-3 text-muted">&copy; 2023 - {{get_option('nama_organisasi')}}</p>
    </form>
  </body>
</html>
