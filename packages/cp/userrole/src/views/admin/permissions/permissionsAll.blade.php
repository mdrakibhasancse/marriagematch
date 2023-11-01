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
                            <form method="post" action="{{ route('admin.permissionStore') }}">
                                @csrf
                                <label for="permission">New Permission Create</label>
                            <div class="input-group input-group-sm ">
                              <input type="text" class="form-control" placeholder="Permission Name" name="name" value="{{ old('name') }}" aria-label="Permission Name" aria-describedby="basic-addon2">
                              <div class="input-group-append">
                                <button type="submit" class="input-group-text bg-primary" id="basic-addon2">Save</button>
                              </div>
                            </div>
                            </form>
 

                        </div>
                    </div>
                </div>
            </div>

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Permissions</h3>

          <div class="card-tools">
            
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
             
          </div>
        </div>
        <div class="card-body">

            


            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th width="280px">Action</th>
                    </tr>

                    <?php $i = (($permissions->currentPage() - 1) * $permissions->perPage() + 1); ?>
                    @foreach ($permissions as $key => $permission)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                 

                                <a class="btn btn-primary btn-xs"
                                    href="{{ route('admin.permissionEdit', $permission) }}">Edit</a>

                                     <a href=""  onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" 
                                                     class="btn btn-danger btn-xs">Delete</a>

                                 <form onsubmit="return confirm('Do you really want to delete this?');" id="delete-form" action="{{ route('admin.permissionDelete', $permission) }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {!! $permissions->render() !!}
        </div>
        <!-- /.card-body -->
    
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
        
    </script>
@endpush
