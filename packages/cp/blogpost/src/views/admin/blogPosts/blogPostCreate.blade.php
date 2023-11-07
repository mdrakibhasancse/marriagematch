@extends('admin::layouts.adminMaster')
@section('title')
    | Bolg Post Create
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Bolg Post Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Bolg Post Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h3 class="card-title">Create New Bolg Post</h3>
          </div>

          <form action="{{ route('admin.blogPostStore')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 5px;">
                            <div class="card-body">
                                 @foreach (Cp\Admin\Models\Language::where('active', 1)->get() as $key => $language)
                                <div class="form-group">
                                  <label for="title">Title {{$language->title}}</label>
                                  <input type="text" name="title[{{$language->language_code}}]" value="" class="form-control" placeholder="Enter title {{$language->title}}">
                                    @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                  <label for="">Excerpt {{$language->title}}</label>
                                  <textarea name="excerpt[{{$language->language_code}}]" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt {{$language->title}}">{{old('excerpt')}}</textarea>
                                </div>

                                <div class="form-group">
                                  <label for="">Description {{$language->title}}</label>
                                  <textarea name="description[{{$language->language_code}}]" class="summernote form-control"  rows="5" placeholder="Enter Description {{$language->title}}">{{old('description')}}</textarea>
                                </div>
                              @endforeach

                                <div class="form-group">
                                  <label>Tags (For Search)</label>
                                  <select class="select2bs4 select2 select2-hidden-accessible"
                                    id="tags"
                                    name="tags[]"
                                    multiple="multiple"
                                    data-ajax-url="{{route('admin.tags')}}"
                                    data-ajax-dataType="json"
                                    data-placeholder="Select Tags From list or Add New" style="width: 100%;"
                                    data-select2-id="23"
                                    data-ajax-delay="200"
                                    >
                                    @if(old('tags'))
                                      @foreach(old('tags') as $tagg)
                                      <option selected="selected">{{ $tagg }}</option>
                                      @endforeach
                                    @endif
                                  </select>
                                </div>


                                <div class="form-group">
                                  <label for="">Status</label>
                                  <select name="status" id="" class="form-control">
                                    <option value="">Choose Status</option>
                                    <option value="published" 
                                    >Published</option>
                                    <option value="pending" selected>Pending</option>
                                  </select>
                                </div>
                

                                <div class="form-group">
                                  <label class="mr-3"><input type="checkbox"  name="active" value="1" {{  old('active') == 1 ? 'checked' : '' }} checked> Active</label>
                                </div>

                                 <div class="form-group">
                                    <label class="mr-3"><input type="checkbox"  name="featured_slider" value="1" {{  old('featured_slider') == 1 ? 'checked' : '' }}checked> Feature Slider</label>
                                  </div>


                                <div class="form-group">
                                  <div class="checkbox">
                                  <label>
                                      <input type="checkbox"  name="editor" value="1" {{  old('editor') == 1 ? 'checked' : '' }} checked> Editor
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
                            </div>
                        </div>

                
                          @includeIf('media::admin.medias.mediaContainer')

                    </div>
                </div>


                <div class="row">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 20px;">
                            <div class="card-header">
                                <h3 class="card-title">Bolg Post Files</h3>
                            </div>
                              <div class="card-body">
                                <div class="form-group">
                                    <label for="post_files">Bolg Post Files</label>
                                    <input type="file" name="post_files[]" multiple>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card card-default" style="margin-bottom: 5px;">

                            <div class="card-header">
                                <h3 class="card-title">Add Category </h3>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    @foreach ($categories as $cat)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" data-id="{{ $cat->id }}" id="cat-{{ $cat->id }}" name="categories[]" value="{{ $cat->id }}">
                                            <label class="form-check-label" for="cat-{{ $cat->id }}">{{ $cat->name }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                  </div>
                            </div>
                        </div>
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



