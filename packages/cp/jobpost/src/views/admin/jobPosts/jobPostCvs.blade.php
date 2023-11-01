@extends('admin::layouts.adminMaster')
@section('title')
    | Job Posts All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Job Posts All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Job Posts All</li>
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
          <h3 class="card-title">Job Posts</h3>

          <div class="card-tools">

             <a class="btn btn-primary btn-xs" href="{{ route('admin.jobPostsAll') }}">Back</a>

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
                  <th>Action</th>
                  <th>Download Cv</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = (($dropCvs->currentPage() - 1) * $dropCvs->perPage() + 1); ?>
                @foreach($dropCvs as $dropCv)
                <tr>
                  <td style="width: 10px">{{$i++}}</td>
                  <td style="width: 80px">
                      <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <form action="{{route('admin.dropCvDelete',$dropCv->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                              @csrf
                              <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>

                        </div>
                  </td>
                  
                    <td>
                        @if ($dropCv->cv)
                        <a href="{{ asset('storage/job_post_cvs/'.$dropCv->cv) }}" target="_blank"
                        class="btn btn-success btn-sm ml-1 py-1 px-1">
                        Download Cv</a>
                        @endif
                
                    </td>
                 
                </tr>  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer">
           {{ $dropCvs->render()}}
        </div>
      </div>
    </section>
@endsection




