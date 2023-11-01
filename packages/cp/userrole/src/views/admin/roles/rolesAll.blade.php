@extends('admin::layouts.adminMaster')
@section('title')
    | Roles All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Roles All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Roles All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Roles</h3>

          <div class="card-tools">
            

            {{-- @can('role-create') --}}
            <a class="btn btn-primary btn-xs" href="{{ route('admin.roleCreate') }}"> Create New Role</a>
            {{-- @endcan --}}

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

                    <?php $i = (($roles->currentPage() - 1) * $roles->perPage() + 1); ?>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-info btn-xs" href="{{ route('admin.roleShow', $role) }}">Show</a>

                                <a class="btn btn-primary btn-xs"
                                    href="{{ route('admin.roleEdit', $role) }}">Edit</a>

                                @if(str_contains($role->name, 'admin'))

                                @else
        
               

                                <a href=""  onclick="event.preventDefault();
                                                     document.getElementById('delete-form').submit();" 
                                                     class="btn btn-danger btn-xs">Delete</a>

                                 <form onsubmit="return confirm('Do you really want to delete this?');" id="delete-form" action="{{ route('admin.roleDelete', $role) }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                @endif
                                

                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            {!! $roles->render() !!}
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
