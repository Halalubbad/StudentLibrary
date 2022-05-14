<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Verify Email</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assetAdmin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('assetAdmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assetAdmin/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('assetAdmin/plugins/toastr/toastr.min.css')}}">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="cms/index2.html" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">You are only one step a way from your account activation, activate your account now.
        </p>
        <form>
          <div class="row">
            <div class="col-12">
              <button type="button" onclick="performSendEmailVerification()" class="btn btn-primary btn-block">{{__('library.send_activation_email')}}</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{asset('assetAdmin/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('assetAdmin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('assetAdmin/dist/js/adminlte.min.js')}}"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="{{asset('assetAdmin/plugins/toastr/toastr.min.js')}}"></script>
  <script>
    function performSendEmailVerification() {
        axios.get('/edu/send-verification')
            .then(function (response) {
                console.log(response);
                toastr.success(response.data.message);
            })
            .catch(function (error) {
                console.log(error.response);
                toastr.error(error.response.data.message);
            });      
        }
  </script>
</body>

</html>