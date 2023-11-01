@extends('admin::layouts.adminMaster')
@section('title')
    | Category Create
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Category Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Category Create</li>
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
            <h4 class="card-title">Create Profile Category</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.profileCategoriesAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.profileCategoryStore')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="card-body">
                  <div class="form-group">
                    <label for="title">Category Title</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter Category Title" value="{{ old('title')}}">
                     @error('title')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description">{{old('description')}}</textarea>
                  </div>

                  <div class="form-group">
                    <label for="feature_image">Category Feature Image</label>
                    <div class="input-group">
                         <input type="file" name="feature_image">
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
