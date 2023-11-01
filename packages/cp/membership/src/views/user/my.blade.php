@extends('userrole::user.layouts.userMaster')
@section('title')
    | {{request()->type}}
@endsection

@push('css')    
      
@endpush

@section('content') 
     
    <!-- Main content -->
    <section class="content pt-3">

        @include('membership::user.includes.myPageHeader')
        @include('membership::user.includes.myTopButtons')
        @include('membership::user.includes.profiles') 
      
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

