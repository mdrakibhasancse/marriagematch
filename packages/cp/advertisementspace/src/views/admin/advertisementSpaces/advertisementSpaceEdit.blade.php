@extends('admin::layouts.adminMaster')
@section('title')
    | Advertisment Space Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advertisment Space Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Advertisment Space Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h4 class="card-title">Advertisment Space Post</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.blogPostsAll') }}"> Back</a>
            </div>
          </div>

          <form action="{{ route('admin.advertisementSpaceUpdate',$advertisement->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
            <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-sm-7">
                        <div class="card card-default" style="margin-bottom: 5px;">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Title</label>
                                  <input type="text" name="title" value="{{old('title') ? : $advertisement->title }}" class="form-control" placeholder="Enter title">
                                    @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                             <div class="form-group">
                                  <label for="">Position</label>
                                  <select name="position" id="position" class="form-control">
                                    <option value="">select position</option>
                                  @foreach (config('ad_parameter.position') as $item)
                                    <option value="{{ $item }}" {{ $item == $advertisement->position ? 'selected' : ' '}}>{{ $item }}</option>
                                  @endforeach
                                  </select>
                                  @error('poition')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                                </div>

                                <div class="form-group">
                                  <label for="">Description</label>
                                  <textarea name="description"
                                  @if($advertisement->editor)
                                      id="summernote"
                                      @else
                                      id="summernote-"
                                      @endif
                                      class="form-control" rows="5">{{ $advertisement->description }}</textarea>
                                  @error('description')
                                  <span style="color:red">{{ $message }}</span>
                                  @enderror
                              </div>

                                

                                <div class="form-group">
                                  <label class="mr-3"><input type="checkbox"  name="active" value="1" {{ $advertisement->active == 1 ? 'checked' : '' }}> Active</label>
                                </div>
                                

                                <div class="form-group">
                                  <div class="checkbox">
                                  <label>
                                      <input type="checkbox"  name="editor" value="1" {{ $advertisement->editor == 1 ? 'checked' : '' }}> Editor
                                      </label>
                                  </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
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


