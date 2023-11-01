@extends('admin::layouts.adminMaster')
@section('title')
    | User Update
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>


<link href="{{asset('assets/cropperjs-master/dist/cropper.min.css')}}" rel='stylesheet' type='text/css'>
<link href="{{asset('css/profileCreate.css')}}" rel="stylesheet" />

@endpush

@section('content') 

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="container-fluide">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">
                     <span class="badge badge-default">
                           User_Id: {{ $user->id }}, User_Mobile: {{ $user->mobile }}
                        ({{ $user->name }}), User_Email: {{ $user->email }}</span>
                    </h3>
                    <div class="card-tools">
                      
                    </div>
                </div>
                <div class="card-body w3-light-gray ">

                    <div class="row">
                        <div class="col-sm-3">
                          <div class="card card-widget">
                              <div class="card-header with-border">
                                  <h3 class="card-title">Upload Profile Picture </h3>
                                  <div class="card-tools pull-right">

                                  </div>
                              </div>
                              <div class="card-body w3-padding-large" style="min-height: 320px;">
                                  <div class="fb-profile">
                                      <div class="row">
                                          <div class="col-sm-12">
                                              <div class="profile-image">
                                                  @includeif('membership::admin.users.form.profileFeatureImg')
                                              </div>

                                              <div class="crop-profilepic-container">
                                                  <img style="display: none;" class="img-fluid w-100 mb-3"
                                                      id="crop-profilepic" src="">
                                              </div>



                                          </div>

                                          <div class="col-sm-12">

                                          
                                              <a id="btn-profilepic" class="btn-profilepic"
                                                  title="Change Profile Picture">


                                                  <span class="fa-stack fa-lg ">
                                                      <i class="fa fa-square-o fa-stack-2x "></i>
                                                      <i
                                                          class="fa fa-camera w3-text-white w3-hover-shadow w3-hover-deep-orange w3-round w3-card-4 w3-blue fa-stack-1x "></i>
                                                  </span>

                                              </a>


                                              <form method="post"
                                                  enctype="multipart/form-data"
                                                  action="{{ route('admin.userSettingProfilePicChange',$user->id)}}">

                                                   {{ csrf_field() }}

                                                    <input class="form-control" type="file" id="my_profilepic"
                                                      name="img_name" style="display: none;" />
                                              
                                               

                                                    <button type="reset"
                                                      class="w3-card-2 btn-profilepic-cancel w3-btn w3-round w3-gray btn-xs"><i
                                                          class="fa fa-times fa-2x w3-text-white"></i>
                                                    </button>

                                                    <button type="submit"
                                                      class="w3-card-2 btn-profilepic-submit w3-btn w3-round w3-green btn-xs"><i
                                                          class="fa fa-check-square fa-2x w3-text-white"></i>
                                                    </button>

                                              </form>


                                          </div>
                                      </div>


                                  </div>



                              </div>
                          </div>
                        </div>


                        <div class="col-sm-2">
                          <div class="card card-widget">
                              <div class="card-header with-border">
                                  <h3 class="card-title">Set Temporary Pass</h3>
                              </div>

                              <div class="card-body " style="min-height: 320px;">

                                  <div class="section-area">


                                     <form class="form-submit-post" method="post"
                                        action="{{ route('admin.userAction', ['user' => $user, 'action' => 'passwordUpdate']) }}">
                                        {{ csrf_field() }}
                                        <div class="form-group input-group-md">
                                            <label for="new_password">New Password:</label>
                                            <input autocomplete="off" type="text"
                                                placeholder="New Password for {{ $user->mobile }}"
                                                name="new_password"
                                                @if(auth()->user()->can('user-delete'))
                                                value="{{ old('new_password') ?: $user->password_temp }}"
                                                @endif
                                                class="form-control" id="new_password">

                                                @if(auth()->user()->can('user-delete'))
                                            <small class="text-muted">Previous Temp Pass: <b
                                                    class="w3-text-purple">{{ $user->password_temp }}
                                                </b></small>
                                                @endif


                                        </div>

                                        <button type="submit"
                                            class="w3-btn w3-round w3-blue next-btn-with-loading">Set</button>
                                    </form>
                                  </div>

                              </div>
                          </div>
                        </div>

                        <div class="col-sm-3">
                          <div class="card card-widget card-default">
                              <div class="card-header with-border">
                                  <h3 class="card-title">User Edit</h3>
                              </div>

                              <div class="card-body " style="min-height: 320px;">

                                  <div class="section-area">
                                     <form method="post" action="{{ route('admin.userInfoUpdate',$user->id)}}">
                                       @csrf
                                        <div class="form-group input-group-md">
                                            <label for="name">Name:</label>
                                            <input type="text"
                                                placeholder="Name {{ $user->name }}"
                                                name="name"
                                                value="{{ old('name') ?: $user->name }}"
                                                class="form-control form-control-sm" id="name" 
                                                @if(!auth()->user()->can('user-delete'))
                                                readonly
                                                @endif
                                                >
                                                @error('name')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                        </div>

                                         <div class="form-group input-group-md">
                                            <label for="email">Email:</label>
                                            <input type="text"
                                                placeholder="Email {{ $user->email }}"
                                                name="email"
                                                value="{{ old('email') ?: $user->email }}"
                                                class="form-control form-control-sm" id="email"

                                                @if(!auth()->user()->can('user-delete'))
                                                readonly
                                                @endif
                                                
                                                >
                                                @error('email')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                        </div>

                                       

                                        <div class="form-group input-group-md">
                                            <label for="mobile">Mobile: </label>
                                            <input type="text" name="mobile" class="form-control form-control-sm text-3 h-auto py-2 input-mobile" id="mobile"  value="{{$user->mobile }}"

                                            @if(!auth()->user()->can('user-delete'))
                                                readonly
                                            @endif
                                            
                                            >
                                            @error('mobile')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group input-group-md">
                                            <label for="date_of_birth">Date of Birth:</label>

                                          

                                        @php
                                        $year = \Carbon\Carbon::parse($user->dob)->format('Y');
                                        $month = \Carbon\Carbon::parse($user->dob)->format('m');
                                        $day = \Carbon\Carbon::parse($user->dob)->format('d');
                                        @endphp



                              

                                         

                                            <div class="w3-row">

                                                    <div class="w3-col s4">
                                                        <select class="form-control form-control-sm" id="day" name="day">
                                                            <option value="">Day</option>
                                                            @for ($i = 1; $i <= 31; $i++)
                                                                <option value="{{$i}}" {{ $day == $i  ? 'selected' : ' '}}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>

                                                    <div class="w3-col s4">
                                                        <select class="form-control form-control-sm" id="month" name="month">

                                                            <option value="">Month</option>
                                                            @foreach (config('m_parameter.month') as $key => $item)
                                                                <option value="{{ $key }}" {{ $month == $key  ? 'selected' : ' '}}>{{ Str::ucfirst($item) }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="w3-col s4">
                                                        <select class="form-control form-control-sm" id="year" name="year">
                                                            <option value="">Year</option>
                                                            @for ($i = date('Y') -16; $i >= date('Y') - 70; $i--)
                                                                <option value="{{$i}}" {{ $year == $i  ? 'selected' : ' '}}>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                            </div>
                                            @error('dob')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="row">
                                            
                                        <div class="form-group col-md-6">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="form-control form-control-sm gender-select">
                                            <option value="">select gender</option>
                                            @foreach (config('m_parameter.gender') as $item)
                                                <option value="{{ $item }}" {{ $user->gender == $item  ? 'selected' : ' '}}>{{ Str::ucfirst($item) }}</option>
                                            @endforeach
                                            </select>
                                            @error('gender')
                                            <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label for="profession">Profession</label>
                                            <select name="profession" id="profession" class="form-control form-control-sm profession-select">
                                                <option value="">select profession</option>
                                                @foreach($parameters->where('field_name','profession') as $item)
                                                    <option value="{{ $item->field_value }}" {{ $user->profession == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                                                @endforeach
                                            </select>
                                            @error('profession')
                                            <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        </div>
                                    

                                        <button 
                                        @if(!auth()->user()->can('user-delete'))
                                            type="button"
                                            class="w3-btn w3-round w3-blue "
                                                disabled
                                        @else

                                        type="submit"
                                            class="w3-btn w3-round w3-blue "
                                                
                                        @endif
                                            >Submit
                                        </button>
                                    </form>
                                  </div>

                              </div>
                          </div>
                        </div>

                        @if(auth()->user()->can('admin-package-show'))
                        <div class="col-sm-4">
                          <div class="card card-widget">
                              <div class="card-header with-border">
                                  <h3 class="card-title">Package Update for Admin</h3>
                              </div>

                              <div class="card-body " style="min-height: 320px;">

                                  
                                    <form action="{{ route('admin.pacakgeUpdateForAdmin',$user->id)}}" method="post">
                                        @csrf
                                       <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Choose Package</label>
                                            <select class="form-control form-control-sm" name="package_id">
                                            <option>choose package</option>
                                            @foreach ($packages as $item)
                                                {{-- @php
                                                    $profile = $user->profile->package_id;
                                                @endphp --}}
                                                <option value="{{ $item->id }}" {{ $user->profile->package_id == $item->id ? 'selected' : ' ' }}>{{$item->title}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Duration</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->duration ?? old('duration')}}" name="duration" type="text" placeholder="Duration">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Daily Contact</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->daily_contact_limit ?? old('daily_contact_limit')}}" name="daily_contact_limit" type="text" placeholder="Daily contact">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Total Contact</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->total_contact_limit ?? old('total_contact_limit')}}"name="total_contact_limit" type="text" placeholder="Total contact">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Daily Cv</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->daily_cv_collect_limit ?? old('daily_cv_collect_limit')}}"name="daily_cv_collect_limit" type="text" placeholder="Daily cv">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Total Cv</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->total_cv_collect_limit ?? old('total_cv_collect_limit')}}" name="total_cv_collect_limit" type="text" placeholder="Tatal cv">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Daily Proposal</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->daily_proposal_sent ?? old('daily_proposal_sent')}}"name="daily_proposal_sent" type="text" placeholder="Daily proposal">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Total Proposal</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->total_proposal_sent ?? old('total_proposal_sent')}}"name="total_proposal_sent" type="text" placeholder="Total proposal">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Daily Matched Profile</label>
                                            <input class="form-control form-control-sm" value="{{ $user->profile->daily_matched_profile_sent ?? old('daily_matched_profile_sent')}}"
                                            name="daily_matched_profile_sent" type="text" placeholder="Daily matched profile">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Total Matched Profile</label>
                                            <input class="form-control 
                                            form-control-sm" value="{{ $user->profile->total_matched_profile_sent ?? old('total_matched_profile_sent')}}"name="total_matched_profile_sent"  type="text" placeholder="Total matched profile">
                                        </div>

                                        <div class="form-group col-md-6">
                                           <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                        </div>

                                          
                                        
                                       </div>
                                    </form>
                                  

                              </div>
                          </div>
                        </div>
                        @endif
                    </div>

                    
                    @if(!$user->profile)
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.newUserProfileCreate',$user->id)}}" class="btn btn-primary btn-block">নতুন ইউজার প্রোফাইল তৈরি করুন</a>
                        </div>
                    </div>
                    @endif

                    <div>
                        <a href="{{route('admin.ordersAll',['user_id' => $user->id])}}" class="btn btn-primary">Order List</a>
                        <a href="{{route('admin.usersAll',['type'=>'contactUsers','userid' => $user->id])}}" class="btn btn-primary ">Contact users</a>
                        <a href="{{route('admin.usersAll',['type'=>'favouriteUsers','userid' => $user->id])}}" class="btn btn-primary">Favourite Users</a>
                        <a href="{{route('admin.usersAll',['type'=>'proposalUsers','userid' => $user->id])}}" class="btn btn-primary" class="btn btn-primary ">Proposal Users</a>
                        <a href="{{ route('admin.messageUsers',$user->id)}}" class="btn btn-primary ">Message Users</a>
                    </div>
                    <br>

                    @if($user->profile)

                    <div class="row">
                        <div class="col-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h4 class="card-title">New Profile</h4>
                                </div>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-12">

                      

                            <div class="card card-outline card-info ">
                                <div class="card-header">
                                    <h4 class="card-title">New Marriage Profile Info
                                      
                                        ({{ $user->profile->checked ? 'Checked' : 'Unchecked'}})
                                    </h4>
                                </div>
                                <div class="card-body">

                                    @includeif('membership::admin.users.form.marriageInfoForm')

                                </div>

                            </div>

                        </div>
                       
                    </div>
                   
                   

                   
                 
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-widget section-area">
                                <div class="card-header  card-outline card-info">
                                    <h4 class="card-title">New Education Info  ({{ $user->profile->education_info_checked ? 'Checked' : 'Unchecked'}})</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-2">
                                        <div class="output-edu-work">
                                            @includeIf('membership::admin.users.form.eduInfoDataShow')
                                        </div>
                                    </div>

                                    @includeif('membership::admin.users.form.eduInfoForm')
                                </div>

                            </div>

                        </div>
                      
                    </div>
                    
                  
                   
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-widget section-area">
                                <div class="card-header  card-outline card-info">
                                    <h4 class="card-title">New Relative Info  ({{ $user->profile->family_info_checked ? 'Checked' : 'Unchecked'}})</h4>
                                </div>
                                <div class="card-body">

                                    <div class="mb-2">

                                        <div class="output-edu-work">
                                            @includeIf('membership::admin.users.form.relativesInfoDataShow')
                                        </div>

                                    </div>

                                    @includeif('membership::admin.users.form.relativesInfoForm')


                                </div>

                            </div>

                        </div>
                      
                    </div>

                    @if(!$user->partnerPreference)
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.newUserPartnerPreference',$user->id)}}" class="btn btn-primary btn-block">নতুন পার্টনার প্রেফারেন্স তৈরি করুন</a>
                        </div>
                    </div>
                    @endif

                    @if($user->partnerPreference)
                    <div class="row">
                        <div class="col-12">

                            <div class="card card-widget ">
                                <div class="card-header  card-outline card-info">
                                    <h4 class="card-title">New Partner Preference  ({{ $user->profile->partner_info_checked ? 'Checked' : 'Unchecked'}})</h4>
                                </div>
                                <div class="card-body">

                                    @includeif('membership::admin.users.form.partnerPreference')
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                    @endif


                @endif


                </div>

            </div>




        </div>
    </section>

