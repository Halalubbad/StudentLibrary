@extends('s_library.admin.starter')

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
                        <h3 class="card-title">{{__('library.edit_admin')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{__('library.roles')}}</label>
                                <select class="form-control" id="role_id">
                                    @foreach ($roles as $role)
                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('library.name')}}</label>
                                <input type="text" class="form-control" id="name" value="{{$admin->name}}"
                                    placeholder="{{__('library.name')}}">
                            </div>
                            <div class="form-group">
                                <label for="email">{{__('library.email')}}</label>
                                <input type="email" class="form-control" id="email" value="{{$admin->email}}"
                                    placeholder="{{__('library.email')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performUpdate('{{$admin->id}}')"
                                class="btn btn-primary">{{__('library.save')}}</button>
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
        axios.put('/edu/admin/admins/{{$admin->id}}', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            role_id: document.getElementById('role_id').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/edu/admin/admins';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection