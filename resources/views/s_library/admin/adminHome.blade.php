@extends('s_library.admin.starter')
@section('title', __('library.home'))

@section('content')
<section class="section-sm bg-primary">
    <div class="container">
      <div class="row">
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="60"> {{$universities}} </h2>
            <h5 class="text-white">UNIVERSITIES</h5>
          </div>
        </div>
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="50"> {{$faculities}} </h2>
            <h5 class="text-white">FACULITIES</h5>
          </div>
        </div>
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="1000"> {{$users}} </h2>
            <h5 class="text-white">STUDENTS</h5>
          </div>
        </div>
        <!-- funfacts item -->
        <div class="col-md-3 col-sm-6 mb-4 mb-md-0">
          <div class="text-center">
            <h2 class="count text-white" data-count="3737"> {{$slides}} </h2>
            <h5 class="text-white">SLIDIES</h5>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection