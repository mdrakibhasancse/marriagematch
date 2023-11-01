<div class="card">
    <div class="card-header">
        <h3 class="card-title">
           <i class="fa fa-user-circle w3-text-deep-orange"></i> 
           My Orders
        </h3>
    </div>
</div>

<div class="card">
    <div class="card-body w3-light-gray">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#SL</th>
                  <th>Action</th>
                  {{-- <th>Id</th> --}}
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
                  <td style="width: 100px">

                    <div class="dropdown show">
                        <a class="btn btn-primary shadow-lg btn-sm dropdown-toggle"  role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a href="{{ route('membership.myOrderDeatils',$order->id)}}" class="dropdown-item"><b><i class="fa fa-eye"></i> Details</b></a>
                         </div>
                    </div>
                 
                  </td>
                  {{-- <td>{{$order->id}}</td> --}}
                  <td>{{$order->created_at->format('d/m/Y')}}</td>
                  <td>{{ucfirst($order->order_status)}}</td>
                  <td>{{ucfirst($order->payment_status)}}</td>
                  <td>{{ucfirst($order->final_price)}}</td>
                  <td>{{ucfirst($order->paid_amount)}}</td>
                </tr>  
                @endforeach
              </tbody>
            </table>
          </div>
    </div>
</div>

   

