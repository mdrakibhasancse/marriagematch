@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)


@section('content')

<div role="main" class="main pt-3 mt-3">
    <div class="container">
        <div class="row pb-1">
            @foreach ($latest_posts->take(1) as $post)

            <div class="col-lg-7 mb-4 pb-2">
                <a href="{{ route('singlePost', ['id' => $post->id])}}">
                    <article class="thumb-info thumb-info-no-borders thumb-info-bottom-info thumb-info-bottom-info-dark thumb-info-bottom-info-show-more thumb-info-no-zoom border-radius-0">
                        <div class="thumb-info-wrapper thumb-info-wrapper-opacity-6">
                            <img style="height:480px;" src="{{ route('imagecache', [ 'template'=>'original','filename' => $post->fi()]) }}" class="img-fluid" alt="How To Take Better Concert Pictures in 30 Seconds">
                            <div class="thumb-info-title bg-transparent p-4">
                                <div class="thumb-info-inner mt-1">
                                    <h2 class="font-weight-bold text-color-light line-height-2 text-5 mb-0">{{ $post->title }}</h2>
                                </div>
                                <div class="thumb-info-show-more-content">
                                    <p class="mb-0 text-1 line-height-9 mb-1 mt-2 text-light opacity-5">{{ $post->excerpt }}</p>
                                </div>
                            </div>
                        </div>
                    </article>
                </a>
            </div>
            @endforeach


            <div class="col-lg-5">
                @foreach ($latest_posts->skip(1) as $post)
                <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-2">
                    <div class="row align-items-center pb-1">
                        <div class="col-sm-5">

                            <a href="{{ route('singlePost', ['id' => $post->id])}}">
                                <img style="height:120px;" src="{{ route('imagecache', [ 'template'=>'original','filename' => $post->fi() ]) }}" class="img-fluid border-radius-0" alt="Simple Ways to Have a Pretty Face">
                            </a>
                        </div>
                        <div class="col-sm-7 ps-sm-1">
                            <div class="thumb-info-caption-text">
                                <div class="d-inline-block text-default text-1 float-none">
                                    <div class="text-decoration-none text-color-default">
                                        {{-- @if($post->blogCategories)
                                        <?php $i = 1; $len = count($post->blogCategories); ?>
                                        @foreach ($post->blogCategories as $category)
                                             {{ $category->name }}
                                             <?php if($i < $len) {echo ',';} $i++;?>
                                        @endforeach
                                        @endif --}}
                                    </div>
                                </div>
                                <h2 class="d-block line-height-2 text-4 text-dark font-weight-bold mt-1 mb-0">
                                    <a href="{{ route('singlePost', ['id' => $post->id])}}" class="text-decoration-none text-color-dark text-color-hover-primary">{{ $post->title }}</a>
                                </h2>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

        </div>


        <div class="row pb-1 pt-2">
            <div class="col-md-9">
                @foreach ($cats as $category)
                @if($category->latestFirstPost())
            
                    <div class="heading heading-border heading-middle-border">
                        <a href="">
                            <h3 class="text-4"><strong class="font-weight-bold text-1 px-3 text-light py-2 bg-secondary">{{ $category->name}}</strong></h3>
                        </a>
                    
                    </div>

                    <div class="row pb-1">

                        <div class="col-lg-6 mb-4 pb-1">
                            <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('singlePost', ['id' => $category->latestFirstPost()->id])}}">
                                            <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $category->latestFirstPost()->fi() ]) }}" class="img-fluid border-radius-0" alt="Category post">
                                        </a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="thumb-info-caption-text">
                                            <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <a href="blog-post.html" class="text-decoration-none text-color-default">
                                             {{-- @if($category->latestFirstPost()->blogCategories)
                                                <?php $i = 1; $len = count($category->latestFirstPost()->blogCategories); ?>
                                                @foreach ($category->latestFirstPost()->blogCategories as $category)
                                                    {{ $category->name }}
                                                    <?php if($i < $len) {echo ',';} $i++;?>
                                                @endforeach
                                              @endif --}}
                                            </a>
                                            </div>
                                            <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                                <a href="{{ route('singlePost', ['id' => $category->latestFirstPost()->id])}}" class="text-decoration-none text-color-dark text-color-hover-primary">   {{$category->latestFirstPost()->title}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        </div>

                        <div class="col-lg-6">
                            @foreach ($category->latest2Posts() as $post)
                            <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-4 mb-1">
                                <div class="row align-items-center pb-1">
                                    <div class="col-sm-4">
                                        <a href="{{ route('singlePost', ['id' => $post->id])}}">
                                            <img src="{{ route('imagecache', [ 'template'=>'pplg','filename' => $post->fi() ]) }}" class="img-fluid border-radius-0" alt="post">
                                        </a>
                                    </div>
                                    <div class="col-sm-8 ps-sm-0">
                                        <div class="thumb-info-caption-text">
                                            <div class="d-inline-block text-default text-1 float-none">
                                                <a href="blog-post.html" class="text-decoration-none text-color-default">							
                                                    {{-- @if($post->blogCategories)
                                                    <?php $i = 1; $len = count($post->blogCategories); ?>
                                                    @foreach ($post->blogCategories as $category)
                                                
                                                            {{ $category->name }}
                                                            <?php if($i < $len) {echo ',';} $i++;?>
                                                    @endforeach
                                                    @endif --}}
                                                </a>
                                            </div>
                                            <h4 class="d-block pb-2 line-height-2 text-3 text-dark font-weight-bold mb-0">
                                                <a href="{{ route('singlePost', ['id' => $post->id])}}" class="text-decoration-none text-color-dark text-color-hover-primary">
                                                    {{ Str::limit($post->title, 20) }}
                                                </a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach	
                        </div>
                    </div>

            
                @endif
                @endforeach
            </div>


            <div class="col-md-3">
                @if($featured_posts->count())
                <h3 class="font-weight-bold text-3 pt-1">{{ translate('featured_posts') }}</h3>
                @endif
                <div class="pb-2">

                    @foreach ($featured_posts as $post)
                    <div class="mb-4 pb-2">
                        <article class="thumb-info thumb-info-no-zoom bg-transparent border-radius-0 pb-2 mb-2">
                            <div class="row">
                                <div class="col">
                                    <a href="{{ route('singlePost', ['id' => $post->id])}}">
                                        <img src="{{ route('imagecache', ['template' => 'cpmd', 'filename' => $post->fi()]) }}" class="img-fluid border-radius-0" alt="Main Reasons To Stop Texting And Driving">
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="thumb-info-caption-text">
                                        <div class="d-inline-block text-default text-1 mt-2 float-none">
                                            <div class="text-decoration-none text-color-default">
                                                {{-- @if($post->blogblogCategories)
                                                <?php $i = 1; $len = count($post->blogblogCategories); ?>
                                                @foreach ($post->blogblogCategories as $category)
                                                        {{ $category->name }}
                                                        <?php if($i < $len) {echo ',';} $i++;?>
                                                @endforeach
                                                @endif --}}
                                            </div>
                                        </div>
                                        <h4 class="d-block line-height-2 text-4 text-dark font-weight-bold mb-0">
                                            <a href="{{ route('singlePost', ['id' => $post->id])}}" class="text-decoration-none text-color-dark text-color-hover-primary">{{ $post->title }}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    @endforeach


                </div>


            </div>
            
        </div>

        <div class="row pb-1 pt-3">
                <div class="col-md-6">
                    @if($popular_posts->count())
                        <h3 class="font-weight-bold text-3 mb-0">{{ translate('popular_posts') }}</h3>
                    @endif
                    <ul class="simple-post-list">

                        @foreach ($popular_posts as $post)
                        <li>
                            <article>
                                <div class="post-image">
                                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                        <a href="{{ route('singlePost', ['id' => $post->id])}}">
                                            <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $post->fi() ]) }}" class="border-radius-0" width="50" height="50" alt="How to Become a Professional Photographer">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-info">
                                    <div class="post-meta">
                                        {{-- @if($post->blogCategories)
                                            <?php $i = 1; $len = count($post->blogCategories); ?>
                                            @foreach ($post->blogCategories as $category)
                                                {{ $category->name }}
                                                <?php if($i < $len) {echo ',';} $i++;?>
                                                @endforeach
                                        @endif --}}
                                    </div>
                                    <h4 class="font-weight-normal text-3 mb-0"><a href="{{ route('singlePost', ['id' => $post->id])}}" class="text-dark">{{ $post->title }}</a></h4>
                                </div>
                            </article>
                        </li>
                        @endforeach

                    </ul>

                </div>




                <div class="col-md-6">
                    @if($recent_posts->count())
                        <h3 class="font-weight-bold text-3 mb-0 mt-4 mt-md-0">{{ translate('recent_posts') }}</h3>
                    @endif
                    <ul class="simple-post-list">
                        @foreach ($recent_posts as $post)
                   
                        <li>
                            <article>
                                <div class="post-image">
                                    <div class="img-thumbnail img-thumbnail-no-borders d-block">
                                        <a href="{{ route('singlePost', ['id' => $post->id])}}">
                                            <img src="{{ route('imagecache', [ 'template'=>'original','filename' => $post->fi() ]) }}" class="border-radius-0" width="50" height="50" alt="12 Healthiest Foods to Eat for Breakfast">
                                        </a>
                                    </div>
                                </div>
                                <div class="post-info">
                                    <div class="post-meta">
                                        {{-- @if($post->blogCategories)
                                        <?php $i = 1; $len = count($post->blogCategories); ?>
                                        @foreach ($post->blogCategories as $category)
                                            {{ $category->name }}
                                            <?php if($i < $len) {echo ',';} $i++;?>
                                            @endforeach
                                        @endif --}}
                                    </div>
                                    <h4 class="font-weight-normal text-3 mb-0"><a href="{{ route('singlePost', ['id' => $post->id])}}" class="text-dark">{{ $post->title }}</a></h4>
                                </div>
                            </article>
                        </li>
                        @endforeach

                    </ul>

                </div>


        </div>

      
    </div>

</div>

@endsection









































