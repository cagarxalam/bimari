<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Manajemen Aset</title>
    <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <!-- /.login-logo -->
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <img src="/img/logo.png" alt="logo" width="90">
          <h3>Sistem Informasi Manajemen Aset</h3>
        </div>
        <div class="card-body">
          <p class="login-box-msg" id="msg"></p>

          <form action="javascript:void(0)" method="post" id="auth">
            <div class="input-group mb-3">
              <input type="text" name="user" class="form-control" placeholder="User">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4 offset-8">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="/js/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="/js/adminlte.min.js"></script>
    <!-- jquery validation -->
    <script src="/js/jquery.validate.min.js"></script>
    <!-- page script -->
    <script>
      $('#auth').validate({
        rules: {
          user: {
            required: true,
          },
          password: {
            required: true,
          }
        },
        messages: {
          user: {
            required: "Silahkan masukkan username"
          },
          password: {
            required: "Silahkan masukkan password"
          }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        },
        submitHandler: function(data){
          var form = new FormData(data)
          $.ajax({
            url: 'auth/sessions',
            type: 'post',
            dataType: 'json',
            data: form,
            processData: false,
            contentType: false,
            success(a){
              if(a == 'cocok'){
                window.location.replace("/")
              } else {
                $("#msg").html(a)
                $("#auth").trigger("reset")
              }
            },
            error(e){
              console.log(e)
            }
          })
        }
      })
    </script>
  </body>
</html>
