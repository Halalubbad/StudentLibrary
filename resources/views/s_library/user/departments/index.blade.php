@extends('s_library.parent')

@section('content')

<section class="page-title-section overlay" data-background="{{asset('asset/images/backgrounds/page-title.jpg')}}">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <ul class="list-inline custom-breadcrumb">
            <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="#">{{__('library.departments')}} OF {{$faculity[0]->name}} Faculity</a></li>
            <li class="list-inline-item text-white h3 font-secondary "> {{$faculity[0]->university->name}} </li>
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
                                    <th>{{ __('library.department_name') }}</th>
                                    <th>{{ __('library.num_of_slides') }}</th>
                                    <th>{{ __('library.university') }}</th>
                                    <th> {{__('library.show_slides')}} </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->slides_count }}</td>
                                        <td>{{ $department->faculity->university->name}}</td>
                                        <td>
                                            {{--  http://127.0.0.1:8000/user/departments/{{$department->id}} --}}
                                            <a href="{{route('departments.show',$department->id)}}"> {{__('library.show_slides')}} </a>
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