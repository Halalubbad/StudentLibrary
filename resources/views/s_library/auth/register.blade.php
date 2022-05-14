<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edu | Registration Page</title>

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
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form id="create_form">

        <div class="input-group mb-3">
          <input type="text" id="name" class="form-control" placeholder="Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label>{{__('library.university')}}</label>
          <select class="form-control" id="university_id">
              @foreach ($universities as $university)
              <option value="{{$university->id}}">{{$university->name}}</option>
              @endforeach
          </select>
      </div>
        <div class="form-group">
          <label for="image">{{ __('library.image') }}</label>
          <div class="input-group">
              <div class="custom-file">
                  <input type="file" class="custom-file-input" id="image">
                  <label class="custom-file-label" for="image">Choose file</label>
              </div>
          </div>
      </div>
        <div class="input-group mb-3">
          <input type="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        {{-- <div class="input-group mb-3">
          <input type="password" id="password_confirmation" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div> --}}
        <div class="row">
          
          <!-- /.col -->
          <div class="col-4">
            <button type="button" onclick="performStore()" class="btn btn-primary btn-block">{{__('library.regester')}}</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="{{asset('assetAdmin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('assetAdmin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assetAdmin/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('assetAdmin/plugins/toastr/toastr.min.js')}}"></script>

<script>
  function performStore(){

    var formData = new FormData();
    
    formData.append('name', document.getElementById('name').value);
    formData.append('email', document.getElementById('email').value);
    formData.append('image', document.getElementById('image').files[0]);
    formData.append('university_id', document.getElementById('university_id').value);
    formData.append('password', document.getElementById('password').value);

    axios.post('/edu/users', formData)
      .then(function(response) {
        console.log(response);
        toastr.success(response.data.message);
        document.getElementById('create-form').reset();
      })
     .catch(function(error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
      });
}
</script>

</body>
</html>
