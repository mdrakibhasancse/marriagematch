@extends('admin::layouts.adminMaster')
@section('title')
    | Package Edit
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Package Edit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Package Edit</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h3 class="card-title">Edit Package</h3>
          </div>

          <form action="{{ route('admin.packageUpdate',$package->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        
                    <div class="card card-info">
                            <div class="card-body">
                                
                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label text-right">Package Title</label>
                                    
                                    <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" id="title" value="{{ $package->title ?? old('title')}}" placeholder="Enter title">
                                    </div>
                                    @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label text-right">Package Description</label>
                                    <div class="col-sm-9">
                                    <textarea name="description" id="description" rows="3" class="form-control" placeholder="Enter description">{{ $package->description ?? old('description')}}</textarea>
                                   
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="regular_price" class="col-sm-3 col-form-label text-right">Regular Price</label>
                                    <div class="col-sm-9">
                                    <input type="number" class="form-control" id="regular_price" name="regular_price" value="{{ $package->regular_price ?? old('regular_price')}}" placeholder="Enter regular price">
                                    </div>
                                    @error('regular_price')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="discount" class="col-sm-3 col-form-label text-right">Discount(%)</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="discount" value="{{ $package->discount ?? old('discount')}}" class="form-control" id="discount" placeholder="Enter discount">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="duration" class="col-sm-3 col-form-label text-right">Duration(Days)</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="duration" value="{{ $package->duration ?? old('duration')}}" class="form-control" id="duration" placeholder="Enter duration">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_contact_limit" class="col-sm-3 col-form-label text-right">Daily Contact Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_contact_limit" class="form-control" id="daily_contact_limit" value="{{ $package->daily_contact_limit ?? old('daily_contact_limit')}}" placeholder="Enter daily contact limit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_contact_limit" class="col-sm-3 col-form-label text-right">Total Contact Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_contact_limit" class="form-control" id="total_contact_limit" value="{{ $package->total_contact_limit ?? old('total_contact_limit')}}" placeholder="Enter total contact limit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_proposal_sent" class="col-sm-3 col-form-label text-right">Daily Proposal Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_proposal_sent" class="form-control" id="daily_proposal_sent" value="{{ $package->daily_proposal_sent ?? old('daily_proposal_sent')}}"placeholder="Enter daily proposal sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_proposal_sent" class="col-sm-3 col-form-label text-right">Total Proposal Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_proposal_sent" class="form-control" id="total_proposal_sent" value="{{ $package->total_proposal_sent ?? old('total_proposal_sent')}}" placeholder="Enter total proposal sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_cv_collect_limit" class="col-sm-3 col-form-label text-right">Daily Cv Collect Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_cv_collect_limit" class="form-control" id="daily_cv_collect_limit" value="{{ $package->daily_cv_collect_limit ?? old('daily_cv_collect_limit')}}" placeholder="Enter daily cv collect limit">
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="total_cv_collect_limit" class="col-sm-3 col-form-label text-right">Total Cv Collect Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_cv_collect_limit" class="form-control" id="total_cv_collect_limit"  value="{{ $package->total_cv_collect_limit ?? old('total_cv_collect_limit')}}"placeholder="Enter total cv collect limit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_matched_profile_sent" class="col-sm-3 col-form-label text-right">Daily Matched Profile Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_matched_profile_sent" class="form-control" id="daily_matched_profile_sent" value="{{ $package->daily_matched_profile_sent ?? old('daily_matched_profile_sent')}}"placeholder="Enter daily matched profile sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_matched_profile_sent" class="col-sm-3 col-form-label text-right">Total Matched Profile Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_matched_profile_sent"  value="{{ $package->total_matched_profile_sent ?? old('total_matched_profile_sent')}}"class="form-control" id="total_matched_profile_sent" placeholder="Enter total matched profile sent">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="img_name" class="col-sm-3 col-form-label text-right">Upload Image</label>
                                    <div class="col-sm-9">
                                    <input type="file" name="img_name" class="form-control" id="img_name">
                                    <br>
                                     <img  src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $package->fi()]) }}" alt="Package">
                                    </div>
                                     
                                </div>

                                

                                <div class="form-group row">
                                    <label class="control-label col-sm-3 text-right" for="active">Active</label>
                                    <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="mt-1" name="active" {{ $package->active == 1 ? 'checked' : '' }}></label>
                                        </div>
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label class="control-label col-sm-3 text-right" for="featured">Featured</label>
                                    <div class="col-sm-9">
                                    <div class="checkbox">
                                        <label><input type="checkbox" class="mt-1" name="featured" {{ $package->featured == 1 ? 'checked' : '' }}></label>
                                        </div>
                                    </div>
                                </div>

                                 

                                 <div class="form-group row">
                                     <label for="" class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-9">
                                    <button type="submit" class="btn btn-primary ">Submit</button>
                                    </div>
                                </div>
                            
                            </div>
                     
                        </div>
            <!-- /.card -->
                    </div>
                    
                </div>
              </div>


          </form>
      </div>

    </section>
    <!-- /.content -->

@endsection

@push('js')

@endpush



