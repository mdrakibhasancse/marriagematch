@extends('admin::layouts.adminMaster')
@section('title')
    | Advertisment Spaces All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advertisment Spaces All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Advertisment Spaces All</li>
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
          <h3 class="card-title">Advertisment Space</h3>

          <div class="card-tools">

             <a class="btn btn-primary btn-xs" href="{{ route('admin.advertisementSpaceCreate') }}">Advertisment Space Create</a>

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
                    <th>Tilte</th>
                    <th>Description</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = (($advertisements->currentPage() - 1) * $advertisements->perPage() + 1); ?>
                  @foreach($advertisements as $advertisement)
                  <tr>
                    <td style="width: 10px">{{$i++}}</td>
                    <td style="width: 80px">
                        <div class="dropdown show">
                          <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </a>

                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                              <a href="{{ route("admin.advertisementSpaceEdit",$advertisement->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

        

                              <form action="{{route('admin.advertisementSpaceDelete',$advertisement->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                @csrf
                                <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                              </form>
                          </div>
                    </td>
                    <td>{{$advertisement->title}}</td>
                  
                    <td>{!! $advertisement->description !!}</td>
                

                    </td>
                  </tr>  
                  @endforeach
                </tbody>
              </table>
            </div>
        </div>
        <div class="card-footer">
           {{ $advertisements->links() }}
        </div>
      </div>
    </section>
@endsection



