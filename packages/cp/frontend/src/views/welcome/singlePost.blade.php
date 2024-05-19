@extends('frontend::layouts.frontendMaster')
@section('title', $post->title)
@section('meta_tag')
   <meta name="title" content="{{ $post->meta_title ?: $post->title ?? '' }}"> 
   <meta name="description" content="{{ $post->meta_description ?: $post->excerpt ?? '' }}">
@endsection

@push('css')
  <style>
    .style-li{
        padding-left: 0px !important;
    }
  </style>
@endpush

@section('content')
<div role="main" class="main">
    <div role="main" class="main">
        <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                        <h1 class="text-dark"><strong>Blog Post Details</strong></h1>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container">
        <div class="row pt-5">
           <div class="col-md-10">
                <div class="card" style="min-height: 600px">
                    <div class="card-body">
                        <div class="blog-posts single-post">

                            <article class="post post-large blog-single-post border-0 m-0 p-0">
                                <div class="post-content ms-0">

                                    <h2 class="font-weight-semi-bold">
                                        <a href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">
                                            {{ $post->localeTitleShow() }}
                                        </a>
                                    </h2>

                                     <br>
                                    <img class="w-100" src="{{ route('imagecache', ['template' => 'original', 'filename' => $post->fi()]) }}" alt="">

                                    <br><br>

                                    <p style="white-space:pre-wrap;">{!! $post->localeDescriptionShow() ?? '' !!}</p>

                                    <hr>
                                    <div class="post-block mt-1 post-share w3-small">
                                        @if($tags)
                                        <h4 class="m-0 p-0">Tages :
                                        @foreach($tags as $tag)
                                        <a class="text-decoration-none" href="{{ route('blogTag', $tag)}}">
                                           {{ $tag }}
                                           <span></span>
                                        </a>
                                        @endforeach
                                        @endif
                                       </h4>
                                    </div>

                                    <div class="post-block mt-1 post-share w3-small">
                                        @if($post->blogCategories()->first())
                                        <h4 class="m-0 p-0">Category :
                                            <?php $i = 1; $len = count($post->blogCategories); ?>
                                            @foreach ($post->blogCategories as $category)
                                               <a class="text-decoration-none" href="{{ route('blogCategory',$category->slug)}}">
                                               {{ $category->name  }}
                                               </a>
                                               <?php if($i < $len) {echo ',';} $i++;?>
                                            @endforeach
                                        </h4>
                                        @endif
                                    </div>

                                </div>
                            </article>

                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="col-md-3 ">
                <div class="card" style="min-height: 600px">
                    <div class="card" style="min-height: 600px">
                        <div class="card-body">
                            <h4>{{ translate('popular_posts') }}</h3>
                            @foreach ($popular_posts as $post)
                            <ul class="simple-post-list">
                               <li>
                                <div class="post-image">
                                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                        <a href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">
                                            <img src="{{ route('imagecache', ['template' => 'sbixs', 'filename' => $post->fi()]) }}" alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-info">
                                    <a href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">{!! Str::limit($post->localeTitleShow(),15) !!}</a>
                                    <a style="text-decoration:none" href="{{ route('singlePost', ['slug' => $post->slug ?? \Str::slug($post->localeTitleShow()) ])}}">
                                        <div class="post-meta">
                                            {!! Str::limit($post->localeExcerptShow(),15) !!}
                                        </div>
                                    </a>
                                </div>
                            </li>
                            </ul>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>

        <div class="row py-5">
            <div class="col-md-12">
                 <div class="card" style="min-height: 600px">
                     <div class="card-body pb-0">
                        <div class="container- px-1">
                            <h4 class="mb-4 text-4 text-uppercase">Related <strong class="font-weight-extra-bold">Posts</strong></h4>
                            <div class="row">
                                <div class="col">
                                    <div class="blog-posts">
                                        <div class="row">
                                            @foreach ($relatedPosts as $post)
                                            <div class="col-md-4 col-lg-3">
                                                <article class="post post-medium border-0 pb-0 mb-5 w3-light-gray" style="min-height: 328px">
                                                    <div class="post-image text-center">
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
@endsection



@push('scripts')
   <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-63cb82946c9120ee"></script>
@endpush

