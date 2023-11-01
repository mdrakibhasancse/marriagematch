@extends('admin::layouts.adminMaster')
@section('title')
    | User Cv Pictures
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Cv Pictures</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User Cv Pictures</li>
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
          <h3 class="card-title">Pictures</h3>

          <div class="card-tools">

            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
      
          </div>
        </div>
        <div class="card-body">
           <div class="table-responsive">
             <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="width: 10px">#SL</th>
                  <th width="130">Action</th>
                  <th>User Id</th>
                  <th width="110">Date</th>
                  <th width="130">Download Cv</th>
                  <th>profile Picture</th>
                  <th>Extra Picture First</th>
                  <th>Extra Picture Second</th> 
                  <th>Extra Picture Third</th>
                  <th>Profile</th>
                </tr>
              </thead>
               <tbody>
                <?php $i = (($userCvPictures->currentPage() - 1) * $userCvPictures->perPage() + 1); ?>
                @foreach($userCvPictures as $cvPictures)
                <tr>
                  <td style="width: 10px">{{$i++}}</td>
                  <td width="130">
                    @if($cvPictures->userProfile)
                      <a class="btn btn-primary btn-xs" href="{{ route('admin.userEdit',$cvPictures->user_id)}}"> Edit Profile</a>
                    @else
                        <a class="btn btn-primary btn-xs" href="{{ route('admin.createCvPictureProfileStore',$cvPictures->id)}}" onclick="return confirm('Are you sure?')"> Create Profile</a>
                    @endif
                  </td>
                  <td><a href="{{ route('admin.usersAll',['id' =>$cvPictures->user_id])}}">{{ $cvPictures->user_id }}</a></td>
                  <td> {{ \Carbon\Carbon::parse($cvPictures->create_at)->format('d/m/Y')}} </td>
                 
                 <td  style="width: 130px;">
                   <a href="{{ asset('storage/cv/'.$cvPictures->cv) }}" class="btn btn-primary btn-sm" download>Download Cv</a>
                   
                 </td>


                  <td  class="px-1 py-0"><img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $cvPictures->fi()]) }}" alt="profile">
                    <a href="{{ asset('storage/photo/'.$cvPictures->fi()) }}" class="btn btn-primary btn-sm" download>
                       <i class="fa fa-download "></i>
                    </a>
                  </td>

                  <td  class="px-1 py-0"><img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $cvPictures->firstPic()]) }}" alt="profile">
                    <a href="{{ asset('storage/photo/'.$cvPictures->firstPic()) }}"class="btn btn-primary btn-sm" download>
                       <i class="fa fa-download "></i>
                    </a>
                  </td>
                  <td  class="px-1 py-0"><img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $cvPictures->secondPic()]) }}" alt="profile">
                   <a href="{{ asset('storage/photo/'.$cvPictures->secondPic()) }}" class="btn btn-primary btn-sm" download>
                       <i class="fa fa-download "></i>
                    </a>
                  </td>
                  <td  class="px-1 py-0"><img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $cvPictures->thirdPic()]) }}" alt="profile">
                    <a href="{{ asset('storage/photo/'.$cvPictures->thirdPic()) }}" class="btn btn-primary btn-sm" download>
                       <i class="fa fa-download "></i>
                    </a>
                  </td>
            

               
                  
                  <td>{!!$cvPictures->userProfile ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-danger">No</span>'!!}</td>

            
                  
                </tr>  
                @endforeach
              </tbody>
             </table>
           </div>
        </div>
       <div class="card-footer">
            {{ $userCvPictures->links() }}
        </div>
      </div>
    </section>
@endsection



@push('js')
    <script>
        
    </script>
@endpush
