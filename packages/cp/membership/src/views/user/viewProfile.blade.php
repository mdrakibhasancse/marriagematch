@extends('userrole::user.layouts.userMaster')
@section('title')
    | Dashboard
@endsection

@push('css')
    
@endpush

@section('content') 

@php
    $me = Auth::user();
    $myProfile = Auth::user()->profile;
    $uProfile = $user->profile;
    $uPP = $user->partnerPreference;
@endphp


  
    <!-- Main content -->
    <section class="content pt-3">
      <div class="container-fluid" id="printArea">
      
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $user->fi()]) }}"
                                alt="profile">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name}}</h3>

                            <p class="text-muted text-center p-0 m-0">Profile created by {{$uProfile->profile_created_by}}</p>
                            <p class="text-muted text-center p-0 m-0">{{ translate('age') }}: {{ $user->age() }}</p>
                            <p class="text-muted text-center p-0 m-0">{{ translate('marital_status') }}: {{ $uProfile->marital_status }}</p>
                            
                            <p class="text-muted text-center p-0 m-0">{{ translate('weight') }}: {{ $uProfile->weight }}</p>
                            <p class="text-muted text-center p-0 m-0">{{ translate('height') }}: {{ $uProfile->height }}</p>
                        </div>
                        <!-- /.card-body -->

                          
                        </div>
                    </div>
                    
                </div>
            </div>
          <!-- /.col -->
        </div>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
            
              <div class="card-header no-print">
                <h3 class="card-title mt-2">
                   {{ translate('profile_details') }}
                </h3>

                <div class="card-tools">
                    <a href="" onclick="return printDiv('printArea');" class="btn btn-info ml-3 no-print"><i class="fa fa-print"></i> Print</a>
                    

                    <script type="text/javascript">
                        function printDiv(divName) {
                            var printContents = document.getElementById(divName).innerHTML;
                            var originalContents = document.body.innerHTML;
                            document.body.innerHTML = printContents;
                            window.print();
                        }
                    </script>
                </div>
                </div>
              <div class="card-body" >
                <div class="tab-content">
               
                  <!-- /.tab-pane -->
                  <div class="tab-pane active" id="timeline ">
                    <!-- The timeline -->
                    <div class="timeline timeline-inverse">
                    
                      <div>
                        <i class="fas fa-info-circle bg-primary"></i>
                       
                            <div class="timeline-item">
                            

                            <h3 class="timeline-header"> 
                                <strong>{{ translate('about') }} ({{ $user->name }})</strong>
                            </h3>

                            <div class="timeline-body">
                            {{ $uProfile->about_myself }}
                            </div>
                            
                            </div>
                        </div>
                        
                        <div>
                            <i class="fas fa-user bg-primary"></i>

                            <div class="timeline-item">

                            <h3 class="timeline-header"> 
                                <strong>{{ translate('backgroud') }}</strong>
                            </h3>

                           <div class="timeline-body">
                                <strong class="w3-text-orange">{{ translate('age') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $user->age() }} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('profile_gender') }}</strong>
                                <p class="text-muted mb-1">
                                 {{ $uProfile->gender}} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('date_of_birth') }}</strong>
                                <p class="text-muted mb-1">
                                 {{ \Carbon\Carbon::parse($uProfile->dob)->format('d/m/Y')}} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('height') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->height }}
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('weight') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->weight }}
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('marital_status') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->marital_status }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('religion') }} / {{ translate('community') }}</strong>
                                <p class="text-muted mb-1">
                                  @if($uProfile->religion)
                                  {{ $uProfile->religion->name ?? '' }} : {{ $uProfile->cast->name ?? ''}}
                                  @endif
                                
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('skin_color') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->skin_color }} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('body_build') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->body_build }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('education_level') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->education_level }} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('profession') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->profession }} 
                                </p>

                                

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('language') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $uProfile->language_one }} 
                                </p>


                             

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('present_country') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $uProfile->present_country }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('present_address') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $uProfile->present_address }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('father_name') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $uProfile->father_name }} 
                                </p>

                                 <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('mother_name') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $uProfile->mother_name }} 
                                </p>

                              
                                    
                            </div>
                            </div>
                        </div>


                        <div>
                            <i class="fas fa-graduation-cap bg-primary"></i>

                            <div class="timeline-item">

                                <h3 class="timeline-header"> 
                                    <strong>{{ translate('education') }}</strong>
                                </h3>
                                @if($uProfile->education_info_checked)
                                <div class="timeline-body">
                                @foreach ($user->userEducationRecords as $edu)

                                <p>
                                Passed {{ $edu->passed_degree }} in  {{ \Carbon\Carbon::parse($edu->passed_year)->format('Y')}} from {{$edu->organization_name}}, Session:  {{ \Carbon\Carbon::parse($edu->year_from)->format('Y')}}- {{ \Carbon\Carbon::parse($edu->year_to)->format('Y')}}. 
                                </p>
                              

                                <hr>

                                @endforeach
                                    
                                </div>
                                 @endif
                            </div>
                        </div>


                        <div>
                            <i class="fas far fa-file-alt bg-primary"></i>

                            <div class="timeline-item">

                              <h3 class="timeline-header"> 
                                  <strong>{{ translate('what_is_looking_for') }}</strong>
                              </h3>

                              @if($uProfile->partner_info_checked)

                              <div class="timeline-body">

                                   <br>
                                  <div class="d-flex justify-content-around">
                                    <p class="text-center text-gray">
                                      <img class="profile-user-img img-fluid img-circle"
                                      src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $user->fi()]) }}"
                                      alt="profile"><br> <br>
                                      @if($user->gender == 'male')
                                      {{ translate('his_preference') }}
                                      @else
                                       {{ translate('her_preference') }}
                                      @endif
                                  
                                    </p>

                                    <p style="margin-top:40px;" >{{ translate('you_match') }} {{$me->matchRate($user)}}/7   {{ translate('of') }}
                                      @if($user->gender == 'male')
                                      {{ translate('his_preference') }}
                                      @else
                                          {{ translate('her_preference') }}
                                      @endif
                                  </p>

                                   
                                    <p class="text-center text-gray"> 
                                      <img class="profile-user-img img-fluid img-circle"
                                      src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $me->fi()]) }}"
                                      alt="profile"><br><br>
                                      {{ translate('your_profile_match') }}
                                  
                                    </p>
                                
                                  

                                  </div>

                                  <hr class="pt-1 m-0">
                                  <strong class="w3-text-orange">{{ translate('age') }}</strong>
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                      {{ $uPP->min_age  ?? null}} to  {{ $uPP->max_age ?? null }} 
                                    </p>

                                     
                                  
                                    @if($me->ageMatched($user))

                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>
                                    @else
                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>
                                    @endif
                                  

                                  </div>
                                

                                  <hr class="pt-1 m-0">

                                  <strong class="w3-text-orange">{{ translate('religion') }} / {{ translate('community') }}</strong>
                                
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                        {{ $uPP->religion->name  ?? null}}: 
                                         {{ $uPP->cast->name  ?? null}}, 
                                    </p>

                                    {{-- {{ dd($myProfile->cast_id)}} --}}
                                    @if($me->religionMatched($user))

                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>
                                    @else
                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>
                                    @endif

                                
                                    

                                  </div>

                                  <hr class="pt-1 m-0">

                                  <strong class="w3-text-orange">{{ translate('marital_status') }}</strong>
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                      {{ $uPP->marital_status ?? null }} 
                                    </p>

                                    @if($me->maritalStatusMatched($user))

                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>

                                    @else
                                      <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>
                                    @endif
                                    

                                  </div>



                                   <hr class="pt-1 m-0">

                                  <strong class="w3-text-orange">{{ translate('profession') }}</strong>
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                      {{ ucfirst($uPP->profession ?? null )}} 
                                    </p>

                                    @if($me->professionMatched($user))

                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>

                                    @else
                                      <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>
                                    @endif
                                    

                                  </div>

                                  <hr class="pt-1 m-0">

                                  <strong class="w3-text-orange">{{ translate('language') }}</strong>
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                      {{ Str::ucfirst($uPP->language ?? null) }} 
                                    </p>

                                    @if($me->languageMatched($user))

                                      <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>

                                    @else

                                      <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>

                                    @endif

                                  
                                  </div>


                                  <hr class="pt-1 m-0">
                          
                                  <strong class="w3-text-orange">{{ translate('present_country') }}</strong>
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                        {{ $uPP->present_country  ?? null}} 
                                    </p>


                                    @if($me->presentCountryMatched($user))

                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>

                                    @else
                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>

                                    @endif
                                  </div>

                                  <hr class="pt-1 m-0">
                                  <strong class="w3-text-orange">{{ translate('birth_country') }}</strong>
                                  <div class="d-flex justify-content-between">
                                    <p class="text-muted mb-1">
                                        {{ $uPP->birth_country  ?? null}} 
                                    </p>

                                    @if($me->birthCountryMatched($user))

                                    <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-check text-success"></i></p>

                                    @else

                                      <p style="background: #ede6e6; height: 20px; width: 20px; font-size: 12px; border-radius: 50%; line-height:20px; text-align:center"><i class="fa fa-minus text-dark"></i></p>

                                    @endif
                                  </div>

                                  
                                    
                                
                                      
                              </div>
                              @endif
                            </div>
                            
                        </div>
                        
                        {{-- <div>
                        <i class="far fa-clock bg-gray"></i>
                      </div> --}}
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                 
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

      
    </section>


@endsection

@push('js')
<script src="{{asset('/')}}alt/plugins/datatables-buttons/js/buttons.print.min.js"></script>

@endpush