@extends('admin::layouts.adminMaster')
@section('title')
    | Role user
@endsection

@push('css')
@endpush

@section('content') 

    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Role user</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Role user</li>
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
          <h3 class="card-title">Role user</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
      
          </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#SL</th>
                  <th>Action</th>
                  <th>user Name</th>
                  <th>Email</th>
                  <th>Role Name</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = (($users->currentPage() - 1) * $users->perPage() + 1); ?>
                @foreach($users as $user)
                <tr>
                  <td style="width: 10px">{{$i++}}</td>
                  <td style="width: 80px">
                      <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          
                            <form action="{{ route('admin.roleDetach',$user->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                              @csrf
                              <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </div>
                  </td>
                  <td>{{$user->name}}</td>
                  <td>{{$user->email}}</td>
                   <td>
                      @foreach($user->roles as $role)
                         {{ $role->name }},
                      @endforeach
                   </td>
                </tr>  
                @endforeach
              </tbody>
            </table>
        </div>
      </div>
    </section>
@endsection



@push('js')
    <script>
        
    </script>
@endpush
