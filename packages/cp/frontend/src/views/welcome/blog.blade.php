@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)
@section('content')

<div role="main" class="main" style="background: #f9f9f9">
    <div class="container">
        <div class="row">
            <div class="col pt-4 pb-1">
                <h5 class="font-weight-normal w3-large">
                    <a href="{{ url('/')}}"> <i class="fa fa-home text-info"></i> </a>
                     | Blog Post</h5>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <ul class="simple-post-list">
                   @foreach ($posts as $post)
                   <li class="w3-border px-3">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="post-image">
                                <div class="img-thumbnail img-thumbnail-no-borders ">
                                    <a href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">
                                    <img class="" src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}" alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <div class="col-md-8">
                            <div class="post-info">
                                <a class="w3-large" href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">{{ $post->localeTitleShow() }}</a>
                                <div class="post-meta text-justify w3-medium pt-2">
                                    {!! Str::limit($post->localeExcerptShow(),500 , '...') !!}

                                    <a class="w3-small" href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}" style="color: #FD017C;">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                   </li>
                   <br>
                   @endforeach
				</ul>

                <div class="d-flex justify-content-end pb-2">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

</div>

@endsection









































