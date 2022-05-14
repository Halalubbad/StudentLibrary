<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>Educenter| @yield('title')</title>

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="{{asset('asset/plugins/bootstrap/bootstrap.min.css')}}">
  <!-- slick slider -->
  <link rel="stylesheet" href="{{asset('asset/plugins/slick/slick.css')}}">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="{{asset('asset/plugins/themify-icons/themify-icons.css')}}">
  <!-- animation css -->
  <link rel="stylesheet" href="{{asset('asset/plugins/animate/animate.css')}}">
  <!-- aos -->
  <link rel="stylesheet" href="{{asset('asset/plugins/aos/aos.css')}}">
  <!-- venobox popup -->
  <link rel="stylesheet" href="{{asset('asset/plugins/venobox/venobox.css')}}">
  {{-- Toster --}}
  <link rel="stylesheet" href="{{asset('assetAdmin/plugins/toastr/toastr.min.css')}}">

  <!-- Main Stylesheet -->
  <link href="{{asset('asset/css/style.css')}}" rel="stylesheet">

  <!--Favicon-->
  <link rel="shortcut icon" href="{{asset('asset/images/favicon.png')}}" type="image/x-icon">
  <link rel="icon" href="{{asset('asset/images/favicon.png')}}" type="image/x-icon">

</head>

<body>
  <!-- preloader start -->
  <div class="preloader">
    <img src="{{asset('asset/images/preloader.gif')}}" alt="preloader">
  </div>
  <!-- preloader end -->

<!-- header -->
  <header class="fixed-top header">

    
    <div class="top-header py-2 bg-white">
      <div class="container">
        <div class="row no-gutters">
          <div class="col-lg-4 text-center text-lg-left">
            <a class="text-color mr-3" href="callto:+443003030266"><strong>CALL</strong> +44 300 303 0266</a>
          </div>
          <div class="col-lg-8 text-center text-lg-right">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href=" # " data-toggle="modal" data-target="#signupModal">
                  {{__('library.change_password')}}
                </a>
              </li>
              <li class="list-inline-item">
                <?php $user = Auth::user();?>
                <a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href=" {{route('user.edit',$user->id)}} ">
                  {{__('library.my_profile')}}
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- navbar -->
    <div class="navigation w-100">
      <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark p-0">
          <a class="navbar-brand" href="index.html"><img src="{{asset('asset/images/logo.png')}}" alt="logo"></a>
          <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto text-center">
              <li class="nav-item @yield('home_active') ">
                <a class="nav-link" href=" {{route('userHome.index')}} ">Home</a>
              </li>
              <li class="nav-item @yield('university_active')">
                <a class="nav-link" href=" {{route('universities.index')}} ">{{__('library.universities')}}</a>
              </li>
              <li class="nav-item @yield('faculity_active')">
                <a class="nav-link" href="{{route('faculities.index')}}">{{__('library.faculities')}}</a>
              </li>
              <li class="nav-item @yield('slide_active2')">
                <a class="nav-link" href="{{route('slides.index')}}"> {{__('library.slidies')}} </a>
              </li>
              <li class="nav-item @yield('slide_active')">
                <a class="nav-link" href="{{route('slides.create')}}">{{__('library.add_slide')}}</a>
              </li>
              <li class="nav-item @yield('logout_active')">
                <a class="nav-link" href="{{route('edu.logout')}}">LOGOUT</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </header>
<!-- /header -->
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content rounded-0 border-0 p-4">
        <div class="modal-header border-0">
          <h3>{{__('library.edit_password')}}</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
          <div class="login">
              <form class="row" id="create-form">
                  @csrf
                  <div class="col-12">
                      <input type="password" class="form-control mb-3" id="current_password" placeholder="{{__('library.current_password')}}">
                  </div>
                  <div class="col-12">
                      <input type="password" class="form-control mb-3" id="new_password" placeholder="{{__('library.new_password')}}">
                  </div>
                  <div class="col-12">
                      <input type="password" class="form-control mb-3" id="new_password_confirmation" placeholder="{{__('library.new_password_confirmation')}}">
                  </div>
                  <div class="col-12">
                      <button type="button" class="btn btn-primary" onclick="performStore()" >{{__('library.save')}}</button>
                  </div>
              </form>
          </div>
      </div>
      </div>
  </div>
</div>

   @yield('content')

