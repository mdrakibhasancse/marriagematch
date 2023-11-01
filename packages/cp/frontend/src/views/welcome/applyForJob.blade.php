@extends('frontend::layouts.frontendMaster')
@section('title', $ws->website_title)


@section('content')

<div role="main" class="main pt-3 mt-3">

    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm mb-0">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class="text-dark"><strong>Apply For Job</strong></h1>
                </div>
            </div>
        </div>
    </section>

<div class="container py-5">
        
<div class="row">
    
    <div class="col-md-8">
        <h1 class="text-dark mb-2"><strong>{{ $jobPost->title }}</strong></h1>
        <h4 class="mb-8 font-bold text-gray-500">Published on 
        {{ \Carbon\Carbon::parse($jobPost->published_date)->format('d M, Y')}}
        </h4>
        <h4 class="text-lg mb-2 font-bold">Job Context</h4> 
        <div class="mb-8">
            <p>{{ $jobPost->excerpt }}</p>
        </div>



         <div class="mb-0">
             {!! $jobPost->description !!}
         </div>


    </div>

    <div class="col-md-4">
        <div class="card">
          
            <div class="card-header bg-color-dark text-4 text-white">
				Job Summary
			</div>

            <div class="card-body bg-color-grey">
                <p class="mb-2 text-red-500">Application Deadline: <b class="text-default">  {{ \Carbon\Carbon::parse($jobPost->expired_date)->format('d M, Y')}}</b></p>
                <p class="mb-2 text-gray-500">Published on: <b class="text-default">  {{ \Carbon\Carbon::parse($jobPost->published_date)->format('d M, Y')}}</b></p> 
                
                <p class="mb-2 text-gray-500">Job Location: <b class="text-default">{{$ws->contact_address}}</b></p> 
                
                <p class="mb-8 text-gray-500">Salary: <b class="text-default">
                    {{ $jobPost->salary}}
                </b>
                </p> 
            </div>
        </div>
         <br>

        <div class="card shadow text-center">
            <div class="card-body">
                <form action="{{ route('applyForJopStore') }}" method="post" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" value="{{ $jobPost->id }}" name="job_post_id">
                    <div class="form-group">
                        <label class="form-label mb-1 text-4">Select your CV</label>
                        <input type="file" class="form-control text-3 h-auto py-2" name="cv" required="">
                    </div>

                
                    <button type="submit" class="btn btn-modern btn-dark">Sumbmit CV</button>
                </form>
            </div>
        </div>
        
    </div>
</div>


    </div>

</div>

@endsection









































