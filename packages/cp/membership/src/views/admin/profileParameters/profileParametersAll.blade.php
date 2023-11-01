@extends('admin::layouts.adminMaster')
@section('title')
    | Profile Parameters All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Parameters All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Parameters All</li>
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
                     <form class="form-inline" method="post" action="{{ route('admin.profileParameterStore')}}">
                      @csrf
                        <div class="form-group">
                            <label for="field_name">Field Name: &nbsp;</label>
                            <input type="text" name="field_name" value="{{ old('field_name')}}" placeholder="Field Name" class="form-control" id="field_name">
                        </div>
                         &nbsp;&nbsp;
                        <div class="form-group">
                            <label for="field_value">Field Value: &nbsp;</label>
                             <input type="text" name="field_value" value="{{ old('field_value')}}" placeholder="Field Value" class="form-control" id="field_value">
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
             <h5 class="p-0 m-0">All Profile Parameters</h5>
          </div>
      </div>


       @foreach($parameters as $parameter)
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
               {{ $parameter->field_name }}
            </h3>
          </div>

          
          <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">#SL</th>
                      <th>field Value</th>
                      <th>Gender</th>
                      <th>Active</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($parameter->children() as $item)
                    <tr>
                      <td style="width: 10px">{{$loop->iteration}}</td>
                    
                      <td>{{$item->field_value}}</td>
                      <td>{{$item->gender}}</td>
                      <td>{!!$item->active == 1 ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-danger">No</span>'!!}</td>
                 
                      <td>
                          <div class="dropdown show">
                            <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route("admin.profileParameterEdit",$item->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>


                                <form action="{{route('admin.profileParameterDelete',$item->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
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
       @endforeach

      

      
      
    </section>
@endsection



@push('js')
    
@endpush
