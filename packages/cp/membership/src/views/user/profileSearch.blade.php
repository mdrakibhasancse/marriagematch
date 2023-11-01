@extends('userrole::user.layouts.userMaster')
@section('title')
    | Message
@endsection

@push('css')
    
@endpush

@section('content') 
     {{-- {{ dd(Auth::user()->profile)}} --}}
    <!-- Main content -->
    <section class="content pt-3">
        <div class="container">
            @include('membership::user.includes.myTopButtons')
            @include('membership::user.includes.paymentButton')
            
            <form action="{{ route('membership.profileSearchResult')}}" method="get">
              @csrf
                <div class="card">
                
                    <div class="card-body">
                       <h3>{{ translate('search_profile') }}</h3>
                       <hr>
                      <div class="row">
                        <div class="form-group col-md-6">
                          <label for="max_age">{{ translate('maximum_age') }}</label>
                          <select name="min_age" id="" class="form-control">
                              <option value="">{{ translate('maximum_age') }}</option>
                              @for($i = 16; $i <= 60; $i++)
                              <option value="{{$i}}">{{ $i }}</option>
                              @endfor
                          </select>
                        </div>
                        <div class="form-group col-md-6">
                          <label for="max_age">{{ translate('minimum_age') }}</label>
                          <select name="max_age" id="" class="form-control">
                              <option value="">{{ translate('minimum_age') }}</option>
                              @for($i = 16; $i <= 60; $i++)
                              <option value="{{$i}}">{{ $i }}</option>
                              @endfor
                          </select>
                        </div>


                        <div class="form-group col-md-6">
                          <label for="max_age">{{ translate('education_level') }}</label>
                          <select name="education_lavel" id="" class="form-control">
                            <option >{{ translate('education_level') }}</option>
                            @foreach($parameters->where('field_name','education_level') as $item)
                              <option value="{{ $item->field_value }}">{{ Str::ucfirst($item->field_value) }}</option>
                            @endforeach
                          </select>
                        </div>


                        @if(Auth::user()->profile->gender == 'male')
                        <div class="form-group col-md-6">
                              <label for="marital_status">{{ translate('marital_status') }} </label>
                              <select class="form-control" name="marital_status">
                                 <option >{{ translate('marital_status') }}</option>
                                @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'male') as $item)
                                    <option value="{{ $item->field_value }}">{{ Str::ucfirst($item->field_value) }}</option>
                                @endforeach
                            </select>
                        </div>

                        @elseif(Auth::user()->profile->gender == 'female')
                        <div class="form-group input-group-sm">
                            <label for="maritals_status">Maritals Status </label>
                            <select class="form-control" name="marital_status">
                              <option >marital status</option>
                                @foreach($parameters->where('field_name','marital_status')->where('active', 1)->where('gender', '!=' , 'female') as $item)
                                    <option value="{{ $item->field_value }}">{{ Str::ucfirst($item->field_value) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endif


                          @if(Auth::user()->profile->gender == 'male')
                            <div class="form-group col-md-6">
                                <label for="profession">{{ translate('profession') }}</label>
                                <select class="form-control" name="profession">
                                   <option value="">{{ translate('profession') }}</option>
                                    @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'male') as $item)
                                      <option>{{ Str::ucfirst($item->field_value) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @elseif(Auth::user()->profile->gender == 'female')
                            <div class="form-group col-md-6">
                                <label for="profession">Professtion</label>
                                <select class="form-control" name="profession">
                                    <option value="">professtion</option>
                                    @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'female') as $item)
                                    <option>{{ Str::ucfirst($item->field_value) }}</option>
                                    @endforeach
                                </select>
                              
                            </div>
                          
                            @endif


                    
                      </div>
                      <button type="submit" class="btn btn-primary btn-lg">{{ translate('search') }}</button>
                    
                    </div>
                  
            </div>
          </form>
        </div>
    </section>


@endsection

@push('js')

@endpush


