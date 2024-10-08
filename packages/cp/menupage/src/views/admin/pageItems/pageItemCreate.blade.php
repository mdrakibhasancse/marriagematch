@extends('admin::layouts.adminMaster')
@section('title')
    | PageItem Create
@endsection

@push('css')
@endpush

@section('content') 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>PageItem Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">PageItem Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">

     <div class="card card-widget" style="font-size: 16px;">
        <div class="card-body">
            <div class="card card-widget mb-0">
                <div class="card-body w3-gray ">
                    <div class="card card-widget mb-1">
                        <div class="card-body">
                            Page ID: <b>{{ $page->id }}</b>, &nbsp;

                            Page : <b> {{ $page->name }}</b>, &nbsp;

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
                                @if($page->menus->count() > 0)
                                <b>
                                    Yes
                                </b>,
                                @else
                                <b>
                                    No
                                </b>,
                                @endif



                            Parts: <b> <span class="label label-success ">
                                    {{ $page->pageItems->count() }}
                                </span> </b>

                            <div class="float-right">
                                <a class="btn-primary btn btn-xs " href="{{ route('admin.pageEdit',$page->id) }}">Edit</a>
                                &nbsp;
                                <a class="btn-primary btn btn-xs " href="{{ route('admin.pageItemCreate',$page->id)}}">Add Page Part</a>

                            </div>


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

                        </div>
                    </div>
                    <div class="row">
                        @foreach ($page->pageItems as $item)
                        <div class="col-sm-10 col-sm-offset-1">
                                <div class="card card-widget mb-1">
                                    <div class="card-body">
                                        SL: <b>{{ $loop->iteration }}</b>, &nbsp;
                                        Part Title: <b> {{ $item->name }}</b>, &nbsp;

                                        Active: @if($item->active == 1)
                                        <b>
                                            Yes
                                        </b>
                                        @else
                                        <b>
                                            No
                                        </b>
                                        @endif
                                        <div class="float-right">
                                            <a class="btn-primary btn btn-xs " href="{{ route('admin.pageItemEdit',$item->id) }}">Edit</a>
                                            &nbsp;

                                            <a class="btn-danger btn btn-xs " onclick="return confirm('Do you really want to delete?');" href="{{ route('admin.pageItemDelete',$item->id) }}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
     </div>


      <div class="card card-widget" style="font-size: 16px;">
        <div class="card-header with-border">
            <h3 class="card-title"><i class="fa fa-edit"></i> PageItem Create <span class="label label-default"></span></h3>
        </div>
        <div class="card-body">
            <div class="card card-widget mb-0">
                <div class="card-body w3-gray ">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="card card-widget mb-0">
                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data" action="{{route('admin.pageItemStore')}}">
                                        @csrf
                                        <input type="hidden" name="page_id" value="{{ $page->id }}">
                                        <div class="form-group">
                                            <label for="name">Item Title:</label>
                                            <input type="text" class="form-control" placeholder="Page Part Title" id="name" name="name" value="{{ old('name') }}">
                                            @error('name')
                                            <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @foreach (Cp\Admin\Models\Language::where('active', 1)->get() as $key => $language)
                                        <div class="form-group">
                                            <label for="">Description {{$language->title}}</label>
                                            <textarea name="description[{{$language->language_code}}]" class="summernote form-control"  rows="5"></textarea>
                                            @error('description')
                                            <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        @endforeach


                                        <div class="checkbox">
                                            <label><input type="checkbox"  name="editor" value="1" {{  old('editor') == 1 ? 'checked' : '' }}> Editor</label>
                                        </div>

                                        <div class="checkbox">
                                            <label><input type="checkbox"  name="active" value="1" {{  old('active') == 1 ? 'checked' : '' }}> Active</label>
                                        </div>

                                        <button type="submit" class="btn btn-primary">Submit</button>

                                    </form>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-5">
                             @includeIf('media::admin.medias.mediaContainer')
                        </div>

                </div>
            </div>
        </div>
      </div>

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
