@extends('admin::layouts.adminMaster')
@section('title')
    | Roles Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Role Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

       <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Update Role: {{ $role->name }}</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.rolesAll') }}"> Back</a>
            </div>
        </div>
        <div class="card-body">

            <form method="post" action="{{ route('admin.roleUpdate', $role) }}">
               
               @csrf

              <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" class="form-control" id="role_name" name="role_name" value="{{ old('role_name') ?: $role->name }}" placeholder="Role Name ">
              </div>
              
                <div class="row">
                @foreach($permissions->chunk(ceil($permissions->count() / 2)) as $permission2)

                <div class="col-6">

                    @foreach($permission2 as $permission)

                    <div class="custom-control custom-checkbox">

                 <input type="checkbox" class="custom-control-input"  name="permissions[]" id="permission_{{ $permission->id }}" value="{{ $permission->id }}"  {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                 <label class="custom-control-label" for="permission_{{ $permission->id }}">{{ $permission->name }}</label>
               </div>

               @if(str_contains($permission->name, 'delete'))
               <hr>
               @endif


                    @endforeach
                    
                </div>


               
                 @endforeach
                 </div>

              <button type="submit" class="btn btn-primary ">Save</button>
            </form>


            

            {{-- {!! Form::model($role, ['method' => 'PATCH', 'route' => ['admin.roles.update', $role->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Name:</strong>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control','readonly'=>true]) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br />
                        @foreach ($permission as $value)
                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, ['class' => 'name']) }}
                                {{ showPermission($value->name) }}</label>
                            <br />
                        @endforeach
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
            {!! Form::close() !!} --}}

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
