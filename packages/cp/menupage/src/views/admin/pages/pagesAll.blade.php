@extends('admin::layouts.adminMaster')
@section('title')
    | Pages All
@endsection

@push('css')
@endpush

@section('content') 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pages All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Pages All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">

     <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Create New Page</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.pagesAll') }}"> Back</a>
            </div>
        </div>
        <form action="{{ route('admin.pageStore')}}" method="post">
          @csrf
          <div class="card-body">
            <div class="card card-widget mb-0">
              <div class="card-body w3-gray">
                <div class="card card-widget mb-0 text-dark">
                  <div class="card-body">
                    @foreach (Cp\Admin\Models\Language::where('active', 1)->get() as $key => $language)
                        <div class="form-group">
                            <label for="">Page Name {{$language->title}}</label>
                            <input type="text" name="name[{{$language->language_code}}]" class="form-control" value="{{old('name')}}" placeholder="Enter Page Name {{$language->title}}">
                            @error('name')
                            <span style="color:red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="">Page Excerpt {{$language->title}}</label>
                            <input type="text" name="excerpt[{{$language->language_code}}]" class="form-control" value="{{old('excerpt')}}" placeholder="Enter Page Excerpt {{$language->title}}">
                            
                        </div>
                      @endforeach

                        <div class="form-group">
                            <label for="">Page Link</label>
                            <input type="text" name="link" class="form-control" value="{{old('link')}}" placeholder="Enter Page link">
                        </div>


                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header with-border">
                                        <h5 class="card-title">Update Menu</h5>
                                    </div>
                                    <br>
                                    <div class="card-body" style="padding-top: 0 !important;">
                                        @foreach ($menus->chunk(4) as $menu4)
                                        <div class="row">
                                            @foreach($menu4 as $menu)
                                            <div class="col-3">
                                                <input type="checkbox" id="pages{{ $menu->id }}"
                                                name="menus_id[]" value="{{$menu->id}}">
                                                <label for="pages{{ $menu->id }}" class="mr-2">{{$menu->name}}</label>
                                            </div>
                                            @endforeach

                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                                                
                        </div>
                 
                  </div>
                </div>

                <br>

                <div class="card">
                  <div class="card-header">
                      <h3 class="card-title w3-xlarge">SEO PART</h3>
                  </div>
                    <div class="card-body">
                        <div class="form-group ">
                            <label for="meta_title" class="  control-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title')}}" id="meta_title" placeholder="Meta Title" autocomplete="off">
                        </div>

                        <div class="form-group ">
                            <label for="meta_description" class="control-label">Meta Description </label>
                            <textarea name="meta_description" class="form-control" rows="4" id="meta_description" placeholder="Meta Description for SEO">{{ old('meta_description')   }}</textarea>
                        </div>
                  </div>
                </div>

              </div>
            </div>
          </div>


        
                      
                 


          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

      <div class="card card-widget" style="font-size: 16px;">
        <div class="card-header with-border">
            <h3 class="card-title"><i class="fa fa-th"></i> All Pages</h3>
            <div class="card-tools">
                {{-- <div class="input-group input-group-sm">
                <input type="search" name="q"  class="global-search form-control float-right" data-url="{{ route('admin.global-search-ajax',['type'=>'menu']) }}"  placeholder="Search name, id...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="card-body">
            <div class="card card-widget mb-0">
              <div class="card-body w3-gray pb-0">
                <div class="row data-container">
                  <div class="col-sm-12 connectedSortable ui-sortable" id="sortablePanel"  data-url="{{ route('admin.pageSort') }}">
                    @foreach ($pages as $page)
                    <div class="card card-widget ui-sortable-handle text-dark" id="{{ $page->id }}">
                        <div class="card-body">
                            <i title="Drag up or down" class="fas fa-arrows-alt-v" style="cursor: pointer"></i>
                            Page ID: <b>{{ $page->id }}</b>,
                            Page Name: <b> {{ $page->name }}</b>,
                            Active:
                            @if($page->active == 1)
                            <b>
                                Yes
                            </b>,
                            @else
                            <b>
                                No
                            </b>,
                            @endif

                            List In Menu:
                            <?php $i = 1; $len = count($page->menus); ?>
                            @foreach($page->menus as $menu)
                            <b>
                            {{ $menu->name }}
                            </b>
                            <?php if($i < $len) {echo ',';} $i++;?>
                            @endforeach

                            {{-- link and copy start --}}
                            &nbsp;
                            @if($page->link)
                            <button class="copyboard btn badge badge-primary text-white" data-id="{{ $page->id }}"  data-text="{{ $page->link }}">
                               Copy url
                            </button>
                            <a target="_blank" href="{{ $page->link }}" class="badge badge-primary">View</a>
                            @else

                            <button class="copyboard btn badge badge-primary text-white" data-id="{{ $page->id }}"  data-text="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}">
                                Copy url
                            </button>
                            <a target="_blank" href="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}" class="badge badge-primary">View</a>
                            @endif

                        {{-- link and copy end --}}

                            <div class="float-right d-flex">
                                 <a class="btn btn-primary btn-sm mr-1" 
                                 href="{{route('admin.pageItemCreate',$page->id)}}">Add Page Part</a>

                                <a class="btn btn-primary btn-sm mr-1" href="{{ route('admin.pageEdit',$page->id) }}">Edit</a>

                                @if($page->link or $page->id == $homePage->id or $page->id == 2 )

                                @else
                                <form action="{{ route('admin.pageDelete',$page->id) }}" method="post" onclick="return confirm('Do you really want to delete?');">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                                @endif

                            </div>
                        </div>
                    </div>
                    @endforeach
                     
                  </div>
                </div>
              </div>
             
            </div>
        </div>
        <div class="card-footer">
          {{ $pages->render() }}
        </div>
       
      </div>

    </section>

@endsection



@push('js')
    <script>
         $( document ).ready(function() {
            $("#sortablePanel").sortable({

              connectWith: ".connectedSortable",
              distance: 5,
              delay: 300,
              opacity: 0.6,
              cursor: 'move',

              update: function() {
                  var order = $('#sortablePanel').sortable('toArray'),
                      url = $("#sortablePanel").attr('data-url');
                  $.ajax({
                      url: url,
                      type: 'get',
                      cache: false,
                      dataType: 'json',
                      data: {
                          sorted_data: order
                      },
                      success: function(response) {
                          if (response.success == true) {} else {
                              alert('fail');
                          }
                      },
                      error: function() {}
                  }); //ajax
              }
            }).disableSelection();



            $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            $(".copyboard").text('Copy url');
            $(this).text('Coppied!');
            var copyText = $(this).attr('data-text');

            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");

            document.body.removeChild(textarea);
           });
           
         });
    </script>
@endpush
