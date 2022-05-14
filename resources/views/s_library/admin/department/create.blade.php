@extends('s_library.admin.starter')

@section('title', __('library.departments'))
@section('page-lg', __('library.create'))
@section('main-pg-md', __('library.create_department'))
@section('page-md', __('library.create'))

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('library.create_department') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- enctype="multipart/form-data" --}}
                        <form id="create_form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{__('library.university')}}</label>
                                    <select class="form-control" id="university_id">
                                        @foreach ($universities as $university)
                                        <option value="{{$university->id}}">{{$university->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>{{__('library.faculity')}}</label>
                                    <select class="form-control" id="faculity_id">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('library.name') }}</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="{{ __('library.name') }}">
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performStore()"
                                    class="btn btn-primary">{{ __('library.save') }}</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('scripts')
    {{-- <script src="{{asset('js/axios.js')}}"></script> --}}
    <script>

        $('#university_id').on('change',function(){
            // alert('value : '+this.value);
            getFaculities(this.value);
        });

        function getFaculities(universityId){
            axios.get('/edu/admin/universities/'+universityId)
            .then(function (response) {
            console.log(response);
            console.log(response.data.data);
            $('#faculity_id').empty();
            $.each(response.data.data, function(i , item){
                $('#faculity_id').append(new Option(item['name'] , item['id']));
            });
            })
            .catch(function (error) {
            console.log(error);
            
            });
        }


        function performStore(){
        // alert('PERFORM')
            axios.post('/edu/admin/departments', {
            name : document.getElementById('name').value ,
            university_id : document.getElementById('university_id').value ,
            faculity_id : document.getElementById('faculity_id').value,
            })
            .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create_form').reset();
            })
            .catch(function (error) {
            console.log(error);
            toastr.error(error.response.data);
            
            });
        }
    </script>
@endsection
