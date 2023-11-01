@extends('admin::layouts.adminMaster')
@section('title')
    | Menu Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Menu Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Menu Edit</li>
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
            <h4 class="card-title">Edit Menu</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.menusAll') }}"> Back</a>
            </div>
        </div>
        
        <form action="{{ route('admin.menuUpdate',$menu->id)}}" method="post">
          @csrf
         <div class="card-body">
            <div class="card card-widget mb-0">
              <div class="card-body w3-gray">
                <div class="card card-widget mb-0 text-dark">
                  <div class="card-body">
                  
                    <div class="form-group">
                      <label for="">Menu Name</label>
                      <input type="text" name="name" class="form-control" value="{{$menu->name}}" placeholder="Enter Menu Name">
                      @error('name')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="">Menu Type</label>
                        <select name="type" id="type" class="form-control">
                        <option value="">select menu type</option>
                        @foreach (config('parameter.menu_type') as $item)
                          <option value="{{ $item }}" {{ $item == $menu->type ? 'selected' : ' '}}>{{ $item }}</option>
                        @endforeach
                        </select>
                      @error('type')
                      <div class="alert alert-danger">{{ $message }}</div>
                      @enderror
                    </div>


                    <div class="form-group">
                      <label for="">Menu Link</label>
                      <input type="text" name="link" class="form-control" value="{{$menu->link}}" placeholder="Enter Menu link">
                    </div>

                    <div class="checkbox pl-1">
                      <label><input type="checkbox"  name="active" value="1" {{($menu->active == '1') ? 'checked' : ''}}> Active</label>
                    </div>

                  </div>
                </div>

              </div>

            </div>

          </div>
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
