@extends('admin::layouts.adminMaster')
@section('title')
    | Gallery Create
@endsection

@push('css')
@endpush
@section('content') 
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Edit Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container">
            <div class="card">
            <div class="card-header bg-card">
                <div class="card-title">Edit Gallery </div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('admin.galleryUpdate',$gallery) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-12 col-md-9 m-auto card p-5">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control" id="title" placeholder="Title.." name="title" value=" {{  $gallery->title }}">
                                @error('title')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Description" >{{  $gallery->description }}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                               <input type="file" name="featured_image" class="form-control"><br>
                               <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $gallery->fi() ]) }}" alt="">
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Images(Multiple Select)</label>
                               <input type="file" name="extraImages[]" class="form-control" multiple>
                            </div>
                            <div class="row">
                                @foreach ($gallery->images as $image)
                                    <div class="col-6 cardRemove">
                                        <div class="card">
                                            <div class="card-image">
                                                <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $image->fi() ]) }}" alt="">
                                            </div>
                                            <div class="card-body w3-light-gray">
                                                <textarea class="form-control itemDescirption" rows="5" data-url="{{ route('admin.galleryItemDescriptionUpdate',$image->id) }}">{{ $image->description }}</textarea>
                                            </div>
                                            <div class="card-footer p-0 text-center">
                                                <button type="button" class="btn btn-warning ImageItemDelete" data-url="{{route('admin.galleryImageItemDelete',$image) }}" > <i class="fa fa-trash text-danger" ></i> </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="featured" name="featured" {{ $gallery->featured ? "checked" : "" }}>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="published" name="published" {{ $gallery->status == "published" ? "checked" : "" }}>
                                <label class="form-check-label" for="published">Published</label>
                            </div>
                            <input type="submit" class="btn btn-success mt-2" value="Update">

                        </div>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </section>
@endsection

@push('js')
<script>
$(document).ready(function() {
    $(document).on("change",'.itemDescirption',function(){
        var that = $(this);
        var url  = that.attr('data-url');
        var data = that.val();
         
        $.ajax({
           url: url,
            type: 'GET',
            dataType: 'json',
            cache: false,
             data:{
                data : data
            }
        })
    })


    $(document).on("click",'.ImageItemDelete',function(event){
        var that = $(this);
        var url  = that.attr('data-url');
        var data = that.val();

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            cache: false,
            data:{
             data : data
            }
        })
        .done(function(data){
            that.closest('.cardRemove').remove();
        });
    })


});
</script>

@endpush
