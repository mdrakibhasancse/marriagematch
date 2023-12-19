@extends('frontend::layouts.frontendMaster')
@section('title',"Marriage Match BD")


@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
     
@endpush

@section('content')

<div role="main" class="main">
   
    <section class="page-header page-header-modern bg-color-light-scale-1 page-header-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-8 order-2 order-md-1 align-self-center p-static">
                    <h1 class="text-dark"><strong>{{ translate('register') }}</strong></h1>
                </div>
            </div>
        </div>
    </section>

      <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 pt-4 pb-5 my-5">
                <div class="card-dec card-default">
                    <div class="card-body shadow-lg rounded">
                        <form class="user-mobile-check-form" action="{{ route('register') }}" method="POST" id="user-create-form">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    Please fill all the fields
                                </div>
                             @endif

                           

                            <div class="form-group">
                                <label class="form-label mb-1 text-4">{{ translate('name') }}</label>
                                <input type="text" value="{{ old('name') }}" data-msg-required="Please enter your name." maxlength="100" class="form-control text-3 h-auto py-2 w3-light-gray" name="name" placeholder="Enter your name">
                            </div>
                            <div class="form-group">
                                <label class="form-label mb-1 text-4">{{ translate('email') }}</label>
                                <input type="email" value="{{ old('email') }}"  class="form-control text-3 h-auto py-2 w3-light-gray" name="email" placeholder="Enter your Email">
                            </div>


                            <div class="form-group col">
                                <label for="mobile">{{ translate('mobile') }} (ইংরেজিতে)</label>
                                <input type="text" id="mobile" name="mobile" class="form-control text-3 h-auto py-2 w3-light-gray input-mobile"value="{{ request()->cookie('usermobile') ?? old('mobile')}}" disabled>
                              
                                <div class="text-end">
                                    <a href="{{ route('unsaveMobile')}}">
                                        Try with another number
                                    </a>
                                </div>
                               

                                @error('mobile')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">

                            <div class="form-group form-group-sm">
                                <label for="date_of_birth">{{ translate('date_of_birth') }}:</label>

                                <div class="w3-row">

                                        <div class="w3-col s4">
                                            <select class="form-control text-3 h-auto py-2 w3-light-gray" id="day" name="day">

                                                <option value="">Day</option>
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{$i}}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="w3-col s4">
                                            <select class="form-control text-3 h-auto py-2 w3-light-gray" id="month" name="month">

                                                <option value="">Month</option>
                                                @foreach (config('m_parameter.month') as $key => $item)
                                                    <option value="{{ $key }}" {{ old('month') == $item  ? 'selected' : ' '}}>{{ Str::ucfirst($item) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w3-col s4">
                                            <select class="form-control text-3 h-auto py-2 w3-light-gray" id="year" name="year">
                                                <option value="">Year</option>
                                                @for ($i = date('Y') -16; $i >= date('Y') - 70; $i--)
                                                    <option value="{{$i}}">{{ $i }}</option>
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
                                    <label for="gender">{{ translate('profile_gender') }}</label>
                                    <select name="gender" id="gender" class="form-control text-3 h-auto py-2 w3-light-gray gender-select">
                                    <option value="">{{ translate('profile_gender') }}</option>
                                    @foreach (config('m_parameter.gender') as $item)
                                        <option value="{{ $item }}" {{ old('gender') == $item  ? 'selected' : ' '}}>{{ Str::ucfirst($item) }}</option>
                                    @endforeach
                                    </select>
                                    @error('gender')
                                    <span style="color:red">{{ $message }}</span>
                                     @enderror
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="profession">{{ translate('profession') }}</label>
                                    <select name="profession" id="profession" class="form-control text-3 h-auto py-2 w3-light-gray profession-select">
                                        <option value="">{{ translate('profession') }}</option>
                                    
                                    </select>
                                     @error('profession')
                                    <span style="color:red">{{ $message }}</span>
                                     @enderror
                                </div>
                            </div>


                        


                          <div class="form-group col-md-12">
                                <label for="password">{{ translate('password') }}</label>

                                <div class="input-group">
                                    
                                
                                <input id="password" type="password" name="password" class="form-control text-3 h-auto py-2 w3-light-gray" id="password" placeholder="{{ translate('password') }}"  value="{{ old('password')}}">
                                <div class="input-group-append">
                                    <span class="input-group-button btn btn-outline-light py-3 w3-light-gray" for="password"><i class="fa fa-eye-slash pass-show"></i></span>
                                </div>
                                </div>
                                @error('password')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div> 

                            <div class="form-group col">
                                <input type="submit" value="{{ translate('register') }}" class="btn btn-info btn-modern form-control rounded-pill">
                            </div>
                                
                        </div>
                          


                           

                        </form>
                    </div>
                </div>
            </div>
           
        </div>

    </div>

</div>
@endsection

@push('scripts')
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
            //  initialCountry: "auto",
            initialCountry: "bd",
            geoIpLookup: getIp,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            preferredCountries: ["bd", "us", "gb"],
            placeholderNumberType: "MOBILE",
            nationalMode: true,
            // separateDialCode:true,
            // autoHideDialCode:true,
            customContainer: "w-100",
            autoPlaceholder: "polite",
        });

     
   
    </script>

    <script type="text/javascript">
        /// some script
        // jquery ready start 
        $(document).ready(function () {
        $(document).on("submit", ".user-mobile-check-form", function(e) {
            e.preventDefault();
            // alert('ok');
            var that = $(this);
            var formData = that.serialize();
            if (phoneInput.isValidNumber()) {
                $('#valid_mobile').val(phoneInput.getNumber());
                    document.getElementById('user-create-form').submit();
    
            } else {

                alert('Check Mobile Number Again');
            }

            
            


        }); // jquery end
        }); // jquery end
    </script>

    <script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.pass-show', function(e){
        var that = $(this);
        if(that.hasClass('fa-eye-slash'))
        {
        that.removeClass('fa-eye-slash').addClass('fa-eye');
        that.closest('.input-group').find('#password').attr('type', 'text');

        }else
        {
        that.removeClass('fa-eye').addClass('fa-eye-slash');
        that.closest('.input-group').find('#password').attr('type', 'password');


        }
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





