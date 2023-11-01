@extends('admin::layouts.adminMaster')
@section('title')
    | Orders All
@endsection

@push('css')
@endpush

@section('content') 

    <!-- Main content -->
    <section class="content pt-5">
      <div class="container-fluid">
     
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Order Details</h3>
                <div class="card-tools">
                    <a class="btn btn-primary btn-xs" target="_blank" href="{{ route('admin.orderPrint', $order->id) }}"><i class="fas fa-print w3-small"></i> Print</a>
                </div>
            </div>
            <div class="card-body w3-light-gray">
                 
                <div class="card-deck">
                    <div class="card shadow">
                        <div class="card-body text-center">
                         <img  class="w3-100 w3-round" src="{{ route('imagecache', [ 'template'=>'ppmd','filename' => $ws->logo() ]) }}" alt="mmbdLogo">
                        <address>
                            {{$ws->website_title}}<br>
                            {{$ws->contact_address}}
                        </address>
                        </div>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            <h5 class="p-0 m-0">Order Info :</h5>
                            <address>
                                Order Id: {{$order->id}}<br>
                                Order Date: {{$order->created_at->format('d/m/Y')}}<br>
                                Order Status : {{$order->order_status}}<br>
                                Payment Status : {{$order->payment_status}}<br>
                                <h5 class="p-0 m-0">User Info :</h5>
                                Id : <a href="{{ route('admin.usersAll',['id' =>$order->user_id])}}">{{$order->user_id}}</a><br>
                                Name : {{$order->user->name}}<br>
                                Mobile : {{$order->user->mobile}}<br>
                                Email : {{$order->user->email}}
                            </address>
                        </div>
                    </div>
                </div>
                <br>
               
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="card-title">
                            Order Status
                        </h3>
                    </div>
                    <form action="{{ route('admin.orderStatus',$order->id)}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select name="order_status" id="order_status" class="form-control">
                                            <option value="">order status</option>
                                            @foreach (config('m_parameter.order_status') as $item)
                                                <option value="{{ $item }}" {{ $item == $order->order_status ? 'selected' : ' '}}>{{ Str::ucfirst($item) }}</option>
                                            @endforeach
                                        </select>
                                        @error('order_status')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <button type="submit" class="form-control btn btn-primary btn-block">Submit</button>
                                </div>
                            
                            </div>
                        </div>
                    </form>
                </div>

                @if($order->due() > 0)

                    <form action="{{ route('admin.orderPayment',$order->id) }}" method="post">
                    
                    @csrf

                    <div class="card shadow">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-credit-card"></i> 
                                Add Payment
                            </h3>
                        </div>
                        <div class="card-body">
                                <div class="row">
                                <div class="col-md-6">
                                <div class="card shadow" style="margin-bottom: 5px;">
                                <div class="card-body ">
                                    
                                    <div class="form-group input-group-sm w3-light-gray row mb-1">
                                        <label for="payment_date" class="col-sm-5 col-form-label">Payment Date</label>
                                        <div class="col-sm-7">
                                        <input type="date" class="form-control mt-1 form-control-sm " id="payment_date" value="{{ old('payment_date') ? : date('Y-m-d') }}" name="payment_date" required>
                                        @error('payment_date')
                                            <span style="color:red;">{{ $message }}</span>
                                        @enderror
                                        </div>

                                    </div>
                                     
                                    <div class="form-group input-group-sm mb-1 row w3-light-gray">
                                        <label for="payement_method" class="col-sm-5 col-form-label">Payment Method</label>
                                        <div class="col-sm-7">

                                            <input type="text" class="form-control mt-1 form-control-sm " id="payment_method" value="" placeholder="payment method" list="payment_methods" name="payment_method" required>

                                            <datalist id="payment_methods">
                                                @foreach (config('m_parameter.payment_method') as $item)
                                                    <option value="{{ $item }}" {{ old('payment_method') == $item  ? 'selected' : ' '}}>{{ $item }}</option>
                                                @endforeach
                                            </datalist>
                                            @error('payment_method')
                                                <span style="color:red;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                    </div>

                                    <div class="form-group input-group-sm row w3-light-gray mb-1">
                                        <label for="transaction_id" class="col-sm-5 col-form-label">Trans ID</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control bg-light mt-1 form-control-sm" id="transaction_id" name="transaction_id"
                                        value="{{ old('transaction_id')}}" placeholder="Transaction Id">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow" style="margin-bottom: 5px;">
                            <div class="card-body">

                                <div class="form-group input-group-sm mb-1 row w3-light-gray">
                                    <label for="paid_amount" class="col-sm-5 col-form-label">Paid Amount</label>
                                    <div class="col-sm-7">
                                        <input type="number" class="form-control mt-1 form-control-sm " id="paid_amount" value="{{old('paid_amount') ?: $order->due()}}"  name="paid_amount" min="1" step="any" max="{{$order->due()}}" placeholder="Paid Amount" required>
                                        @error('paid_amount')
                                            <span style="color:red;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group input-group-sm row w3-light-gray mb-1">
                                        <label for="remarks" class="col-sm-5 col-form-label">Note</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control bg-light mt-1 form-control-sm " placeholder="Note" id="note" value="" name="note">
                                        </div>
                                </div>


                                <div class="form-group input-group-sm row w3-light-gray mb-1">

                                        <div class="col-sm-5"></div>

                                        <div class="col-sm-7">

                                        <button type="submit" class="btn btn-primary btn-block btn-sm">Save</button>

                                        </div>
                                </div>
                                </div>
                            </div>
                            </div>
                            
                    
                        </div>
                        </div>
                    </div>
                    </form>
                              
                @endif

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
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection




