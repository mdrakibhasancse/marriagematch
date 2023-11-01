@extends('admin::layouts.adminMaster')
@section('title')
    | Role Show
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role Show</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Role Single</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="card">
            <div class="card-header bg-info">
                <h4 class="card-title">Show Role</h4>
                <div class="card-tools">
                    <a class="btn btn-primary btn-xs" href="{{ route('admin.rolesAll') }}"> Back</a>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permissions:</strong> <br>
                             
                        </div>



                         <div class="row">
                            @php
                            $i = 1;
                            @endphp
                @foreach($rolePermissions->chunk(ceil($rolePermissions->count() / 2)) as $permission2)

                <div class="col-6">

                    @foreach($permission2 as $permission)

                    
                   ({{ $i++ }}) {{ $permission->name }} <br>
               

               @if(str_contains($permission->name, 'delete'))
               <hr>
               @endif


                    @endforeach
                    
                </div>


               
                 @endforeach
                 </div>


                    </div>
                </div>
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
