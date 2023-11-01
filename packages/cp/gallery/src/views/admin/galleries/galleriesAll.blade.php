@extends('admin::layouts.adminMaster')
@section('title')
    | Galleries All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Galleries All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Galleries All</li>
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
          <h3 class="card-title">Galleries All</h3>

          <div class="card-tools">

             <a class="btn btn-primary btn-xs pt-1"  href="{{ route('admin.galleryCreate') }}"> Create Gallery</a>

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
                  <th>Title</th>
                  <th>Description</th>
                  <th>Featured Image</th>
                  <th>Featured</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = (($galleries->currentPage() - 1) * $galleries->perPage() + 1); ?>
                @foreach($galleries as $gallery)
                <tr>
                  <td style="width: 10px">{{$i++}}</td>
                  <td style="width: 80px">
                      <div class="dropdown show">
                        <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Action
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">

                          <a href="{{ route("admin.galleryEdit",$gallery->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
                          
                            <form action="{{ route('admin.galleryDelete',$gallery->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                            </form>

                        </div>
                  </td>
                  <td>{{$gallery->title}}</td>
                  <td>{{ Str::limit($gallery->description, 50, '...') }}</td>
                  <td> <img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $gallery->fi() ]) }}" alt=""></td>
                  <td>
                    @if ($gallery->featured)
                    <span class="badge badge-primary">Featured</span>
                    @endif
                  </td>
                <td>
                  @if ($gallery->status == "published")
                  <span class="badge badge-success">Published</span>
                  @else
                  <span class="badge badge-warning">Draft</span>
                  @endif
                </td>
                
                </tr>  
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-footer">
           {{ $galleries->render()}}
        </div>
      </div>
    </section>
@endsection




