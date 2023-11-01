@extends('userrole::user.layouts.userMaster')
@section('title')
    | Message
@endsection

@push('css')
    
@endpush

@section('content') 
     
    <!-- Main content -->
    <section class="content pt-3">

        @include('membership::user.includes.myPageHeader')
        @include('membership::user.includes.myTopButtons')
        @include('membership::user.includes.userMessagePart') 
      

       
    </section>


@endsection

@push('js')
<script>
        $(document).ready(function() {

       

            $(".direct-chat-messages").animate({
                scrollTop: $('.direct-chat-messages').prop("scrollHeight")
            }, 500);

           

            @if (isset($open))
                @if ($open)
                    $(".chat-contacts-btn").click();
                @endif
            @endif

        });
    </script>
@endpush


