@extends('admin::layouts.adminMaster')
@section('title')
    | Medias All
@endsection

@push('css')
@endpush

@section('content') 
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Medias All</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Medias All</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

 <section class="content">

    
    <div class="card shadow">
        <div class="card-body bg-info">
        All Medias
        </div>
    </div>

    <div class="card card-widget">
        <div class="card-header text-center">
            <form class="form-inline" method="post" action="{{ route('admin.mediaStore') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group {{ $errors->has('files') ? ' has-error' : '' }}">
                    <label for="file_name">Multiple Upload Image:</label>
                    <input type="file" name="files[]" value="" placeholder="Files" class="form-control ml-1" id="files" style="padding-bottom: 32px;" multiple>
                     @if ($errors->has('files'))
                        <span class="help-block">
                        <strong>{{ $errors->first('files') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="w3-btn w3-blue w3-round w3-border w3-border-white ml-1">Add Image</button>

            </form>
        </div>
        <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">

            <div class="row">
                @foreach ($medias as $media)
                <div class="col-sm-6">
                    <div class="card card-default" style="margin-bottom: 5px;">
                        <div class="card-body">
                            <div class="media border ">
                                <div class="w3-display-container">
                                    <img src="{{ route('imagecache', ['template' => 'original', 'filename' => $media->file_name]) }}" alt="John Doe" class="mr-1   rounded" style="width:100px;">
                                <div class="w3-display-topright"><a onclick="return confirm('Do you really want to delete this media?');" style="margin-right: 4px;margin-top: 3px;" class="btn btn-default btn-xs" title="Delete" href="{{ route('admin.mediaDelete',$media->id)}}"><i class="fa fa-times"></i></a></div>

                                </div>
                                <div class="media-body" style=" word-wrap: break-word;word-break: break-all;">
                                    <p>
                                    Orig.Name: {{ $media->file_name }} <br>
                                    file_size: {{ $media->file_size }},
                                    Width: {{ $media->width }}px,
                                    Height: {{ $media->height }}px <br>
                                    <small>{{ asset('/storage/media_images/'.$media->file_name) }}</small> <br>

                                    <button class="copyboard btn btn-primary btn-xs" data-id="{{ $media->id }}"  data-text="{{ asset('/storage/media_images/'.$media->file_name) }}">Copy to
                                        Clipboard
                                    </button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="pull-right">

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

            $(".copyboard").text('Copy to Clipboard');
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
