@extends('admin::layouts.adminMaster')
@section('title')
    | Users All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users ({{request()->type}})</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Users ({{request()->type}})</li>
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
          <h3 class="card-title">Users ({{request()->type}})</h3>

          <div class="card-tools d-flex">

            <div class="input-group input-group-sm mr-2">
              <input type="search" name="q"  class="user-search form-control float-right" data-url="{{ route('admin.userSearchAjax',['type'=> request()->type, 'userid'=>request()->userid]) }}"  placeholder="Search name, email, mobile, id...">
                  <div class="input-group-append ">
                      <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                      </button>
                  </div>
              </div>

             <a class="btn btn-primary btn-xs" style="width: 200px;" href="{{ route('admin.userCreate') }}"> Create New User</a>

              

            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
      
          </div>
        </div>
        <div class="card-body" style="white-space: nowrap;">
           <div class="table-responsive data-container">
               @includeIf('userrole::admin.users.searchData')
           </div>
        </div>
      </div>
    </section>
@endsection



@push('js')
<script>
  $(document).ready(function () {
    $(document).on('keyup', ".user-search", function(e){

        e.preventDefault();
        var that = $( this );
        var url = that.attr('data-url');
        var q = that.val();

        $.ajax({
              url: url,
              data : {q:q},
              method: "get",
              success: function(res)
              {
                if(res.success)
                {
                    $(".data-container").empty().append(res.page);
                }
              }
        });
    });


    $(document).on('click', '.pagination a', function(e) {
      e.preventDefault();
      var url = $(this).attr('href');
      $.ajax({
              url: url,
              method: "get",
              success: function(res)
              {
                if(res.success)
                {
                    $(".data-container").empty().append(res.page);
                }
              }
        });
            
    });

  });
</script>
@endpush
