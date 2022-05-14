@extends('s_library.parent')

@section('home_active', '@@home')
@section('university_active','@@university')
@section('faculity_active' , 'active')
@section('slide_active' , '@@slide')
@section('logout_active' , '@@logout')


@section('content')


<section class="page-title-section overlay" data-background="{{asset('asset/images/backgrounds/page-title.jpg')}}">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <ul class="list-inline custom-breadcrumb">
            <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="#">ALL {{__('library.faculities')}}</a></li>
            <li class="list-inline-item text-white h3 font-secondary "></li>
          </ul>
          <p class="text-lighten"></p>
        </div>
      </div>
    </div>
  </section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered table-stripe table-hover ">
                            <thead>
                                <tr>
                                    <th>{{ __('library.faculity_name') }}</th>
                                    <th>{{ __('library.num_of_department') }}</th>
                                    {{-- <th>{{ __('library.university') }}</th> --}}
                                    <th> {{__('library.show_departments')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($faculities as $faculity)
                                    <tr>
                                        <td>{{ $faculity->name }}</td>
                                        <td>{{ $faculity->departments_count }}</td>
                                        {{-- <td>{{$faculity->university->name}}</td> --}}
                                        <td>
                                            {{-- http://127.0.0.1:8000/user/faculities?id={{$faculity->id}} --}}
                                            <a href="{{route('faculities.index',['id' => $faculity->id])}}"> {{__('library.show_departments')}} </a>    
                                        </td>  
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection