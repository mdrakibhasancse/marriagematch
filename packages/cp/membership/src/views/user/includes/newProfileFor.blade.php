@extends('userrole::user.layouts.userMaster')
@section('title')
    | Dashboard
@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
     
@endpush

@section('content') 


<section class="content pt-3">
    <div class="card shadow-lg card-default">
        <div class="card-body">

         <p class="p-0 m-0 text-md text-center ">{{ translate('profile_for') }} ({{  translate($profile_for) }})</p>
         <br>
         <form method="post" action="{{ route('user.newProfileForStore') }}" id="user-create-form">

            <input type="hidden" value="{{ $profile_for }}" name="profile_for">
           @csrf
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="name">{{ translate('name') }}</label>
                    <input type="text" name="name" class="form-control" value="{{ auth()->user()->name}}" placeholder="Profile Name" id="name">
                </div>

                

                <div class="form-group col-md-6">
                    <label for="mobile">{{ translate('mobile') }} </label>
                    <input type="text" name="mobile" class="form-control text-3 h-auto py-2 input-mobile" id="mobile"  value="{{auth()->user()->mobile }}" readonly>
                </div>

                <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">



                <div class="form-group col-md-6">
                    <label for="email">{{ translate('email') }} </label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}"
                    placeholder="Email Address" id="email" readonly>
                </div>


                <div class="form-group input-group-sm col-md-6">
                    <label for="religion_id">{{ translate('religion') }} 
                    </label>
                    <select name="religion_id"  class="form-control religion-select @error('religion_id') is-invalid @enderror" required>
                        <option value="">{{ translate('religion') }} </option>
                        @foreach ($religions as $religion)
                        <option value="{{ $religion->id }}" {{ old('religion') == $religion->id  ? 'selected' : ''}}>{{ Str::ucfirst($religion->name) }}</option>
                        @endforeach
                    </select>
                    @error('religion_id')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group input-group-sm col-md-6">
                    <label for="cast_id">{{ translate('cast') }} 
                    </label>
                    <select id="cast_id" class="cast-select form-control" name="cast_id">
                        <option value="">{{ translate('cast') }} </option>
                         @foreach($casts as $cast)
                            <option value="{{ $cast->id }}">
                              {{ $cast->name ?? '' }}
                            </option>
                        @endforeach
                    </select>
                
                </div>

            </div>

            <button class="w3-btn w3-blue w3-hover-shadow w3-round mt-2 next-btn-with-loading">পরিবর্তী</button>


        </form>
    
        </div>
    </div>
</section>


@endsection

@push('js')


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
    $(function(){

        $(document).on('click', '.setting-cont-open-btn', function(e){
                e.preventDefault();

                // $(".setting-container").hide();
                $( this ).closest('.w3-container').find('.setting-container').toggle();
        });


        /////////////////


    

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