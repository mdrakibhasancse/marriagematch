@extends('userrole::user.layouts.userMaster')
@section('title')
    | {{request()->type}}
@endsection

@push('css')
    
@endpush

@section('content') 
     
    <!-- Main content -->
    <section class="content pt-3">


        @include('membership::user.includes.myTopButtons')
        @include('membership::user.includes.paymentButton')
        <div class="card">
        <div class="card-header">
                <h3 class="card-title">
                <i class="fa fa-user-circle w3-text-deep-orange"></i> 
                  {{-- Search Profile --}}
                  {{ translate('search_profile') }}
                </h3>
            </div>
        </div>
        @foreach($users as $user)
        @include('membership::user.includes.userProfileCard')
        @endforeach
      
    </section>


@endsection


@push('js')
    <script>
        $(document).ready(function () {
        
            $(document).on("click", ".proposalSend", function(e) {

                e.preventDefault();
                var that = $(this);
                var q = that.val();
                var url = that.attr('data-url');
                $('#proposalSentModal').modal('show');
                    $.ajax({
                        url: url,
                        method: "get",
                        success: function(result){
                            // console.log(result); 
                         $(".contentContainer").empty().append(result.page);
  
                        }
                    });
            }); 

        }); 

    </script>
@endpush

