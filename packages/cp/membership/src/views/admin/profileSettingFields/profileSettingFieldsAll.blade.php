@extends('admin::layouts.adminMaster')
@section('title')
    | Profile Setting Fields All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Setting Fields All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Setting Fields All</li>
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
                  <div class="col-md-10">
                     <form class="form-inline" method="post" action="{{ route('admin.profileSettingFieldStore')}}">
                      @csrf

                       <div class="form-group ">
                            <label for="group_name">Group Name: &nbsp;</label>
                            <input type="text" name="group_name" value="{{ old('group_name') }}" placeholder="Group name" class="form-control" id="group_name">
                        </div>
                          &nbsp;&nbsp;
                        <div class="form-group ">
                            <label for="name">Field Name: &nbsp;</label>
                            <input type="text" name="name" value="{{ old('name')}}" placeholder="Field Name" class="form-control" id="name"> 
                        </div>
                       &nbsp;&nbsp;
                         <div class="form-group">
                          <div class="checkbox">
                            <label><input type="checkbox"  name="multiple_value" {{ old('multiple_value') ? 'checked' : ''}}> &nbsp;Multiple Value</label>
                          </div>
                        </div>
                       &nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Add</button>

                      </form>
                  </div>
              </div>
          </div>
       </div>
      <!-- Default box -->

       <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Profile Setting Fields</h3>

          <div class="card-tools">

          </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#SL</th>
                    <th>Group Name</th>
                    <th>Name</th>
                    <th>Multiple Value</th>
                    <th>Active</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = (($fields->currentPage() - 1) * $fields->perPage() + 1); ?>
                  @foreach($fields as $field)
                  <tr>
                    <td style="width: 10px">{{$i++}}</td>
                    <td>{{$field->group_name}}</td>
                    <td>{{$field->name}}</td>
                    

                    <td>{!!$field->multiple_value ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-danger">No</span>'!!}</td>

                    <td>{!!$field->active ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-danger">No</span>'!!}</td>

                      
                   

                     <td>
                        <div class="dropdown show">
                          <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </a>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a href="{{ route("admin.profileSettingFieldEdit",$field->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>


                              <form action="{{route('admin.profileSettingFieldDelete',$field->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
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
         <div class="card-footer">
            {{ $fields->render() }}
        </div>
      </div>
      
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
