@extends('userrole::user.layouts.userMaster')
@section('title')
    | Dashboard
@endsection



@section('content')

<section class="content pt-3">


        <div class="card shadow-lg">
        <div class="card-body text-center">
           <p class="p-0 m-0 text-md">
                {{-- প্রোফাইলটি আপডেট/কমপ্লিট করতে নিচের বাটনগুলোতে ক্লিক করুন --}}
                {{ translate('click_the_buttons_below_to_update_your_profile') }}
            </p>
        </div>
      </div>
 




     <div class="card card-info">
              <div class="card-header">
                {{-- data-card-widget="collapse" --}}
                <h3 class="card-title">  {{ translate('active_profile_settings') }} ({{ Auth::user()->name }})</h3>

                {{-- <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  </button>
                </div> --}}
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body w3-light-gray">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                     
                        <div class="card card-primary collapsed-card">
                            <div class="card-header" data-card-widget="collapse">
                                <h3 class="card-title">
                                    {{-- বিবাহ সম্পর্কিত তথ্য  --}}
                                    {{ translate('marriage_information') }}
                                </h3>
                                   &nbsp<span class="btn-review-profile">
                                    @if ($profile && $profile->checked == 1)
                                            ({{ translate('approved') }})
                                    @elseif($profile && $profile->checked == 0 )
                                         ({{ translate('pending') }})
                                       
                                    @endif
                                </span>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                 @includeIf('membership::user.includes.changeMarriageInfoForm')
                            </div>
                        <!-- /.card-body -->
                        </div>
                           <div class="card card-primary collapsed-card">
                            <div class="card-header" data-card-widget="collapse">
                                <h3 class="card-title">
                                    {{-- শিক্ষাবিষয়ক তথ্য --}}
                                    {{ translate('educational_information') }}
                                </h3>

                                  &nbsp<span class="btn-review-education">
                                    @if ($profile && $profile->education_info_checked  == 1)
                                            ({{ translate('approved') }})
                                   
                                    @elseif($profile && $profile->education_info_checked == 0)

                                          ({{ translate('pending') }})

                                    @endif
                            </span>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">

                                 <div class="mb-2">
                                    <div class="output-edu-work">
                                        @includeIf('membership::user.includes.eduInfoDataShow')
                                    </div>
                                </div>

                                @includeIf('membership::user.includes.marriageEductionPart')
                            </div>
                        <!-- /.card-body -->
                        </div>

                        <div class="card card-primary collapsed-card">
                            <div class="card-header" data-card-widget="collapse">
                                <h3 class="card-title">
                                    {{-- আত্মীয় সম্পর্কিত তথ্য --}}
                                        {{ translate('relatives_informations') }}
                                </h3>
                                &nbsp<span class="btn-review-relative">
                                    @if ($profile && $profile->family_info_checked == 1)
                                         ({{ translate('approved') }})

                                    @elseif($profile && $profile->family_info_checked == 0)

                                           ({{ translate('pending') }})

                                    @endif
                                </span>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="mb-2">

                                    <div class="output-edu-work">
                                        @includeIf('membership::user.includes.relativesInfoDataShow')
                                    </div>

                                </div>

                               @includeIf('membership::user.includes.marriageRelativesPart')
                            </div>
                        <!-- /.card-body -->
                        </div>


                        <div class="card card-primary collapsed-card">
                            <div class="card-header" data-card-widget="collapse">
                                <h3 class="card-title">
                                    {{-- পাত্র/পাত্রী সম্পর্কিত তথ্য --}}
                                     {{ translate('information_about_husband_wife') }}
                                </h3>
                                &nbsp<span class="btn-review-partner">
                                    @if ($profile && $profile->partner_info_checked == 1)
                                      ({{ translate('approved') }})

                                    @elseif($profile && $profile->partner_info_checked == 0)

                                        ({{ translate('pending') }})

                                    @endif
                                </span>
                                <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body card-default">
                                  @includeIf('membership::user.includes.marriagePartnerPreference')
                             
                            </div>
                        <!-- /.card-body -->
                        </div>

                        <div class="card card-primary">
                            
                            <div class="card-body">

                            
                            @if($profile && $profile->submit_by_user == 1)

                                <a href="" class=
                                "btn btn-primary disabled"
                                >
                                {{-- উপরের তথ্যগুলো এপ্রুভের জন্য সাবমিট করা হয়েছে। --}}
                            {{ translate('the_above_information_has_been_submitted_for_approval') }}
                                </a>

                            @else
                        
                             
                                <a href="{{ route('user.informationUpdate')}}" class=
                                "btn btn-primary 
                                    {{(($profile 
                                    && (Auth::user()->userRelativeRecords->count() > 0) 
                                    && (Auth::user()->userEducationRecords->count() > 0) 
                                    && (Auth::user()->partnerPreference and Auth::user()->partnerPreference->religion_id)) ? "" : "disabled")
                                    }}"
                                >
                                {{-- উপরের তথ্যগুলো এপ্রুভের জন্য সাবমিট করতে ক্লিক করুন --}}

                                    {{ translate('click_submit_to_approve_the_above_information') }}
                                </a>

                            @endif
                                    
                           

             
                                 
                            </div>
                        <!-- /.card-body -->
                        </div>
                        

                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


