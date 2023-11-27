@extends('frontend::layouts.NilofaMarraigeMaster')
@section('title', $ws->website_title)

@section('content')
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class="text-dark"><strong>Nilofa Marraige Media</strong></h1>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row py-4">
                <div class="col-lg-12">
                    @foreach ($page->pageItems as $item)
                    <p class="lead mb-0 text-4 text-justify-center">{!!  $item->description !!}</p>
                    @endforeach			
                                
                </div>
            </div>
        </div>

    </section>

@endsection










