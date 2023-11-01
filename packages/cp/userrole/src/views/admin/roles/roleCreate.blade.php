@extends('admin::layouts.adminMaster')
@section('title')
    | Roles Create
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Role Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Create New Role</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.rolesAll') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.roleStore') }}">
               
               @csrf

              <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" class="form-control" id="role_name" name="role_name" value="{{ old('role_name') }}" placeholder="Role Name ">
              </div>
              
                <div class="row">
                @foreach($permissions->chunk(ceil($permissions->count() / 2)) as $permission2)

                <div class="col-6">

                    @foreach($permission2 as $permission)

                    <div class="custom-control custom-checkbox">

                 <input type="checkbox" class="custom-control-input" name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}">
                 <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
               </div>

               {{-- @if(str_contains($permission->name, 'delete'))
               <hr>
               @endif --}}


                    @endforeach
                    
                </div>


               
                 @endforeach
                 </div>

              <button type="submit" class="btn btn-primary ">Save</button>
            </form>

 
        </div>
    </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
