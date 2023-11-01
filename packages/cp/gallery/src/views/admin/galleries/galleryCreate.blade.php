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
            <h1>Create Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Create Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
        <div class="container">
            <div class="card">
            <div class="card-header bg-card">
                <div class="card-title">Create Gallery</div>
            </div>
            <div class="card-body w3-light-gray">
                <form action="{{ route('admin.galleryStore') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-2">
                        <div class="col-12 col-md-9 m-auto card p-5">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" class="form-control @error('title') is_invalid @enderror" id="title" placeholder="Title.." name="title" value="{{ old('title') }}">
                                @error('title')

                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Description">{{old('description')}}</textarea>
                                @error('description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Featured Image</label>
                               <input type="file" name="featured_image" class="form-control">
                               @error('featured_image')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                            </div>
                            <div class="form-group">
                                <label for="featured_image">Images(Multiple Select)</label>
                               <input type="file" name="extraImages[]" class="form-control" multiple>
                            </div>

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="featured" name="featured" {{ old('featured') ? "checked" : "" }}>
                                <label class="form-check-label" for="featured">Featured</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="published" name="published" {{ old('published') ? "checked" : "" }}>
                                <label class="form-check-label" for="published">Published</label>
                            </div>
                            <input type="submit" class="btn btn-success mt-2">

                        </div>
                    </div>
                </form>

            </div>
        </div>
        </div>
    </section>
@endsection