<!-- footer -->
<footer>
  <!-- newsletter -->
  <!-- footer content -->
  <div class="footer bg-footer section border-bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-sm-8 mb-5 mb-lg-0">
          <!-- logo -->
          <a class="logo-footer" href="index.html"><img class="img-fluid mb-4" src="{{asset('asset/images/logo.png')}}" alt="logo"></a>
          <ul class="list-unstyled">
            <li class="mb-2">23621 15 Mile Rd #C104, Clinton MI, 48035, New York, USA</li>
            <li class="mb-2">+1 (2) 345 6789</li>
            <li class="mb-2">+1 (2) 345 6789</li>
            <li class="mb-2">contact@yourdomain.com</li>
          </ul>
        </div>
        <!-- company -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">COMPANY</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="about.html">About Us</a></li>
            <li class="mb-3"><a class="text-color" href="teacher.html">Our Teacher</a></li>
            <li class="mb-3"><a class="text-color" href="contact.html">Contact</a></li>
            <li class="mb-3"><a class="text-color" href="blog.html">Blog</a></li>
          </ul>
        </div>
        <!-- links -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">LINKS</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="courses.html">Courses</a></li>
            <li class="mb-3"><a class="text-color" href="event.html">Events</a></li>
            <li class="mb-3"><a class="text-color" href="gallary.html">Gallary</a></li>
            <li class="mb-3"><a class="text-color" href="faqs.html">FAQs</a></li>
          </ul>
        </div>
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">SUPPORT</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="#">Forums</a></li>
            <li class="mb-3"><a class="text-color" href="#">Documentation</a></li>
            <li class="mb-3"><a class="text-color" href="#">Language</a></li>
            <li class="mb-3"><a class="text-color" href="#">Release Status</a></li>
          </ul>
        </div>
        <!-- support -->
        <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-5 mb-md-0">
          <h4 class="text-white mb-5">RECOMMEND</h4>
          <ul class="list-unstyled">
            <li class="mb-3"><a class="text-color" href="#">WordPress</a></li>
            <li class="mb-3"><a class="text-color" href="#">LearnPress</a></li>
            <li class="mb-3"><a class="text-color" href="#">WooCommerce</a></li>
            <li class="mb-3"><a class="text-color" href="#">bbPress</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- copyright -->
  <div class="copyright py-4 bg-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-7 text-sm-left text-center">
          <p class="mb-0">Copyright
            <script>
              var CurrentYear = new Date().getFullYear()
              document.write(CurrentYear)
            </script> 
            © themefisher</p>
        </div>
        <div class="col-sm-5 text-sm-right text-center">
          <ul class="list-inline">
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-facebook text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-twitter-alt text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-linkedin text-primary"></i></a></li>
            <li class="list-inline-item"><a class="d-inline-block p-2" href="#"><i class="ti-instagram text-primary"></i></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- /footer -->

<!-- jQuery -->
<script src="{{asset('asset/plugins/jQuery/jquery.min.js')}}"></script>
<!-- Bootstrap JS -->
<script src="{{asset('asset/plugins/bootstrap/bootstrap.min.js')}}"></script>
<!-- slick slider -->
<script src="{{asset('asset/plugins/slick/slick.min.js')}}"></script>
<!-- aos -->
<script src="{{asset('asset/plugins/aos/aos.js')}}"></script>
<!-- venobox popup -->
<script src="{{asset('asset/plugins/venobox/venobox.min.js')}}"></script>
<!-- filter -->
<script src="{{asset('asset/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
<!-- google map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu5nZKbeK-WHQ70oqOWo-_4VmwOwKP9YQ"></script>
<script src="{{asset('asset/plugins/google-map/gmap.js')}}"></script>

<!-- Main Script -->
<script src="{{asset('asset/js/script.js')}}"></script>
{{-- Axios --}}
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
{{-- Toster --}}
<script src="{{asset('assetAdmin/plugins/toastr/toastr.min.js')}}"></script>

<script>
  function performStore() {
      // alert('Perform Store');
      // console.log('performStore');
      
      axios.put('/edu/update-password', {
          password: document.getElementById('current_password').value,
          new_password: document.getElementById('new_password').value,
          new_password_confirmation: document.getElementById('new_password_confirmation').value,
      })
      .then(function (response) {
          console.log(response);
          toastr.success(response.data.message);
          document.getElementById('create-form').reset();
      })
      .catch(function (error) {
          console.log(error.response);
          toastr.error(error.response.data.message);
      });
  }
</script>

@yield('scripts')

</body>
</html>