@extends('admin::layouts.adminMaster')
@section('title')
    | Profile Parameter Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Parameter Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Parameter Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       <div class="card">
          <div class="card-body">
              <div class="row justify-content-center">
                  <div class="col-md-12">
                     <form class="form-inline" method="post" action="{{ route('admin.profileParameterUpdate',$parameter->id)}}">
                      @csrf
                        <div class="form-group ">
                            <label for="field_name">Field Name: &nbsp;</label>
                            <input type="text" name="field_name" value="{{ $parameter->field_name ?? old('field_name') }}" placeholder="Field Name" class="form-control" id="field_name" readonly>
                        </div>

                        &nbsp;&nbsp;
                      
                          <div class="form-group">
                              <label for="field_value">Field Value: &nbsp;</label>
                              <input type="text" name="field_value" value="{{ $parameter->field_value ?? old('field_value') }}" placeholder="Field Value" class="form-control" id="field_value">
                          </div>
                     

                        &nbsp;&nbsp;
                        <div class="form-group">
                            <label for="name">Gender: &nbsp;</label>
                              <select name="gender" class="form-control" id="gender">
                              <option value="">Gender</option>
                                @foreach(config('m_parameter.gender') as $field)
                                    <option value="{{ $field }}" {{ $parameter->gender == $field ? "selected" : '' }}>
                                      {{$field}}</option>
                                @endforeach

                            </select>
                        </div>

                        &nbsp;&nbsp;
                        <div class="form-group">
                          <div class="checkbox">
                            <label><input type="checkbox"  name="active" {{  $parameter->active == 1 ? 'checked' : '' }}> &nbsp;Active</label>
                          </div>
                        </div>
                         &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Update</button>

                      </form>
                  </div>
              </div>
          </div>
       </div>
      <!-- Default box -->

      
      
    </section>
@endsection



@push('js')
    <script>
        $( document ).ready(function() {
            $('input[name=toogle]').change(function(){
                var that = $( this );
                var url  = that.attr('data-url');
                var id   = that.val()
                var mode = that.prop('checked');
                $.ajax({
                    url : url,
                    type: "POST",
                    data:{
                        _token:'{{csrf_token()}}',
                        mode:mode,
                        id:id,
                    },
                    success:function(response){
                        if(response.status){
                            alert(response.msg);
                        }
                        else{
                            alert('please try again');
                        }
                    }
                })
            });
        });


    </script>
@endpush
