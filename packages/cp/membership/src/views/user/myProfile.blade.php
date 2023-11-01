@extends('userrole::user.layouts.userMaster')
@section('title')
    | Dashboard
@endsection

@push('css')
    
@endpush

@section('content') 
     
    <!-- Main content -->
    <section class="content pt-3">

        @include('membership::user.includes.myPageHeader')
        @include('membership::user.includes.myTopButtons')
        @include('membership::user.includes.myProfilePart')
  
      
    </section>


@endsection

@push('js')
<script src="{{asset('/')}}alt/plugins/datatables-buttons/js/buttons.print.min.js"></script>

@endpush