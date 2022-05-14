{{-- @extends('s_library.parent') --}}
{{-- @extends('s_library.user.home') --}}
<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>{{__('library.edit_password')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="login">
                    <form class="row" id="create-form">
                        @csrf
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="current_password" placeholder="{{__('library.current_password')}}">
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="new_password" placeholder="{{__('library.new_password')}}">
                        </div>
                        <div class="col-12">
                            <input type="password" class="form-control mb-3" id="new_password_confirmation" placeholder="{{__('library.new_password_confirmation')}}">
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary" onclick="performStore()" >{{__('library.save')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    function performStore() {
        // alert('Perform Store - FUNCTION JS');
        // console.log('performStore');
        
        axios.put('/edu/user/update-password', {
            password: document.getElementById('current_password').value,
            new_password: document.getElementById('new_password').value,
            new_password_confirmation: document.getElementById('new_password_confirmation').value,
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