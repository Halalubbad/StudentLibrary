@extends('s_library.admin.starter')

@section('title',__('library.permissions'))
@section('page-lg',__('library.permissions'))
@section('main-pg-md',__('library.permissions'))
@section('page-md',__('library.permissions'))

@section('styles')
<link rel="stylesheet" href="{{asset('assetAdmin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$user->name}} {{__('library.permissions')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{__('library.name')}}</th>
                                    <th>{{__('library.user_type')}}</th>
                                    <th style="width: 40px">{{__('library.assigned')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td><span class="badge bg-success">{{$permission->guard_name}}</span></td>
                                    <td>
                                        <div class="form-group clearfix">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" onclick="performUpdate('{{$permission->id}}')"
                                                    id="permission_{{$permission->id}}" @if($permission->assigned)
                                                checked @endif>
                                                <label for="permission_{{$permission->id}}"></label>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
    </div><!-- /.container-fluid -->
</section>
@endsection

@section('scripts')
<script>
    function performUpdate(permissionId) {
        // console.log('TEST');
        axios.put('/edu/admin/users/{{$user->id}}/permissions/edit', {
            permission_id: permissionId
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
    
</script>
@endsection