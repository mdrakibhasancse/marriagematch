@extends('userrole::user.layouts.userMaster')
@section('title')
    | Dashboard
@endsection

@push('css')
@endpush

@section('content') 

<br>

    <!-- Main content -->
    <section class="content">


       @includeIf('membership::user.includes.userDashboardPart')
       
      
    </section>
    <!-- /.content -->

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





