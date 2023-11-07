@extends('admin::layouts.adminMaster')
@section('title')
    | Story Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Story Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Story Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h4 class="card-title">Edit Story</h4>
            <div class="card-tools">
                @if($story->story_type == 'story')
                  <a class="btn btn-primary btn-xs" href="{{ route('admin.storiesAll') }}"> Back</a>
                @else
                  <a class="btn btn-primary btn-xs" href="{{ route('admin.testimonialsAll') }}"> Back</a>
                @endif
            </div>
          </div>

          <form action="{{ route('admin.successStoryUpdate',$story->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 5px;">
                            <div class="card-body">
                                @foreach (Cp\Admin\Models\Language::where('active', 1)->get() as $key => $language)
                                <div class="form-group">
                                    <label for="name">Title {{$language->title}}</label>
                                  <input type="text" name="title[{{$language->language_code}}]" value="{{ $story->localeTitle($language->language_code) }}" class="form-control" placeholder="Enter title {{$language->title}}">
                                    @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>




                                <div class="form-group">
                                  <label for="">Excerpt {{$language->title}}</label>
                                  <textarea name="excerpt[{{$language->language_code}}]" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt {{$language->excerpt}}">{{ $story->localeExcerpt($language->language_code)  }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="">Description {{$language->title}}</label>
                                    <textarea name="description[{{$language->language_code}}]"
                                    @if($story->editor)
                                        class="summernote form-control"
                                        @else
                                        class="summernote- form-control"
                                        @endif
                                       rows="5">{{ $story->localeDescription($language->language_code)  }}</textarea>
                                </div>

                              @endforeach


                                
                                <div class="form-group">
                                  <label for="male_user_id">Male User Email</label>
                                  <input type="email" name="male_user_id" value="" class="form-control" placeholder="Male User Email">
                                 
                                </div>

                                <div class="form-group">
                                  <label for="female_user_id">Female User Email</label>
                                  <input type="email" name="female_user_id" value="" class="form-control" placeholder="Female User Email">
                                </div>


                              
                                <div class="form-group">
                                  <label for="story_type">Select Story</label>
                                   <select name="story_type" id="story_type" class="form-control">
                                    <option value="">Select Story</option>
                                       @foreach (config('su_parameter.story_type') as $item)
                                          <option value="{{ $item }}" {{ $item == $story->story_type ? 'selected' : ' '}}>{{ $item }}</option>
                                        @endforeach
                                   </select>

                                    @error('story_type')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                

                                 <div class="form-group">
                                    <label class="mr-3"><input type="checkbox"  name="featured" value="1" {{ $story->featured == 1 ? 'checked' : '' }}> Featured</label>
                                  </div>


                                <div class="form-group">
                                  <label class="mr-3"><input type="checkbox"  name="active" value="1" {{ $story->active == 1 ? 'checked' : '' }}> Active</label>
                                </div>

                                <div class="form-group">
                                  <div class="checkbox">
                                  <label>
                                      <input type="checkbox"  name="editor" value="1" {{ $story->editor == 1 ? 'checked' : '' }}> Editor
                                      </label>
                                  </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="card card-default" style="margin-bottom: 20px;">
                            <div class="card-header">
                                <h3 class="card-title">Add Featured Image</h3>
                            </div>
                              <div class="card-body">
                                <div class="form-group row">
                                    <label for="feature_image" class="col-sm-4 col-form-label">Featured Image</label>
                                    <div class="col-sm-6">
                                        <input type="file" class="form-control-file" id="featured_image" name="featured_image">
                                    </div>
                                </div>
                                   <br>
                                    <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $story->fi()]) }}" >
                            </div>
                        </div>

                
                          @includeIf('media::admin.medias.mediaContainer')

                    </div>
                </div>


              </div>

              <div class="card-footer text-right">
                    <input type="submit" class="btn btn-primary" value="Save">
              </div>

          </form>
      </div>

    </section>
    <!-- /.content -->

@endsection

@push('js')
<script>
    $(document).ready(function(){
     
    //  $('.select2').select2({});

     $('.select2bs4').select2({
            minimumInputLength: 1,
            tags:true,
            tokenSeparators: [','],
            ajax: {
            data: function (params) {
                return {
                q: params.term, // search term
                page: params.page
                };
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                var data = $.map(data, function (obj) {
                obj.id = obj.id || obj.name;
                return obj;
                });
                var data = $.map(data, function (obj) {
                obj.text = obj.text || obj.name;
                return obj;
                });
                return {
                results: data,
                    pagination: {
                        more: (params.page * 30) < data.total_count
                    }
                };
            }
            },
        });

     });

</script>
@endpush


