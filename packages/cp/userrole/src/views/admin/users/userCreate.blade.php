@extends('admin::layouts.adminMaster')
@section('title')
    | User Create
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
     
@endpush

@section('content') 


    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Create</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
              <li class="breadcrumb-item active">User Create</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header bg-info">
            <h4 class="card-title">Create New User</h4>
            <div class="card-tools">
                <a class="btn btn-primary btn-xs" href="{{ route('admin.usersAll') }}"> Back</a>
            </div>
        </div>
 
          <form id="user-create-form" action="{{ route('admin.userStore')}}" method="post" enctype="multipart/form-data" class="user-mobile-check-form">
          @csrf
          <div class="card-body">
            <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Name" value="{{ old('name')}}">
                    @error('name')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>
                  {{-- <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username" value="{{ old('username')}}">
                     @error('username')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div> --}}

                  <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email" value="{{ old('email')}}">
                     @error('email')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" class="form-control input-mobile" id="mobile"  value="{{ old('mobile')}}">
                    @error('mobile')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <input type="hidden" id="valid_mobile" name="valid_mobile" value="{{ old('valid_mobile')  }}">

        

                   <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password" value="{{ old('password')}}">
                     @error('password')
                        <span style="color:red">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="form-group col-md-6">
                    <label for="image">Image</label>
                    <div class="input-group">
                         <input type="file" name="image">
                    </div>
                  </div>
                </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>

        </form>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->

@endsection



@push('js')
   
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
    // get the country data from the plugin
    // const countryData = window.intlTelInputGlobals.getCountryData();
    // console.log(countryData);
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
        //  customPlaceholder: function(selectedCountryPlaceholder, selectedCountryData)
        // {
        //     return "e.g. " + selectedCountryPlaceholder;
        // },
    });

     
    //country changed event
    // phoneInputField.addEventListener("countrychange", function() {
    //     // do something with iti.getSelectedCountryData()
    //     // console.log(phoneInput.getSelectedCountryData().iso2);
    //     // console.log(phoneInput.getSelectedCountryData());
    //     $(".country_name").val(phoneInput.getSelectedCountryData().name);
    //     $(".mobile_country").val(phoneInput.getSelectedCountryData().iso2);
    //     $(".calling_code").val(phoneInput.getSelectedCountryData().dialCode);
    // });
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
@endpush
