@extends('s_library.admin.starter')

@section('title', __('library.departments'))
@section('page-lg', __('library.index'))
@section('main-pg-md', __('library.departments'))
@section('page-md', __('library.index'))

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('library.departments') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover  ">
                                <thead>
                                    <tr>
                                        <th>{{ __('library.name') }}</th>
                                        <th>{{ __('library.faculity') }}</th>
                                        <th>{{ __('library.university') }}</th>
                                        <th>{{ __('library.created_at') }}</th>
                                        <th>{{ __('library.updated_at') }}</th>
                                        <th>{{ __('library.settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($departments as $department)
                                        <tr>
                                            <td>{{ $department->name }}</td>
                                            <td>{{$department->faculity->name}}</td>
                                            <td>{{$department->faculity->university->name}}</td>
                                            <td>{{ $department->created_at }}</td>
                                            <td>{{ $department->updated_at }}</td>
                                            <td>
                                              <div class="btn-group">
                                                  <a href="{{route('departments.edit',$department->id)}}"
                                                                class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                  <a href="#" onclick="confirmDelete('{{ $department->id }}', this)"
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
                    </div>
                    <!-- /.card -->
                </div>
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
            axios.delete('/edu/admin/departments/' + id)
                .then(function(response) {
                    console.log(response);
                    reference.closest('tr').remove();
                    showMessage(response.data);
                })
                .catch(function(error) {
                    console.log(error.response);
                    showMessage(error.response.data);
                });
        }

        function showMessage(data) {
            Swal.fire(
                data.title,
                data.text,
                data.icon
            );
        }
    </script>
@endsection
