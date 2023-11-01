@extends('admin::layouts.adminMaster')
@section('title')
    | Asign Role
@endsection

@push('css')
<style>
    .select2-container--default .select2-selection--single {
    
      height: 37px !important;
      }
  </style>
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Asign Role</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Asign Role</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Asign Role</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.usersAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.assignRoleStore')}}" method="post">
          @csrf
          <div class="card-body">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                      <label for="user_id">User Name
                      </label>
                      <select id="user_id"
                      name="user_id"
                      class="form-control ajaxUserSearch"
                      data-placeholder="Choose User"
                      data-ajax-url="{{ route('admin.ajaxUserSearch')}}"
                      data-ajax-cache="true"
                      data-ajax-dataType="json"
                      data-ajax-delay="200"
                      style="">
                      </select>
                      @error('warehouse_id')
                      <span style="color: red">{{ $message }}</span>
                      @enderror
                    </div>
                
                  <div class="form-group col-md-6">
                      <label for="role_ids">Role Name
                      </label>
                      <select  name="role_ids[]" id="role_ids" class="form-control select2" data-placeholder="Choose Role" multiple>
                          @foreach ($roles as $role)
                              <option value="{{ $role->name }}" 

                              @if ((old('role_ids') and (in_array($role->name, old('role_ids')))))  
                                  selected
                              @endif
                                              
                              > {{ $role->name }}</option>
                          @endforeach

                      </select>
                      @error('role')
                      <span style="color: red">{{ $message }}</span>
                      @enderror
                  </div>
             

                </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
<script>
    $(document).ready(function(){
         $('.ajaxUserSearch').select2({ 
            ajax: {
                data: function (params) {
                    return {
                      q: params.term, // search term
                      page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    // alert(data[0].s);
                    var data = $.map(data, function (obj) {
                      obj.id = obj.id || obj.id;
                      return obj;
                    });
                    var data = $.map(data, function (obj) {
                    obj.text = obj.name +" (" + obj.email +")" ;
                    return obj;
                    });
                    return {
                      results: data,
                      pagination: {
                          more: (params.page * 30) < data.total_count
                      }
                    };
                }
            },
        });

     });

</script>
@endpush
