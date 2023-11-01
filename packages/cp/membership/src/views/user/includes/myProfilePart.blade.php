  <div class="container-fluid" id="printArea">
      
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $profile->user->fi()]) }}"
                                alt="profile">
                            </div>

                            <h3 class="profile-username text-center">{{ $profile->user->name}}</h3>

                            <p class="text-muted text-center p-0 m-0">
                              {{ translate('profile_created_by') }}:     {{$profile->profile_created_by}}</p>
                            <p class="text-muted text-center p-0 m-0">{{ translate('age') }}: {{ $profile->user->age() }}</p>
                            <p class="text-muted text-center p-0 m-0">{{ translate('marital_status') }}: {{ $profile->marital_status }}</p>
                            
                            <p class="text-muted text-center p-0 m-0">{{ translate('weight') }}: {{ $profile->weight }}</p>
                            <p class="text-muted text-center p-0 m-0">{{ translate('height') }}: {{ $profile->height }}</p>
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
                                <strong>{{ translate('about') }} ({{ $profile->user->name }})</strong>
                            </h3>

                            <div class="timeline-body">
                            {{ $profile->about_myself }}
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
                                  {{ $profile->user->age() }} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('profile_gender') }}</strong>
                                <p class="text-muted mb-1">
                                 {{ $profile->gender}} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('date_of_birth') }}</strong>
                                <p class="text-muted mb-1">
                                 {{ \Carbon\Carbon::parse($profile->dob)->format('d/m/Y')}} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('height') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->height }}
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('weight') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->weight }}
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('marital_status') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->marital_status }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('religion') }} / {{ translate('community') }}</strong>
                                 <p class="text-muted mb-1">
                                  @if($profile->religion)
                                  {{ $profile->religion->name ?? '' }} : {{ $profile->cast->name ?? ''}}
                                  @endif
                                
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('skin_color') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->skin_color }} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('body_build') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->body_build }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('education_level') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->education_level }} 
                                </p>


                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('profession') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->profession }} 
                                </p>

                                

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('language') }}</strong>
                                <p class="text-muted mb-1">
                                  {{ $profile->language_one }} 
                                </p>


                             

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('present_country') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $profile->present_country }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('present_address') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $profile->present_address }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('father_name') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $profile->father_name }} 
                                </p>

                                 <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">{{ translate('mother_name') }}</strong>
                                <p class="text-muted mb-1">
                                    {{ $profile->mother_name }} 
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
                                @if($profile->education_info_checked)
                                <div class="timeline-body">
                                @foreach ($userEducationRecords as $edu)

                                <p>
                                Passed {{ $edu->passed_degree }} in  {{ \Carbon\Carbon::parse($edu->passed_year)->format('Y')}} from Kollany College, Session:  {{ \Carbon\Carbon::parse($edu->year_from)->format('Y')}}- {{ \Carbon\Carbon::parse($edu->year_to)->format('Y')}}. 
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

                            @if($profile->partner_info_checked)

                            <div class="timeline-body">
                                <strong class="w3-text-orange">Age</strong>
                                <p class="text-muted mb-1">
                                  {{ $partnerPreference->min_age }} to  {{ $partnerPreference->max_age }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">Height</strong>
                                <p class="text-muted mb-1">
                                  {{ $partnerPreference->min_weight }} to  {{ $partnerPreference->max_weight }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">Marital Status</strong>
                                <p class="text-muted mb-1">
                                  {{ $partnerPreference->marital_status }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">Religion / Community</strong>
                                <p class="text-muted mb-1">
                                  {{ $partnerPreference->religion }} 
                                </p>

                                <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">Language</strong>
                                <p class="text-muted mb-1">
                                  {{ $partnerPreference->language }} 
                                </p>


                                  <hr class="pt-1 m-0">

                                <strong class="w3-text-orange">Country Living in</strong>
                                <p class="text-muted mb-1">
                                    {{ $partnerPreference->present_country }} 
                                </p>
                              
                                    
                            </div>
                            </div>
                            @endif
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
    </div>
