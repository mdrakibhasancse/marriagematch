@extends('admin::layouts.adminMaster')
@section('title')
    | Job Post Create
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Job Post Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Job Post Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h3 class="card-title">Create New Job Post</h3>
          </div>

          <form action="{{ route('admin.jobPostStore')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 5px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                  <input type="text" name="title" value="{{old('title')}}" class="form-control" placeholder="Enter title">
                                    @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>


                                
                                <div class="form-group">
                                  <label for="published_date">Published Date</label>
                                  <input type="date" class="form-control" name="published_date" id="published_date" placeholder="Published Date">
                                  @error('published_date')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                  <label for="expired_date">Expired Date</label>
                                  <input type="date" class="form-control" name="expired_date" id="expired_date" placeholder="Expired Date">
                                  @error('expired_date')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                  <label for="designation">Designation</label>
                                  <input type="text" class="form-control" name="designation" id="designation" placeholder="Designation">
                                  @error('designation')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                  <label for="salary">Salary</label>
                                  <input type="text" class="form-control" name="salary" id="Salary" placeholder="Salary">
                               
                                </div>


                                <div class="form-group">
                                  <label for="">Excerpt</label>
                                  <textarea name="excerpt" id="excerpt" class="form-control" rows="3" placeholder="Enter Excerpt">{{old('excerpt')}}</textarea>
                                  @error('excerpt')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                  <label for="">Description</label>
                                  <textarea name="description" id="summernote" class="form-control" rows="5" placeholder="Enter Description">{{old('description')}}</textarea>
                                  @error('description')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                                </div>

                               


                                <div class="form-group">
                                  <label class="mr-3"><input type="checkbox"  name="active" value="1" {{  old('active') == 1 ? 'checked' : '' }} checked> Active</label>
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



