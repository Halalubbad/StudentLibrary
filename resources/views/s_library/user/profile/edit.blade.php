@extends('s_library.parent')

@section('home_active', '@@home')
@section('university_active','@@university')
@section('faculity_active' , '@@faculity')
{{-- @section('slide_active2' , 'active') --}}
@section('slide_active' , '@@slide')
@section('logout_active' , '@@logout')

@section('content')

<section class="page-title-section overlay" data-background="{{asset('asset/images/backgrounds/page-title.jpg')}}">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <ul class="list-inline custom-breadcrumb">
          <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="#"> {{__('library.my_profile')}} </a></li>
          <li class="list-inline-item text-white h3 font-secondary "></li>
        </ul>
        <p class="text-lighten"></p>
      </div>
    </div>
  </div>
</section>

<section class="section">
    <div class="container">
      <!-- course list -->
  <div class="row justify-content-center">
    <!-- course item -->
    <div class="row">
      <div class="col-lg-12 mb-4 mb-lg-0">
        <div class="card p-0 border-primary rounded-0 hover-shadow">
          <img class="card-img-top rounded-0" src="{{Storage::url($user[0]->image ?? '')}}" alt="course thumb">
        </div>
        <form id="create-form">
          
          <div class="form-group">
              <label>{{__('library.name')}} : </label>
              <input type="text" class="form-control mb-3" value=" {{$user[0]->name}} " id="name" placeholder="Name">
          </div>

          <div class="form-group">
              <label>{{__('library.email')}} : </label>
              <input type="email" class="form-control mb-3" value=" {{$user[0]->email}} " id="email" placeholder="Email">
          </div>
          
          <div class="form-group">
              <label>{{__('library.university')}} : </label>
              <select class="form-control" id="university_id">
                  @foreach ($universities as $university)
                      <option value="{{$university->id}}">{{$university->name}}</option>
                  @endforeach
              </select>
          </div>

          <div class="form-group">
              <label for="slide_image">{{ __('library.image') }} : </label>
              <div class="input-group">
                  <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image">
                      <label class="custom-file-label" for="image">Choose file</label>
                  </div>
              </div>
          </div>
          
          <button type="button" onclick="performUpdate('{{$user[0]->id}}')" class="btn btn-primary">{{__('library.update_my_profile')}}</button>
        </form>
      </div>
    </div>
  </div>
  <!-- /course list -->
    </div>
  </section>
@endsection

@section('scripts')
  <script>
    function performUpdate(id) {
            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('university_id', document.getElementById('university_id').value);
            if(document.getElementById('image').files[0] != undefined) {
                formData.append('image', document.getElementById('image').files[0]);
            }

            formData.append('_method','PUT');
            
            axios.post('/edu/admin/users/{{$user[0]->id}}', formData)
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/edu/admin/userHome';
                })
                .catch(function (error) {
                    console.log(error.response);
                    toastr.error(error.response.data);
          
                });
        }
    </script>
@endsection
