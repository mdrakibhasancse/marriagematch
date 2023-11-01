@extends('admin::layouts.adminMaster')
@section('title')
    | Package Create
@endsection

@push('css')
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Package Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">Package Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="card ">
          <div class="card-header bg-info">
              <h3 class="card-title">Create New Package</h3>
          </div>

          <form action="{{ route('admin.packageStore')}}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body" style="background-color: rgba(128, 128, 128, 0.37)">
                <div class="row" style="margin-bottom: 20px;">
                    <div class="col-md-12">
                        
                    <div class="card card-info">
                            <div class="card-body">
                                <div class="form-group row">
                                    <label for="title" class="col-sm-3 col-form-label text-right">Package Title</label>
                                    <div class="col-sm-9">
                                    <input type="text" name="title" class="form-control" value="{{ old('title')}}" id="title" placeholder="Enter title">
                                    </div>
                                    @error('title')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="description" class="col-sm-3 col-form-label text-right">Package Description</label>
                                    <div class="col-sm-9">
                                    <textarea name="description" id="description"  rows="3" class="form-control" placeholder="Enter description">{{ old('description')}}</textarea>
                                   
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="regular_price" class="col-sm-3 col-form-label text-right">Regular Price</label>
                                    <div class="col-sm-9">
                                    <input type="number" class="form-control" id="regular_price" value="{{ old('regular_price')}}" name="regular_price" placeholder="Enter regular price">
                                    </div>
                                    @error('regular_price')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="discount" class="col-sm-3 col-form-label text-right">Discount(%)</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="discount" class="form-control" value="{{ old('discount')}}" id="discount" placeholder="Enter discount">
                                    </div>
                                </div>

                                 <div class="form-group row">
                                    <label for="duration" class="col-sm-3 col-form-label text-right">Duration(Days)</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="duration" class="form-control" id="duration" value="{{ old('duration')}}" placeholder="Enter duration">
                                    </div>
                                    @error('duration')
                                    <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="daily_contact_limit" class="col-sm-3 col-form-label text-right">Daily Contact Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_contact_limit" class="form-control" id="daily_contact_limit" value="{{ old('daily_contact_limit')}}" placeholder="Enter daily contact limit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_contact_limit" class="col-sm-3 col-form-label text-right">Total Contact Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_contact_limit" class="form-control" id="total_contact_limit" value="{{ old('total_contact_limit')}}" placeholder="Enter total contact limit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_proposal_sent" class="col-sm-3 col-form-label text-right">Daily Proposal Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_proposal_sent" class="form-control" id="daily_proposal_sent" value="{{ old('daily_proposal_sent')}}" placeholder="Enter daily proposal sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_proposal_sent" class="col-sm-3 col-form-label text-right">Total Proposal Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_proposal_sent" class="form-control" id="total_proposal_sent" value="{{ old('total_proposal_sent')}}" placeholder="Enter total proposal sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_cv_collect_limit" class="col-sm-3 col-form-label text-right">Daily Cv Collect Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_cv_collect_limit" class="form-control" id="daily_cv_collect_limit" value="{{ old('daily_cv_collect_limit')}}" placeholder="Enter daily cv collect limit">
                                    </div>
                                </div>

                                
                                <div class="form-group row">
                                    <label for="total_cv_collect_limit" class="col-sm-3 col-form-label text-right">Total Cv Collect Limit</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_cv_collect_limit"  class="form-control" id="total_cv_collect_limit"
                                    value="{{ old('total_cv_collect_limit')}}" placeholder="Enter total cv collect limit">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="daily_matched_profile_sent" class="col-sm-3 col-form-label text-right">Daily Matched Profile Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="daily_matched_profile_sent" class="form-control" id="daily_matched_profile_sent" value="{{ old('daily_matched_profile_sent')}}"placeholder="Enter daily matched profile sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="total_matched_profile_sent" class="col-sm-3 col-form-label text-right">Total Matched Profile Sent</label>
                                    <div class="col-sm-9">
                                    <input type="number" name="total_matched_profile_sent" class="form-control" id="total_matched_profile_sent" value="{{ old('total_matched_profile_sent')}}" placeholder="Enter total matched profile sent">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="img_name" class="col-sm-3 col-form-label text-right">Upload Image</label>
                                    <div class="col-sm-9">
                                    <input type="file" name="img_name"  class="form-control" id="img_name">
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



