@extends('admin::layouts.adminMaster')
@section('title')
    | Profile Setting Values All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Setting Values All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Setting Values All</li>
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
                  <div class="col-md-11">
                     <form class="form-inline" method="post" action="{{ route('admin.profileSettingValueStore')}}">
                      @csrf
                        <div class="form-group">
                            <label for="name">Value Name: &nbsp;</label>
                            <input type="text" name="name" value="{{ old('name')}}" placeholder="Name" class="form-control" id="name">
                        </div>
                         &nbsp;&nbsp;
                        <div class="form-group">
                            <label for="profile_setting_field_id">Field Name: &nbsp;</label>
                            <select name="profile_setting_field_id" class="form-control" id="profile_setting_field_id">
                              <option value="">Field Name</option>
                                @foreach($fields as $field)
                                    <option value="{{ $field->id }}" {{ old('profile_setting_field_id') == $field->id ? "selected" : '' }}>
                                      {{$field->name}}</option>
                                @endforeach

                            </select>
                        </div>
                       
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <label for="name">gender: &nbsp;</label>
                            <select name="gender" class="form-control" id="gender">
                              <option value="">Gender</option>
                                @foreach(config('m_parameter.gender') as $field)
                                    <option value="{{ $field }}" {{ old('gender') == $field ? "selected" : '' }}>
                                      {{$field}}</option>
                                @endforeach

                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Add</button>

                      </form>
                  </div>
              </div>
          </div>
       </div>
      <!-- Default box -->

      




      <div class="card card-success card-outline">     
          <div class="card-body">
             <h5 class="p-0 m-0">All Profile Setting Field Values</h5>
          </div>
      </div>


       @foreach($fields as $field)
       @if($field->values->count())
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
                <strong>ID {{ $field->id }}:&nbsp;&nbsp;&nbsp;&nbsp; {{ $field->name }}</strong>
            </h3>
          </div>

          
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#SL</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($field->values as $value)
                    <tr>
                      <td style="width: 10px">{{$loop->iteration}}</td>
                    
                      <td>{{$value->name}}</td>
                      <td>{{$value->gender}}</td>
                      <td>
                          <div class="dropdown show">
                            <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route("admin.profileSettingValueEdit",$value->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>


                                <form action="{{route('admin.profileSettingValueDelete',$value->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                  @csrf
                                  <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                      </td>

                    </tr>  
                    @endforeach
                  </tbody>
                </table>
            </div>
          </div>
         
        </div> 
       @endif    
       @endforeach

      
      
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
