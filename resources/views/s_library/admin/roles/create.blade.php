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
                        <h3 class="card-title">{{__('library.create_role')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="create-form">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{__('library.user_type')}}</label>
                                <select class="form-control" id="guard_name">
                                    <option value="admin">{{__('library.admin')}}</option>
                                    <option value="user">{{__('library.user')}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('library.name')}}</label>
                                <input type="text" class="form-control" id="name" placeholder="{{__('library.name')}}">
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="button" onclick="performStore()"
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
<script>
    function performStore() {
        axios.post('/edu/admin/roles', {
            name: document.getElementById('name').value,
            guard_name: document.getElementById('guard_name').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('create-form').reset();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection