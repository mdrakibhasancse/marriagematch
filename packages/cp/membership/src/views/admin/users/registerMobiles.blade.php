@extends('admin::layouts.adminMaster')
@section('title')
    | Resgister Mobiles
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Resgister Mobiles</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Resgister Mobiles</li>
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
          <h3 class="card-title">Resgister Mobiles</h3>

          <div class="card-tools">

            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
      
          </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#SL</th>
                  <th>Action</th>
                  <th>Mobile</th>
                </tr>
              </thead>
               <tbody>
                <?php $i = (($registerMobiles->currentPage() - 1) * $registerMobiles->perPage() + 1); ?>
                @foreach($registerMobiles as $mobile)
                <tr>
                  <td style="width: 10px">{{$i++}}</td>
                  <th>
                    <a href="{{ route('admin.registerMobileDelete',$mobile)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                  </th>
                  <td>{{$mobile->mobile}}</td>
                </tr>  
                @endforeach
              </tbody>
             </table>
           </div>
        </div>
       <div class="card-footer">
            {{ $registerMobiles->links() }}
        </div>
      </div>
    </section>
@endsection



@push('js')
    <script>
        
    </script>
@endpush
