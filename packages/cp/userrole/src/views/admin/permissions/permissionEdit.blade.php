@extends('admin::layouts.adminMaster')
@section('title')
    | Permissions All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Permissions All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Permissions All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">


        <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="card shadow">
                        <div class="card-body">



                            <form method="post" action="{{ route('admin.permissionUpdate', $permission) }}">
                                @csrf
                                <label for="permission">Permission Name</label>
                            <div class="input-group input-group-sm ">
                              <input type="text" class="form-control" placeholder="Permission Name" name="name" value="{{ old('name') ?: $permission->name }}" aria-label="Permission Name" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-primary" id="basic-addon2">Save</button>
                              </div>
                            </div>
                            </form>


                              
                             
 

                        </div>
                    </div>
                </div>
            </div>

   

    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
