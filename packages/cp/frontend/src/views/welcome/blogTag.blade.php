@extends('frontend::layouts.frontendMaster')
@section('title', $tag)


@push('css')
@endpush

@section('content')
<div role="main" class="main">
    <div role="main" class="main">
        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                        <h1 class="text-dark"><strong>{{$tag}}</strong></h1>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="blog-posts">
                    <div class="row">
                        @foreach ($posts as $post)
                        <div class="col-md-4 col-lg-3">
                            <article class="post post-medium border-0 pb-0 mb-5 w3-light-gray" style="min-height: 328px">
                                <div class="post-image">
                                    <a href="{{ route('singlePost',['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">
                                        <img src="{{  route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}" class="img-fluid img-thumbnail img-thumbnail-no-borders rounded-0" alt="">
                                    </a>
                                </div>
                                <div class="post-content px-3 pb-1">

                                    <h2 class="font-weight-semibold text-4 line-height-6 mt-3 mb-2"><a href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow())])}}"> {!! Str::limit($post->localeTitleShow(),40) !!}</a></h2>
                                    <a style="text-decoration:none" href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow())])}}"><p >{!! Str::limit($post->localeExcerptShow(),50) !!}</p></a>

                                </div>
                            </article>

                        </div>
                        @endforeach
                    </div>

                    <div class="">
                        {{ $posts->render() }}
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection



@push('scripts')
   <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63cb82946c9120ee"></script>
@endpush

