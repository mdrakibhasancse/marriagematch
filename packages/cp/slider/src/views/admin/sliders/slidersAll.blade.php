@extends('admin::layouts.adminMaster')
@section('title')
    | Sliders All
@endsection

@push('css')
@endpush

@section('content') 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sliders All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Sliders All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">
    
   <div class="card shadow bg-info">
        <div class="card-header">
            <div class="card-title">Slider</div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 m-auto">
            <div class="card">
                <div class="card-header text-info">
                    <div class="card-title">Add Slider</div>
                </div>

                <div class="card-body">
                    <form action="{{route('admin.sliderStore')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" placeholder="Title  here" class="form-control" value="{{ old('title')}}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Description</label>
                            <textarea name="description" id="description" cols="30" rows="5" class="form-control" placeholder="Description Here">
                                {{ old('description')}}
                            </textarea>
                        </div>


                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Link here..." value="{{ old('link')}}">
                        </div>


                        <div class="form-group">
                            <label for="featured_image">Featured Image</label>
                            <input type="file" name="featured_image" id="featured_image" class="form-control">
                            @error('featured_image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-info">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>


     <div class="card">
        <div class="card-header bg-info">
            <div class="card-title">All Sliders</div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderd table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Action</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Featured Image</th>
                            <th>Linik</th>
                            <th>Active</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = (($sliders->currentPage() - 1) * $sliders->perPage() + 1); ?>
                        @forelse($sliders as $slider)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td class="d-flex">
                            <a href="{{route('admin.sliderEdit',$slider)}}" class="text-success mr-2"><i class="fas fa-edit"></i></a>

                            <form action="{{route('admin.sliderDelete', $slider) }}" method="post">
                                @csrf
                                <button class="text-danger" onclick="return confirm('Are you sure? you want to delete this Slider Item?')" style="all:unset;" style="cursor: pointer;"><i class="fas fa-trash"></i></button>
                            </form>

                            </td>

                            <td>{{ $slider->title}}</td>
                            <td>{{ $slider->description }}</td>
                            <td><img src="{{ route('imagecache', [ 'template'=>'sbixs','filename' => $slider->fi() ]) }}" alt=""></td>
                            <td>{{$slider->link}}</td>
                            <td>
                            @if ($slider->active)
                            <span class="badge badge-success">Actived</span>
                            @else
                            <span class="badge badge-danger">Inactived</span>
                            @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-danger h5 text-center">No Slider Found</td>
                        </tr>
                       @endforelse
                    </tbody>
                </table>
                {{ $sliders->links() }}
            </div>
        </div>
    </div>


</section>

@endsection



@push('js')
    
@endpush
