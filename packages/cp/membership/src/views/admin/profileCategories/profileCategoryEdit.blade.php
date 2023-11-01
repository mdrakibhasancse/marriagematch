@extends('admin::layouts.adminMaster')
@section('title')
    | Profile Category Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Category Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Category Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Edit Profile Category</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.profileCategoriesAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.profileCategoryUpdate',$category->id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card-body">
                  <div class="form-group">
                    <label for="title">Category Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Category Title" value="{{ old('title') ? : $category->title }}">
                     @error('title')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description">{{old('description')? : $category->description }}</textarea>
                  </div>

                   <div class="form-group">
                    <label for="feature_image">Category Feature Image</label>
                    <div class="input-group">
                         <input type="file" name="feature_image">
                    </div>
                    <br>
                    <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $category->fi()]) }}" alt="Category Feature Image">
                  </div>


                  <div class="form-group">
                    <div class="checkbox">
                    <label><input type="checkbox"  name="active" value="1" {{  $category->active == 1 ? 'checked' : '' }}> Active</label>
                  </div>
                  </div>

            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
