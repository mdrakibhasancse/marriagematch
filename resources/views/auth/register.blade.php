

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
                        <form class="user-mobile-check-form" action="{{ route('registerstep1') }}" method="POST" id="user-create-form">
                            @csrf
                       
                            <div class="form-group col">
                                <label for="mobile">{{ translate('mobile') }} (ইংরেজিতে)</label>
                                <input type="text" name="mobile" class="form-control text-3 h-auto py-2 w3-light-gray input-mobile" id="mobile"  value="{{ old('mobile')}}">
                                @error('mobile')
                                    <span style="color:red">{{ $message }}</span>
                                @enderror
                            </div>

                            <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">

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

 {{-- <script>

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

</script> --}}
@endpush





