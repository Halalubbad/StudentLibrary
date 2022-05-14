@extends('s_library.parent')

@section('home_active', '@@home')
@section('university_active','@@university')
@section('faculity_active' , '@@faculity')
@section('slide_active2' , 'active')
@section('slide_active' , '@@slide')
@section('logout_active' , '@@logout')

@section('content')

<section class="page-title-section overlay" data-background="{{asset('asset/images/backgrounds/page-title.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="#">{{__('library.slidies')}} OF {{$department->name}}</a></li>
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
    @foreach ($slides as $slide)
        <div class="col-lg-4 col-sm-6 mb-5">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
            <img class="card-img-top rounded-0" src="{{Storage::url($slide->image ?? '')}}" alt="course thumb">
            <div class="card-body">
              <ul class="list-inline mb-2">
                  <li class="list-inline-item"><i class="ti-calendar mr-1 text-color"></i>{{$slide->year}}</li>
                  <li class="list-inline-item"><a class="text-color" href="#">{{$slide->department->name}}</a></li>
              </ul>
              <h6 class="card-title"> {{__('library.subject_name')}} : {{$slide->subject_name}} </h6>
              <h6 class="card-title"> {{__('library.teacher')}} : {{$slide->teacher}} </h6>
              <a href="{{Storage::url($slide->slide_file ?? '')}}"> {{__('library.slide_file')}} </a>
              <p class="card-text mb-4"></p>
            </div>
        </div>
        </div>
    @endforeach
  </div>
  <!-- /course list -->
    </div>
  </section>
@endsection
