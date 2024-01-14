@extends('admin::layouts.adminMaster')
@section('title')
    | Testimonial All
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Testimonial All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Testimonial All</li>
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
          <h3 class="card-title">Story</h3>

          <div class="card-tools">

             <a class="btn btn-primary btn-xs" href="{{ route('admin.successStoryCreate') }}"> Create New Story</a>

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
                      <th>Except</th>
                      <th>Image</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i = (($testimonials->currentPage() - 1) * $testimonials->perPage() + 1); ?>
                    @foreach($testimonials as $testimonial)
                    <tr>
                      <td style="width: 10px">{{$i++}}</td>
                      <td style="width: 80px">
                          <div class="dropdown show">
                            <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Action
                            </a>

                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a href="{{ route("admin.successStoryEdit",$testimonial->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>

                                <form action="{{route('admin.successStoryDelete',$testimonial->id)}}" method="post" onclick="return confirm('Are you sure to delete?')">
                                  @csrf
                                  <button type="submit" class="dropdown-item"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </div>
                      </td>
                      <td>{{$testimonial->localeTitleShow()}}</td>
                      <td>{{ Str::limit($testimonial->localeExcerptShow(), 70) }}</td>
                      <td>
                          <img  src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $testimonial->fi()]) }}" alt="story">
                      </td>

                      <td>
                          <input type="checkbox" name="toogle" data-url="{{route('admin.successStoryActive')}}" value="{{$testimonial->id}}" data-toggle="toggle" data-size="sm" {{$testimonial->active==1 ? 'checked' : '' }} data-on="On"  data-off="Off" data-onstyle="success" data-offstyle="danger">
                      </td>
                    </tr>  
                    @endforeach
                  </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer">
           {{ $testimonials->render() }}
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
