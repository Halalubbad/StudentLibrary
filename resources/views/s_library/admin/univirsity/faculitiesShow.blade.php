@extends('s_library.admin.starter')

@section('title', __('library.faculities'))
@section('page-lg', __('library.index'))
@section('main-pg-md', __('library.faculities'))
@section('page-md', __('library.index'))

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- @foreach ($faculities as $faculity) --}}
                                <h3 class="card-title">Faculities of the "  "</h3>
                            {{-- @endforeach --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-stripe table-hover ">
                                <thead>
                                    <tr>
                                        
                                        <th>#</th>
                                        <th>{{ __('library.name') }}</th>
                                        <th>{{ __('library.created_at') }}</th>
                                        <th>{{ __('library.updated_at') }}</th>
                                        <th>{{ __('library.settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($faculities as $faculity)
                                        <tr>
                                            <td>{{ $faculity->id }}</td>
                                            <td>{{ $faculity->name }}</td>
                                            <td>{{ $faculity->created_at }}</td>
                                            <td>{{ $faculity->updated_at }}</td>
                                            <td>
                                              <div class="btn-group">
                                                  <a href="{{route('faculities.edit',$faculity->id)}}"
                                                                class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                  <a href="#" onclick="confirmDelete('{{ $faculity->id }}', this)"
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
            axios.delete('/edu/admin/faculities/' + id)
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
