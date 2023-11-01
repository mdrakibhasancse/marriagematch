@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)
@section('content')

<section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm mb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                <h1 class="text-dark"><strong>{{ translate('our_packages') }}</strong></h1>
            </div>
        </div>
    </div>
</section>

<div class="container mb-5 mt-5">
	<div class="row">
        @include('membership::frontend.membershipPackage.packgePart')    
    </div>


	<div class="pt-5 text-start">
       {{ $packages->render() }}
    </div>
	
</div>
@endsection