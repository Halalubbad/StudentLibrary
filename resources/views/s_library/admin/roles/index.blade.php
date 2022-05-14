@extends('s_library.admin.starter')

@section('styles')

@endsection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('library.roles')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('library.name')}}</th>
                                    <th>{{__('library.user_type')}}</th>
                                    <th>{{__('library.permissions')}}</th>
                                    <th>{{__('library.created_at')}}</th>
                                    <th>{{__('library.updated_at')}}</th>
                                    <th style="width: 40px">{{__('library.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td><span class="badge bg-success">{{$role->guard_name}}</span></td>
                                    <td>
                                        <a href="{{route('roles.edit-permissions',$role->id)}}"
                                            class="btn btn-app bg-info">
                                            <i class="fas fa-envelope"></i> {{$role->permissions_count}}
                                        </a>
                                    </td>
                                    <td>{{$role->created_at}}</td>
                                    <td>{{$role->updated_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDelete('{{$role->id}}', this)"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id, reference) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            cancelButtonColor: '#d33',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            performDelete(id, reference);
        }
        });
    }

    function performDelete(id, reference) {
        axios.delete('/edu/admin/roles/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            reference.closest('tr').remove();
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
</script>
@endsection