@endsection



@push('js')
<script src="{{asset('assets/cropperjs-master/dist/cropper.js')}}"></script>
<script src="{{asset('js/profileCreate.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function getIp(callback) {
        var ip = $(".ip").val();
        // var ip = '72.229.28.185';
        var infoUrl = 'https://ipinfo.io/json?ip=' + ip;
        fetch(infoUrl, {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then((resp) => resp.json())
            .catch(() => {
                return {
                    country: '',
                };
            })
            .then((resp) => callback(resp.country));
    }
    const phoneInputField = document.querySelector(".input-mobile");
    const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "bd",
        geoIpLookup: getIp,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        preferredCountries: ["bd", "us", "gb"],
        placeholderNumberType: "MOBILE",
        nationalMode: true,
        customContainer: "w-100",
        autoPlaceholder: "polite",
        
    });

</script>

<script type="text/javascript">

    $(document).ready(function () {
        $(document).on("submit", ".user-mobile-check-form", function(e) {
            e.preventDefault();
            var that = $(this);
            var formData = that.serialize();
            if (phoneInput.isValidNumber()) {
                $('#valid_mobile').val(phoneInput.getNumber());
                    document.getElementById('user-create-form').submit();
    
            } else {

                alert('Check Mobile Number Again');
            }
        }); 


        $(document).on("click", ".editEdu", function(e) {
            e.preventDefault();
            var that = $(this);
            var q = that.val();
            var url = that.attr('data-url');
            $('#editEduModal').modal('show');

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


        $(document).on("click", ".editRelative", function(e) {
            e.preventDefault();
            var that = $(this);
            var q = that.val();
            var url = that.attr('data-url');
            $('#editRelativeModal').modal('show');

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

        $(document).on('submit', '.form-submit-post', function(s) {

                s.preventDefault();

                var form = $(this),
                    url = form.attr('action'),
                    type = form.attr('method'),
                    alldata = new FormData(this);

                form.find(".help-block").remove();
                var text = '<span class="spinner-border spinner-border-sm"></span> Loading..';
                var prevText = form.find(".next-btn-with-loading").text();


                $.ajax({
                    url: url,
                    type: type,
                    // dataType: 'json',
                    data: alldata,
                    // mimeType:"multipart/form-data",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        form.find(".next-btn-with-loading").empty().append(text).attr(
                            'disabled', true);
                    },
                    
                }).done(function(response) {

                   
                    if (response.success == true) {
                        // $(".success-js-alert").show();

                        if (response.sessionMessage) {

                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'success',
                                title: 'Great!',
                                text: response.sessionMessage,
                                confirmButtonText: 'OK'
                            })

                            form.find(".next-btn-with-loading").empty().append(prevText).attr(
                                'disabled', false);
                        }


                    } else {
                        $.each(response.errors, function(key, value) {
                            $("[name~='" + key + "']").after(
                                "<span class='help-block w3-text-red'><strong>" +
                                value + "</strong></span>");

                        });

                        if (response.sessionMessage) {

                            const Toast = Swal.mixin({
                                toast: false,
                                // position: 'top',
                                showConfirmButton: true,
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            Toast.fire({
                                icon: 'error',
                                title: 'Opps!',
                                text: response.sessionMessage,
                                confirmButtonText: 'Try Again'
                            })

                            form.find(".next-btn-with-loading").empty().append(prevText).attr(
                                'disabled', false);
                        }
                    }

                }).fail(function() {
                    alert('error');
                });
        });

         


    }); 


            
            
        
</script>


<script>

$(document).ready(function() {

        var professions =  <?php echo json_encode($professions); ?>;

    $(document).on("change", ".gender-select", function(e){
    e.preventDefault();

        var that = $( this );
        var q = that.val();
        var altGender = q == 'male' ? 'female' : 'male';

        that.closest('.card-default').find(".profession-select").empty().append($('<option>',{
            value: '',
            text: 'Select profession'
        }));   

            $.each(professions, function (i, item) 
            {
            if(item.gender != altGender)
            {
                that.closest('.card-default').find(".profession-select").append("<option value='"+ item.field_value +"'>"+ item.field_value +"</option>");
            }
        });

    });


});

</script>





@endpush
