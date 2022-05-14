@extends('s_library.admin.starter')

@section('title', __('library.universities'))
@section('page-lg', __('library.index'))
@section('main-pg-md', __('library.universities'))
@section('page-md', __('library.index'))

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">{{ __('library.universities') }}</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class=" table table-hover table-striped table-bordered ">
                                <thead>
                                    <tr>
                                        <th>{{ __('library.image') }}</th>
                                        <th>{{ __('library.name') }}</th>
                                        <th>{{ __('library.faculities') }}</th>
                                        <th>{{ __('library.created_at') }}</th>
                                        <th>{{ __('library.updated_at') }}</th>
                                        <th>{{ __('library.settings') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($universities as $university)
                                        <tr>
                                            <td>
                                                <img  height="100" src="{{Storage::url($university->image ?? '')}}" />
                                            </td>
                                            <td>{{ $university->name }}</td>
                                            <td>
                                              <a href="{{route('universities.index',['id'=>$university->id])}}" class="btn btn-app bg-info">
                                                  <i class="fas fa-envelope"></i> {{$university->faculities_count}}
                                              </a>
                                            </td>
                                            <td>{{ $university->created_at }}</td>
                                            <td>{{ $university->updated_at }}</td>
                                            <td>
                                              <div class="btn-group">
                                                  <a href="{{route('universities.edit',$university->id)}}"
                                                                class="btn btn-warning">
                                                    <i class="fas fa-edit"></i>
                                                  </a>
                                                  <a href="#" onclick="confirmDelete('{{ $university->id }}', this)"
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
            axios.delete('/edu/admin/universities/' + id)
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
