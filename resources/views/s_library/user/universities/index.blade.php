@extends('s_library.parent')

@section('home_active', '@@home')
@section('university_active','active')
@section('faculity_active' , '@@faculity')
@section('slide_active' , '@@slide')
@section('logout_active' , '@@logout')

@section('content')

<section class="page-title-section overlay" data-background="{{asset('asset/images/backgrounds/page-title.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="courses.html">{{__('library.our_universities')}}</a></li>
          <li class="list-inline-item text-white h3 font-secondary "></li>
        </ul>
        <p class="text-lighten"></p>
      </div>
    </div>
  </div>
</section>

<section class="section">
    <div class="container">
      <!-- course list -->
  <div class="row justify-content-center">
    <!-- course item -->
    @foreach ($universities as $university)
        <div class="col-lg-4 col-sm-6 mb-5">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{Storage::url($university->image ?? '')}}" alt="course thumb">
            <div class="card-body">
            {{-- <ul class="list-inline mb-2">
                <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>02-14-2018</li>
                <li class="list-inline-item"><a class="text-color" href="#">Humanities</a></li>
            </ul> --}}
            <a href="course-single.html">
                <h4 class="card-title">{{$university->name}}</h4>
            </a>
            <p class="card-text mb-4">{{__('library.num_of_faculities')}} : {{$university->faculities_count}} </p>
            {{-- http://127.0.0.1:8000/user/universities?id={{$university->id}} --}}
            <a href="{{route('universities.index',['id'=>$university->id])}}" class="btn btn-primary btn-sm"> {{__('library.show_faculities')}} </a>
            </div>
        </div>
        </div>
    @endforeach
  </div>
  <!-- /course list -->
    </div>
  </section>
@endsection
