@foreach ($medias as $media)                                           
 <div class="card card-default" style="margin-bottom: 5px;">
        <div class="card-body">
            <div class="media">
                <div class="w3-display-container">
                    <img src="{{ route('imagecache', ['template' => 'slmd', 'filename' => $media->file_name]) }}" alt="John Doe" class="mr-1 rounded" style="width:100px;">
                </div>
                <div class="media-body" style=" word-wrap: break-word;word-break: break-all;">
                    <p>
                        Orig.Name: {{ $media->file_name }} <br>
                        Size: {{ $media->size }},
                        Width: {{ $media->width }}px,
                        Height: {{ $media->height }}px <br>
                        <small>
                                {{ asset('/storage/media_images/'.$media->file_name) }}
                        </small>
                        <br>
                        <button class="copyboard btn btn-primary btn-xs" data-text="{{ asset('/storage/media_images/'.$media->file_name) }}">
                           Copy url</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endforeach

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

