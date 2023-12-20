@extends('frontend::layouts.frontendMaster')
@section('title',$page->name)

@section('meta_tag')
   <meta name="title" content="{{ $page->meta_title ?: $page->name ?? '' }}"> 
   <meta name="description" content="{{ $page->meta_description ?: $page->excerpt ?? '' }}">
@endsection

@section('content')

<div role="main" class="main">
   
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class="text-dark"><strong>{{ Str::ucfirst($page->name) }}</strong></h1>
                </div>
            </div>
        </div>
    </section>
  

    <div class="container">


          {{-- contactUsPage start --}}
        @if($contactUsPage)
        @if($contactUsPage->id == $page->id)
        <div class="row">
            <div class="col-md-6 pt-4 mb-4">
                <div class="card-dec">
                    <div class="card-body shadow-lg rounded">
                        <form  action="{{ route('contactUs')}}" method="POST">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    Please fill all the fields
                                </div>
                             @endif

                             @if(Session::has('message'))
                             <div class="alert alert-danger">
                                {{ Session::get('message') }}
                             </div>
                             @endif

                            <div class="form-group">
                                <label class="form-label mb-1 text-4">Full Name</label>
                                <input type="text" value="{{ old('full_name') }}"maxlength="100" class="form-control text-3 h-auto py-2 w3-light-gray" name="full_name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label class="form-label mb-1 text-4">Email Address</label>
                                <input type="email" value="{{ old('email') }}"  class="form-control text-3 h-auto py-2 w3-light-gray" name="email" placeholder="Enter your Email">
                            </div>

                            <div class="form-group col">
                                <label class="form-label mb-1 text-4">Contact Number</label>
                                <input type="text" value="{{ old('number') }}"  maxlength="100" class="form-control text-3 h-auto py-2 w3-light-gray" name="number" placeholder="Enter your number">
                            </div>

                            <div class="form-group col">
                                <label class="form-label mb-1 text-4">Subject</label>
                                <input type="text" value="{{ old('subject') }}"  maxlength="100" class="form-control text-3 h-auto py-2 w3-light-gray" name="subject" placeholder="Enter your subject email">
                            </div>

                            <div class="form-group col">
                                <label class="form-label mb-1 text-4">Message</label>
                                <textarea   rows="3" class="form-control text-3 h-auto py-2 w3-light-gray" name="message" placeholder="Wrriter your meassage">{{ old('message') }}</textarea>
                            </div>


                            <div class="form-group col">
                                <input type="submit" value="Send Message" class="btn btn-danger btn-modern form-control rounded-pill">
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 pt-4">
                <div class="card-dec">
                    <div class="card-body shadow-lg rounded">
                    
                         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7303.215848510881!2d90.419187!3d23.761357!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9caee98be9f%3A0x16cdd5de2fd9fbd6!2sMarriage%20Match%20BD%20%7C%20Marriage%20Media%20in%20Bangladesh!5e0!3m2!1sen!2sbd!4v1686738710414!5m2!1sen!2sbd"  width="100%" height="545" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>


        @endif
        @endif
       {{-- contactUsPage end --}}


        <div class="row py-4">
            <div class="col-lg-12">
                @foreach ($page->pageItems as $item)
                <p class="lead mb-0 text-4 text-justify-center">{!!  $item->description !!}</p>
                @endforeach			
							
            </div>

        </div>

    </div>

</div>
@endsection



