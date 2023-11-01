@extends('userrole::user.layouts.userMaster')
@section('title')
    | My Orders Details
@endsection

@push('css')
          <style>
           .btn-grad {
            background-image: linear-gradient(to right, #ff9800 0%, #FD017C  51%, #ff9800  100%);
            margin: 10px;
            text-align: center;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 20px #eee;
          }

          .btn-grad:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
          }
        </style> 
@endpush

@section('content') 
     
    <section class="content pt-5">
      <div class="container-fluid">

        
     
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">My Order Details</h3>
                 <a href="{{ route('membership.myOrders')}}" class="btn btn-primary btn-xs ml-2">Back</a>
                <div class="card-tools">
                    <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('membership.myOrderPrint', $order->id) }}">
                        <i class="fas fa-print w3-small"></i> Print</a>
                </div>
            </div>



            <div class="card-body w3-light-gray">

                <div class="card-deck">
                    <div class="card shadow">
                        <div class="card-body">
                        <address>
                            {{$ws->website_title}}<br>
                            {{$ws->contact_address}}
                        </address>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="p-0 m-0">Order Info:</h5>
                            <address>
                                Order Id: {{$order->id}}<br>
                                Order Date: {{$order->created_at->format('d/m/Y')}}<br>
                                Order By: {{$order->user->name}}
                            </address>
                        </div>
                    </div>

                    <div class="card text-center">
                        <div class="
                            @if($order->payment_status == 'unpaid')
                                bg-danger
                            @elseif($order->payment_status == 'paid')
                                bg-success
                            @elseif($order->payment_status == 'partial')
                            w3-light-gray
                            @endif
                            ">
                            <p class="font-weight-bolder btn-lg" style="font-size: 25px;">
                            {{ ucfirst($order->payment_status) }}
                            </p>
                        </div>
                        @php
                            $payment = Cp\Membership\Models\MembershipOrderPayment::where('order_id', $order->id)->first();
                        @endphp

                        @if($payment)
                        <h6 class="text-2 mt-2 p-0">Payment Type : {{ $payment->payment_method ?? ' ' }}</h6>
                        <h6 class="text-2 m-0 p-0">Payment Date : {{ Carbon\Carbon::parse($payment->payment_date ?? '')->format('M d, Y')}} </h6>
                        @endif
                    </div>
                </div>
                <br>

                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive table-responsive-sm">
                            <table class="table table-striped table-bordered">
                                <tr>
                                <th>Description</th>
                                <th>Total</th>
                                </tr>
                                <tr>
                                <td>{{ $order->package->title }}</td>
                                <td>{{ $order->final_price }}</td>
                                </tr>
                            </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-header">
                            <h3 class="card-title">
                            Transaction History
                        </h3>
                    </div>
                    <div class="card-body">
                    <div class="row">
                    <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Payment Status</th>
                                <th>Payment Date</th>
                                <th>Transaction Id</th>
                                <th>Paid Amount</th>
                            </tr>
                            </thead>
                        <tbody>
                            
                            @foreach($order->payments as $payment)  
                            <tr>
                                <td>{{$payment->id}}</td>
                                <td>{{ Str::ucfirst($payment->payment_status) }}</td>
                                <td>{{$payment->payment_date}}</td>
                                <td>{{$payment->transaction_id}}</td>
                                <td>{{$payment->paid_amount}}</td>
                            </tr>                                   @endforeach                   
                        <tbody>
                        </table>
                    </div>
                    </div>
                    </div>
                    </div>
                </div>
               
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <div>
                         @if($order->payment_status == 'unpaid')
                            <button id="sslczPayBtn" class="w3-btn w3-round w3-text-small w3-xlarge btn-lg btn-grad"
                                    token="{{$order->id}}"
                                    postdata=""
                                    order="{{$order->id}}"
                                    endpoint="/pay-via-ajax" style="font-size: 20px !important;"> Pay Online Now
                            </button>
                            
                            @elseif($order->payment_status == 'partial')

                            <button id="sslczPayBtn" class="w3-btn w3-round w3-text-small w3-xlarge shadow-lg btn-grad"
                                    token="{{ $order->id }}"
                                    postdata=""
                                    order="{{ $order->id }}"
                                    endpoint="/pay-via-ajax" style="font-size: 20px !important;"> Pay Online Now(Partail)
                            </button>
                            @else
                                <button type="button" class="btn btn-success btn-lg text-white ">Order Paid</button>
                            @endif
                    </div>
                    <div>
                        @if($order->transaction_id == null && $order->order_status == 'pending')
                        <a onclick="return confirm('Are you sure to delete?')" href="{{ route('membership.cancelMyOrder',$order->id)}}" class="btn btn-danger btn-lg">Cancel Order</a>
                        @endif
                    </div>
                </div>
               
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>


@endsection

@push('js')
<script>
$(function(){
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            @if(env('SSLCZ_TESTMODE'))
            script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            @else
            script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            @endif
            tag.parentNode.insertBefore(script, tag);
        };
    
        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
});
</script>
@endpush




