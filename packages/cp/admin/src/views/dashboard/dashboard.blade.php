@extends('admin::layouts.adminMaster')
@section('title')
    | Admin Dashboard
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ url('/')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content" style="min-height: 700px;">
  <div class="row">
    <div class="col-sm-12">
      <div class="w3-card-4 w3-border w3-border-blue w3-round">
        <div class="card card-widget" style="margin-bottom: 0;">
          <div class="card-header with-border">
            <h3 class="card-title">
              Welcome back, Admin 
              {{-- <img src="https://www.bridegroombd.com/img/online.gif" alt="Online" style="width: 20px;"> --}}
            </h3>
          </div>
          <div class="card-body w3-animate-zoom" style="background: #000AFF">
            <div class="row">

              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-bottom" href="{{ route('admin.usersAll',['pendingUsers']) }}" target="_blank">
                  <div class="card text-center">
                    <div class="card-header">
                       <b>Pending Users</b>
                    </div>
                    <div class="card-body w3-pink w3-xlarge w3-hover-red">
                     <b>{{$pendingUsers}}</b>
                    </div>
                  </div>
                </a>
              </div>
              
              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-bottom" href="{{ route('admin.usersAll',['activeUsers']) }}" target="_blank">
                <div class="card  card-default text-center">
                  <div class="card-header">
                    <b>Active Users</b>
                  </div>
                  <div class="card-body w3-pink w3-xlarge w3-hover-red">
                    <b>{{ $activeUsers }}</b>
                  </div>
                </div>
            </a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-bottom" href="{{ route('admin.usersAll',['inactiveUsers']) }}" target="_blank">
                  <div class="card  card-default text-center">
                    <div class="card-header">
                      <b>Incative Users</b>
                    </div>
                    <div class="card-body w3-pink w3-xlarge w3-hover-red">
                      <b>{{ $inactiveUsers }}</b>
                    </div>
                  </div>
                </a>
              </div>


              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-opacity" href="{{ route('admin.usersAll',['usersToday']) }}" target="_blank">
                  <div class="card card-default text-center">
                    <div class="card-header">
                       <b>Users Today</b>
                    </div>
                    <div class="card-body w3-pink w3-xlarge w3-hover-red">
                       <b>{{ $todaytUsers }}</b>
                    </div>
                  </div>
                </a>
              </div>


              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-opacity" href="{{ route('admin.usersAll',['usersThisMonth']) }}" target="_blank">
                  <div class="card  card-default text-center">
                    <div class="card-header">
                      <b>This Month Users</b>
                    </div>
                    <div class="card-body w3-pink w3-xlarge w3-hover-red">
                      <b>{{ $thisMontUsers }}</b>
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-opacity" href="{{ route('admin.usersAll',['paidUsers']) }}" target="_blank">
                  <div class="card  card-default text-center">
                    <div class="card-header">
                      <b>Paid Users</b>
                    </div>
                    <div class="card-body w3-pink w3-xlarge w3-hover-red">
                      <b>{{ $paidUsers }}</b>
                    </div>
                  </div>
                </a>
              </div>

              <div class="col-sm-2">
                <a class="btn btn-block w3-animate-opacity" href="{{ route('admin.usersAll',['freeUsers']) }}" target="_blank">
                  <div class="card  card-default text-center">
                    <div class="card-header">
                      <b>Free Users</b>
                    </div>
                    <div class="card-body w3-pink w3-xlarge w3-hover-red">
                      <b>{{ $freeUsers }}</b>
                    </div>
                  </div>
                </a>
              </div>

            </div>
            
            </div>     
          </div>
          
        </div>
      </div>

    </div>
  </section>

@endsection



@push('js')
    <script>
        
    </script>
@endpush
