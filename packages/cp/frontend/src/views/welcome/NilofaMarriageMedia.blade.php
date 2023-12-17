@extends('frontend::layouts.NilofaMarraigeMaster')
@section('title', 'Nilofa Marriage Media')

@section('meta_tags')
   <meta name="author" content="{{ $ws->meta_author }}">
   <meta name="title" content="{{ $ws->meta_title }}"> 
   <meta name="description" content="{{ $ws->meta_description }}">
@endsection

@section('content')
	<section class="call-to-action with-borders button-centered">			
      <div class="col-12">
         <div class="call-to-action-btn">
            <a href="https://www.marriagematchbd.com/register" target="_blank" 
               class="btn text-2 text-white" style="background-color: #FD017C;">পাত্র / পাত্রী দেখুন
             </a>
         </div>
      </div>
   </section>
    <section class="section pt-5 m-0">
        <div class="container">
        @foreach ($page->pageItems as $item)
            <p class="lead mb-0 text-4 text-justify-center">{!!  $item->description !!}</p>
            @endforeach	    

        </div>
    </section>
    <section class="call-to-action with-borders button-centered">			
      <div class="col-12">
         <div class="call-to-action-btn">
            <a href="https://www.marriagematchbd.com/register" target="_blank" 
               class="btn text-2 text-white" style="background-color: #FD017C;">পাত্র / পাত্রী দেখুন
             </a>
         </div>
      </div>
   </section>

    <section>
      <div class="container mb-5 mt-5">
         <div class="card-deck ">
            <div class="row">
               <div class="col-md-6 mb-4">
                  <div class="card shadow" style="min-height: 220px;">
                     <div class="card-body- d-flex align-items-center justify-content-center">
                        <iframe width="545" height="220px" src="https://www.youtube.com/embed/bTKqkO_2ASM?si=gCf-nqkdSot9wrMZ?modestbranding=1&rel=0&fs=0&disablekb=1&showinfo=0&autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card shadow" style="min-height: 220px;">
                     <div class="card-body- d-flex align-items-center justify-content-center">
                        <iframe width="545" height="220px" src="https://www.youtube.com/embed/Z8F5fzXY7zg?modestbranding=1&rel=0&fs=0&disablekb=1&showinfo=0&autoplay=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                     </div>
                  </div>
               </div>
               
            </div>
            
            
         </div>
      </div>
   </section>
@endsection













