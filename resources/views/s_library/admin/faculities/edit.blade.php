@extends('s_library.admin.starter')

@section('title', __('library.faculity'))
@section('page-lg', __('library.edit'))
@section('main-pg-md', __('library.update_faculity'))
@section('page-md', __('library.edit'))

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
                            <h3 class="card-title">{{ __('library.update_faculity') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{ __('library.university') }}</label>
                                    <select class="form-control" id="university_id">
                                        @foreach ($universities as $university_id)
                                            <option value="{{$university_id->id }}">{{$university_id->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">{{ __('library.name') }}</label>
                                    <input type="text" class="form-control" id="name" value="{{ $faculity->name }}"
                                        placeholder="{{ __('library.name') }}">
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate('{{ $faculity->id }}')"
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
        function performUpdate(id) {
            // alert('PERFORM')
            // console('POE')
            axios.put('/edu/admin/faculities/{{$faculity->id}}', {
                    name: document.getElementById('name').value,
                    university_id: document.getElementById('university_id').value,
                })
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/edu/admin/faculities';
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data);
                    
                });
        }
    </script>
@endsection

