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
            <h1>Page Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Page Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">

     <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Edit Page</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.pagesAll') }}"> Back</a>
            </div>
        </div>
        
        <form action="{{ route('admin.pageUpdate',$page->id)}}" method="post">
          @csrf
         <div class="card-body">
            <div class="card card-widget mb-0">
              <div class="card-body w3-gray">
                <div class="card card-widget mb-0 text-dark">
                  <div class="card-body">
                       @foreach (Cp\Admin\Models\Language::where('active', 1)->get() as $key => $language)
                        <div class="form-group">
                          <label for="">Page Name {{$language->title}}</label>
                          <input type="text" name="name[{{$language->language_code}}]" class="form-control" value="{{ $page->localeName($language->language_code)  }}" placeholder="Enter Page Name">
                          @error('name')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>

                      <div class="form-group">
                          <label for="">Page Excerpt {{$language->title}}</label>
                          <input type="text" name="excerpt[{{$language->language_code}}]" class="form-control" value="{{ $page->localeExcerpt($language->language_code)  }}" placeholder="Enter Page Excerpt">
                          @error('type')
                          <div class="alert alert-danger">{{ $message }}</div>
                          @enderror
                      </div>
                      @endforeach

                      <div class="form-group">
                          <label for="">Page Link</label>
                          <input type="text" name="link" class="form-control" value="{{$page->link}}" placeholder="Enter Menu link">
                      </div>


                      <div class="checkbox pl-1">
                          <label><input type="checkbox"  name="active" value="1" {{($page->active == '1') ? 'checked' : ''}}> Active</label>
                      </div>


                      <div class="row mt-4">
                        <div class="col-md-12">
                          <div class="card">
                            <div class="card-header with-border">
                                <h5 class="card-title">Update Menu</h5>
                            </div>
                              <br>
                            <div class="card-body" style="padding-top: 0 !important;">
                                                                                                                          <div class="checkbox mr-2">
                                      @foreach ($menus->chunk(4) as $menu4)

                                      <div class="row">
                                          @foreach($menu4 as $menu)
                                          <div class="col-3">
                                              <input type="checkbox" id="pages{{ $menu->id }}"
                                              name="menus_id[]" value="{{$menu->id}}"
                                              {{ in_array($menu->id,$page->menus()->pluck('menu_id')->toArray()) ? 'checked': " "}}>
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
                </div>

              </div>

            </div>

          </div>

          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
               {{-- link and copy start --}}
          &nbsp;
          @if($page->link)
          <button class="copyboard btn btn-primary btn-sm" data-id="{{ $page->id }}"  data-text="{{ $page->link }}">
              Copy url
          </button>
          &nbsp;
          <a target="_blank" href="{{ $page->link }}" class="btn btn-primary">View</a>
          @else


          <button class="copyboard btn btn-primary" data-id="{{ $page->id }}"  data-text="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}">
                Copy url
          </button>
          
          &nbsp;
          <a target="_blank" href="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}" class="btn btn-primary">View</a>
          @endif

                      {{-- link and copy end --}}
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

</section>

@endsection



@push('js')
    <script>
         $( document ).ready(function() {
           
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