</section>


@endsection

@push('js')

    <script>$.ajaxSetup({
        headers: {'X-CSRF-Token': $('meta[name=token]').attr('content')}
        });
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(document).ready(function () {
        

            $(document).on("click", ".editEduUserEnd", function(e) {
                e.preventDefault();
                var that = $(this);
                var q = that.val();
                var url = that.attr('data-url');
                $('#editEduModalUserEnd').modal('show');

                    $.ajax({
                        url: url,
                        data : {q:q},
                        method: "get",
                        success: function(result){
            

                            // console.log(result);
                            $('#organization_name').val(result.edu.organization_name);
                            $('#organization_address').val(result.edu.organization_address);
                            $('#passed_degree').val(result.edu.passed_degree);
                            $('#passed_grade').val(result.edu.passed_grade);
                            $('#passed_department').val(result.edu.passed_department);
                            $('#year_from').val(new Date(result.edu.year_from).getFullYear());
                            $('#year_to').val(new Date(result.edu.year_to).getFullYear());
                            $('#passed_year').val(new Date(result.edu.passed_year).
                            getFullYear());
                            $('#edu_id').val(result.edu.id);
                        }
                    });
            }); 


            $(document).on("click", ".editRelativeUserEnd", function(e) {
                e.preventDefault();
                var that = $(this);
                var q = that.val();
                var url = that.attr('data-url');
                $('#editRelativeModalUserEnd').modal('show');

                    $.ajax({
                        url: url,
                        data : {q:q},
                        method: "get",
                        success: function(result){
            

                            console.log(result);
                            $('#r_details').val(result.relative.details);
                            $('#r_org_name').val(result.relative.org_name);
                            $('#r_working_role').val(result.relative.working_role);
                            $('#r_relation_with_user').val(result.relative.relation_with_user);
                            $('#r_name').val(result.relative.name);
                        
                            $('#relative_id').val(result.relative.id);
                            
                            
                    }
                    });
            }); 
        }); 

    </script>

    <script>


            $(document).ready(function() {

                var religions =  <?php echo json_encode($religions); ?>;
                var casts =  <?php echo json_encode($casts); ?>;

                $(document).on("change", ".religion-select", function(e){
                e.preventDefault();

                    var that = $( this );
                    var q = that.val();

                    that.closest('.card-default').find(".cast-select").empty().append($('<option>',{
                        value: '',
                        text: 'Select Cast'
                    }));

                

                    $.each(casts, function (i, item) {
                        if(item.religion_id == q)
                        {
                        that.closest('.card-default').find(".cast-select").append("<option value='"+ item.id +"'>"+ item.name +"</option>");
                        }
                    });

                

                });






            });

    </script>
@endpush



