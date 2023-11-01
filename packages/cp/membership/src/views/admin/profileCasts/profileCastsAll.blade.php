@extends('admin::layouts.adminMaster')
@section('title')
    | Profile Casts All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Casts All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Profile Casts All</li>
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
                  <div class="col-md-8">
                     <form class="form-inline" method="post" action="{{ route('admin.profileCastStore')}}">
                      @csrf
                        <div class="form-group ">
                            <label for="name">Cast Name: &nbsp;</label>
                            <input type="text" name="name" value="{{ old('name')}}" placeholder="Name" class="form-control" id="name">
                        </div>
                         &nbsp;&nbsp;
                        <div class="form-group ">
                            <label for="religion_id">Religion Name: &nbsp;</label>
                            <select name="religion_id" class="form-control" id="religion_id">
                              <option value="">Religion Name</option>
                                @foreach($religions as $religion)
                                    <option value="{{ $religion->id }}" {{ old('religion_id') == $religion->id ? "selected" : '' }}>
                                      {{$religion->name}}</option>
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

       <div class="card">
        <div class="card-header">
          <h3 class="card-title">Cast Lists</h3>

          <div class="card-tools">

          </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th style="width: 10px">#SL</th>
                    <th>Name</th>
                    <th>Under Religion</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = (($casts->currentPage() - 1) * $casts->perPage() + 1); ?>
                  @foreach($casts as $cast)
                  <tr>
                    <td style="width: 10px">{{$i++}}</td>
                   
                    <td>{{$cast->name}}</td>
                    <td>{{$cast->religion->name ?? ''}}</td>

                     <td>
                        <div class="dropdown show">
                          <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </a>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a href="{{ route("admin.profileCastEdit",$cast->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>


                              <form action="{{route('admin.profileCastDelete',$cast->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
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
            {{ $casts->render() }}
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
