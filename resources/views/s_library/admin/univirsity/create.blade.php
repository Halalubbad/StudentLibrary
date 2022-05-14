@extends('s_library.admin.starter')

@section('title', __('library.universities'))
@section('page-lg', __('library.create'))
@section('main-pg-md', __('library.create_university'))
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
                            <h3 class="card-title">{{ __('library.create_university') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- enctype="multipart/form-data" --}}
                        <form id="create-form">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">{{ __('library.name') }}</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="{{ __('library.name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="university_image">{{ __('library.image') }}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="university_image">
                                            <label class="custom-file-label" for="university_image">Choose file</label>
                                        </div>
                                    </div>
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
    <script src="{{asset('assetAdmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    {{-- <script src="{{asset('assetAdmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}
    {{-- <script src="{{asset('js/axios.js')}}"></script> --}}
    <script>
        $(function() {
            bsCustomFileInput.init()
        });
    </script>
    <script>
        function performStore() {
            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('image', document.getElementById('university_image').files[0]);

            axios.post('/edu/admin/universities', formData)
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
@endsection
