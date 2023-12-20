@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)

@section('meta_tag')
   <meta name="title" content="{{ $story->meta_title ?: $story->title ?? '' }}"> 
   <meta name="description" content="{{ $story->meta_description ?: $story->excerpt ?? '' }}">
@endsection

@section('content')
<section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm mb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1 class="text-dark"><strong>{{$story->title}}</strong></h1>
            </div>
        </div>
    </div>
</section>

<div class="container pt-5">
    <div class="col-lg-12">
        <article class="post post-medium">
            <div class="row mb-3">
                <div class="col-lg-5">
                    <div class="post-image">
                        <a href="{{ route('viewStory',$story->id)}}">
                            <img src="{{ route('imagecache', ['template' => 'cpxlg', 'filename' => $story->fi()]) }}" class="img-fluid img-thumbnail img-thumbnail-borders rounded-0" alt="story" />
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="post-content">
                        <h2 class="font-weight-semibold pt-4 pt-lg-0 text-5 line-height-4 mb-2"><a href="{{ route('viewStory',$story->id)}}">{{$story->title}}</a></h2>
                        <p class="mb-0 text-justify">{!!$story->description!!}</p>
                    </div>
                </div>
            </div>
        </article>
    </div>
</div>
@endsection