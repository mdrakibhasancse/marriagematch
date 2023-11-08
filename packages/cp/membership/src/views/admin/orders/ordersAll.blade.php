@extends('admin::layouts.adminMaster')
@section('title')
    | Orders ({{request()->type ?? $user->name}})
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
               <h1>Orders ({{request()->type ?? $user->name}})</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Orders ({{request()->type ?? $user->name}})</li>
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
          <h3 class="card-title">Orders ({{request()->type ?? $user->name}})</h3>

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
                  <th>Id</th>
                  <th>User Id</th>
                  <th>Name</th>
                  <th>Mobile</th>
                  <th>Date</th>
                  <th>Order Status</th>
                  <th>Payment Status</th>
                  <th>Order Amount</th>
                  <th>Paid Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = (($orders->currentPage() - 1) * $orders->perPage() + 1); ?>
                @foreach($orders as $order)
                <tr>
                  <td style="width: 10px">{{$i++}}</td>
                  <td style="width: 120px">

                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                      <a href="{{ route('admin.orderDeatils',$order->id)}}" class="btn btn-primary">Details</a>

                      <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                           <form action="{{ route('admin.orderDelete',$order->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash text-danger"></i> Delete</button>
                            </form>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>{{$order->id}}</td>
                  <td><a href="{{ route('admin.usersAll',['id' =>$order->user_id])}}">{{$order->user_id}}</a></td>
                  <td>{{$order->user->name}}</td>
                  <td>{{$order->user->mobile}}</td>
                  <td>{{$order->created_at->format('d/m/Y')}}</td>
                  <td>{{$order->order_status}}</td>
                  <td>{{$order->payment_status}}</td>
                  <td>{{ucfirst($order->final_price)}}</td>
                  <td>{{ucfirst($order->paid_amount)}}</td>
                </tr>  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer">
           {{ $orders->render()}}
        </div>
      </div>
    </section>
@endsection




