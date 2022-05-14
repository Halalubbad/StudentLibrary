@extends('s_library.parent')

@section('home_active', '@@home')
@section('university_active','@@university')
@section('faculity_active' , '@@faculity')
@section('slide_active' , 'active')
@section('logout_active' , '@@logout')

@section('content')

<section class="page-title-section overlay" data-background="{{asset('asset/images/backgrounds/page-title.jpg')}}">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <ul class="list-inline custom-breadcrumb">
            <li class="list-inline-item"><a class="h2 text-primary font-secondary" href="#">{{__('library.edit_slide')}}</a></li>
            <li class="list-inline-item text-white h3 font-secondary "></li>
          </ul>
          <p class="text-lighten"></p>
        </div>
      </div>
    </div>
  </section>

<section class="section bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h2 class="section-title">{{__('library.edit_slide') }} : {{$slide->subject_name}}</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 mb-4 mb-lg-0">
          <form id="create-form">
            
            <div class="form-group">
                <label>{{__('library.subject_id')}} : </label>
                <input type="text" value=" {{$slide->subject_number}} " class="form-control mb-3" id="subject_number" placeholder="Subject Number">
            </div>

            <div class="form-group">
                <label>{{__('library.subject_name')}} : </label>
                <input type="text" value=" {{$slide->subject_name}} " class="form-control mb-3" id="subject_name" placeholder="Subject Name">
            </div>
            
            <div class="form-group">
                <label>{{__('library.faculity')}} : </label>
                <select class="form-control" id="faculity_id">
                    @foreach ($faculities as $faculity)
                        <option value="{{$faculity->id}}">{{$faculity->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>{{__('library.department')}} : </label>
                <select class="form-control" id="department_id">
                </select>
            </div>

            <div class="form-group">
                <label>{{__('library.teacher')}} : </label>
                <input type="text" value=" {{$slide->teacher}} " class="form-control" id="teacher" placeholder="Teacher">
            </div>

            <div class="form-group">
                <label>{{__('library.year')}} : </label>
                <input type="text" value=" {{$slide->year}} " class="form-control" id="year" placeholder="year">
            </div>
            
            <div class="form-group">
                <label>{{__('library.level')}} : </label>
                <select class="form-control" id="level" >
                    <option value="First Level" @if($slide->level == 'First Level') selected @endif >First Level</option>
                    <option value="Second Level" @if($slide->level == 'Second Level') selected @endif>Second Level</option>
                    <option value="Third Level" @if($slide->level == 'Third Level') selected @endif >Third Level</option>
                    <option value="Fourth Level" @if($slide->level == 'Fourth Level') selected @endif>Fourth Level</option>
                    <option value="Fifth Semester" @if($slide->level == 'Fifth Level') selected @endif>Fifth Semester</option>
                    <option value="Sixth Level" @if($slide->level == 'Sixth Level') selected @endif>Sixth Level</option>
                </select>
            </div>

            <div class="form-group">
                <label>{{__('library.semester')}} : </label>
                <select class="form-control" id="semester">
                    <option value="First Semester" @if($slide->semester == 'First Semester') selected @endif>First Semester</option>
                    <option value="Second Semester" @if($slide->semester == 'Second Semester') selected @endif>Second Semester</option>
                </select>
            </div>

            <div class="form-group">
                <label for="slide_image">{{ __('library.image') }} : </label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="slide_image">
                        <label class="custom-file-label" for="slide_image">Choose file</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="slide_file">{{ __('library.slide_file') }} : </label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="slide_file">
                        <label class="custom-file-label" for="slide_file">Choose file</label>
                    </div>
                </div>
            </div>
            
            <button type="button" onclick="performUpdate('{{$slide->id}}')" class="btn btn-primary">{{__('library.update_slide')}}</button>
          </form>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('scripts')
    <script src="{{asset('assetAdmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
    {{-- <script src="{{asset('assetAdmin/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script> --}}
    {{-- <script src="{{asset('js/axios.js')}}"></script> --}}
    <script>
        $(function() {
            bsCustomFileInput.init()
        });
    </script>
    <script>

        $('#faculity_id').on('change',function(){
            getFaculities(this.value);
        });

        function getFaculities(faculityId){
            axios.get('/edu/admin/faculities/'+faculityId)
            .then(function (response) {
            console.log(response);
            console.log(response.data.data);
            $('#department_id').empty();
            $.each(response.data.data, function(i , item){
                $('#department_id').append(new Option(item['name'] , item['id']));
            });
            })
            .catch(function (error) {
            console.log(error);
            
            });
        }

        function performUpdate(id) {
            var formData = new FormData();
            formData.append('subject_number', document.getElementById('subject_number').value);
            formData.append('subject_name', document.getElementById('subject_name').value);
            formData.append('faculity_id', document.getElementById('faculity_id').value);
            formData.append('department_id', document.getElementById('department_id').value);
            formData.append('teacher', document.getElementById('teacher').value);
            formData.append('year', document.getElementById('year').value);
            formData.append('level', document.getElementById('level').value);
            formData.append('semester', document.getElementById('semester').value);
            // if(document.getElementById('image').files[0] != undefined) {
                formData.append('image', document.getElementById('slide_image').files[0]);
            // }
            // if(document.getElementById('slide_file').files[0] != undefined) {
                formData.append('slide_file', document.getElementById('slide_file').files[0]);
            // }

            formData.append('_method','PUT');
            
            axios.post('/edu/admin/slides/{{$slide->id}}', formData)
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    window.location.href = '/edu/admin/slides';
                })
                .catch(function (error) {
                    console.log(error);
                    toastr.error(error.response.data);
          
                });
        }
    </script>
@endsection