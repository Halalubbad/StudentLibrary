@extends('s_library.parent')

@section('title', __('library.home'))

@section('home_active', 'active')
@section('university_active','@@university')
@section('faculity_active' , '@@faculity')
@section('slide_active' , '@@slide')
@section('logout_active' , '@@logout')

@section('content')

 <!-- preloader start -->
 <div class="preloader">
  <img src="{{asset('asset/images/preloader.gif')}}" alt="preloader">
</div>
<!-- preloader end -->

<!-- hero slider -->
<section class="hero-section overlay bg-cover" data-background="{{asset('asset/images/banner/banner-1.jpg')}}">
  <div class="container">
    <div class="hero-slider">
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".1">Your bright future is our mission</h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor
              incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exer</p>
            <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutRight" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInLeft" data-delay-in=".7">Apply now</a>
          </div>
        </div>
      </div>
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".1">Your bright future is our mission</h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor
              incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exer</p>
            <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutUp" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInDown" data-delay-in=".7">Apply now</a>
          </div>
        </div>
      </div>
      <!-- slider item -->
      <div class="hero-slider-item">
        <div class="row">
          <div class="col-md-8">
            <h1 class="text-white" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">Your bright future is our mission</h1>
            <p class="text-muted mb-4" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
              tempor
              incididunt ut labore et
              dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exer</p>
            <a href="contact.html" class="btn btn-primary" data-animation-out="fadeOutDown" data-delay-out="5" data-duration-in=".3" data-animation-in="zoomIn" data-delay-in=".7">Apply now</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /hero slider -->

<!-- about us -->
  <section class="section">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 order-2 order-md-1">
          <h2 class="section-title">{{__('library.about_us')}}</h2>
          <p>Welcome to our site..<br>
            On our website we serve university students in the Gaza Strip in all its universities, to speed up their access to their summaries and university books in all faculties and specializations.
            The student can also add his summaries or the summaries of the subject's records to benefit his friends.
            Dear student, all you have to do is enter the university to which it belongs, and then choose the college, your specialization. You will find many summaries added by your friends in each specialty separately.
            <br> wish you success..</p>
        </div>
        <div class="col-md-6 order-1 order-md-2 mb-4 mb-md-0">
          <img class="img-fluid w-100" src="{{asset('asset/images/about/about-us.jpg')}}" alt="about image">
        </div>
      </div>
    </div>

  </section>

  <section class="section-sm bg-primary">
    <div class="container">
      <div class="row">
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="{{$universitiesCount}}">  </h2>
            <h5 class="text-white">UNIVERSITIES</h5>
          </div>
        </div>
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="{{$faculitiesCount}}">  </h2>
            <h5 class="text-white">FACULITIES</h5>
          </div>
        </div>
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="{{$usersCount}}">  </h2>
            <h5 class="text-white">STUDENTS</h5>
          </div>
        </div>
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="{{$slidesCount}}">  </h2>
            <h5 class="text-white">SLIDIES</h5>
          </div>
        </div>
      </div>
    </div>
  </section>
<!-- /about us -->

<!-- universities -->
<section class="section-sm">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="d-flex align-items-center section-title justify-content-between">
          <h2 class="mb-0 text-nowrap mr-3"> {{__('library.universities')}} </h2>
          <div class="border-top w-100 border-primary d-none d-sm-block"></div>
          <div>
            <a href="{{route('universities.index')}}" class="btn btn-sm btn-primary-outline ml-sm-3 d-none d-sm-block"> {{__('library.see_all')}}  </a>
          </div>
        </div>
      </div>
    </div>
    <!-- course list -->
  <div class="row justify-content-center">
  <!-- course item -->
  @foreach ($universities as $university)
    <div class="col-lg-4 col-sm-6 mb-5">
      <div class="card p-0 border-primary rounded-0 hover-shadow">
        <img class="card-img-top rounded-0" src="{{Storage::url($university->image ?? '')}}" alt="course thumb">
        <div class="card-body">
          {{-- <ul class="list-inline mb-2">
            <li class="list-inline-item"><a class="text-color" href="#">  </a></li>
          </ul> --}}
          <a href="#">
            <h4 class="card-title"> {{$university->name}} </h4>
          </a>
          {{-- <p class="card-text mb-4"> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna.</p> --}}
          {{-- <a href="course-single.html" class="btn btn-primary btn-sm">Apply now</a> --}}
        </div>
      </div>
    </div>
    @endforeach

  </div>
  <!-- /course list -->
    <!-- mobile see all button -->
    <div class="row">
      <div class="col-12 text-center">
        <a href="courses.html" class="btn btn-sm btn-primary-outline d-sm-none d-inline-block">sell all</a>
      </div>
    </div>
  </div>
</section>
<!-- /universities -->

{{-- <!-- success story -->
<section class="section bg-cover" data-background="{{asset('asset/images/backgrounds/success-story.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-4 position-relative success-video">
        <a class="play-btn venobox" href="https://youtu.be/nA1Aqp0sPQo" data-vbtype="video">
          <i class="ti-control-play"></i>
        </a>
      </div>
      <div class="col-lg-6 col-sm-8">
        <div class="bg-white p-5">
          <h2 class="section-title">Success Stories</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris</p>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /success story --> --}}

{{-- teacher for admin (insert teacher) --}}
{{-- <!-- teachers -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12">
        <h2 class="section-title">Our Teachers</h2>
      </div>
      <!-- teacher -->
      <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="{{asset('asset/images/teachers/teacher-1.jpg')}}" alt="teacher">
          <div class="card-body">
            <a href="teacher-single.html">
              <h4 class="card-title">Jacke Masito</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="{{asset('asset/images/teachers/teacher-2.jpg')}}" alt="teacher">
          <div class="card-body">
            <a href="teacher-single.html">
              <h4 class="card-title">Clark Malik</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
      <!-- teacher -->
      <div class="col-lg-4 col-sm-6 mb-5 mb-lg-0">
        <div class="card border-0 rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="{{asset('asset/images/teachers/teacher-3.jpg')}}" alt="teacher">
          <div class="card-body">
            <a href="teacher-single.html">
              <h4 class="card-title">John Doe</h4>
            </a>
            <p>Teacher</p>
            <ul class="list-inline">
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-twitter-alt"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-google"></i></a></li>
              <li class="list-inline-item"><a class="text-color" href="#"><i class="ti-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- /teachers --> --}}
@endsection

@section('scripts')
@endsection