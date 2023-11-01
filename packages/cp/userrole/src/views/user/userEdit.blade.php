@extends('userrole::user.layouts.userMaster')
@section('title')
    | User Edit
@endsection

@push('css')
@endpush

@section('content') 

@php
$me = Auth::user();
@endphp

<br>

    <!-- Main content -->
    <section class="content">

       <div class="card card-default shadow">
            <div class="card-header ">
                <div class="card-title"> User Details: ID: {{ $me->id }} <a href="{{ url()->previous(); }}" class="btn btn-danger btn-sm"><i class="fas fa-arrow-left"></i></a>
                </div>

                <div class="card-tools">
                  
                </div>
            </div>
        
          </div>



          <div class="card-deck mb-3">
                <div class="card shadow">
                    
                  <div class="card-body">


                    <dl class="row">
                      

                      <dt class="col-sm-4">Name</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->name }}</dd>

                      <dt class="col-sm-4">Email</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->email }}</dd>

                      <dt class="col-sm-4">Mobile</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->mobile }}</dd>

                      <dt class="col-sm-4">Joined Date</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->created_at }}</dd>


                      @if($me->roles()->count())
                      <dt class="col-sm-4">Roles</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->roles()->count() }}</dd>
                      @endif

                      <dt class="col-sm-4">Purchase Orders</dt>
                      <dd class="col-sm-8 w3-light-gray">0</dd>



                      @if($me->member)

                      <dt class="col-sm-4">Team Members</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->member->children()->count() }}</dd>

                      <dt class="col-sm-4">Introducer/Referrer</dt>
                      <dd class="col-sm-8 w3-light-gray">{{ $me->application->introducer_mobile }}</dd>
                      @endif                      

                      

                      

                    </dl>
                  </div>
                </div>
                  
                <div class="card shadow">

                  <div class="card-header w3-deep-orange">Update Password <i class="fas fa-lock"></i></div>
                    
                  <div class="card-body">

                    <form id="member-application-form" action="{{ route('userrole.userUpdate') }}" method="post" enctype="multipart/form-data" class="user-mobile-check-form">


                <div class="form-group">
                  <label for="current_password">Current Password</label>
                  <input type="password" class="form-control form-control-sm shadow-sm  @error('current_password') w3-border w3-border-red @enderror" id="current_password"  placeholder="Current Password" required name="current_password" value="{{ old('current_password')  }}">
                  @error('current_password')     
                  <div class="text-danger">{{ $message }}</div>
                  @enderror   
                </div>


                <div class="form-group">
                  <label for="new_password">New Password</label>
                  <input type="password" class="form-control form-control-sm shadow-sm  @error('new_password') w3-border w3-border-red @enderror" id="new_password"  placeholder="New Password" required name="new_password" value="{{ old('new_password')  }}">
                  @error('new_password')     
                  <div class="text-danger">{{ $message }}</div>
                  @enderror   
                </div>

                <div class="form-group">
                  <label for="new_password_confirmation">new Password Confirm</label>
                  <input type="password" class="form-control form-control-sm shadow-sm  @error('new_password_confirmation') w3-border w3-border-red @enderror" id="new_password_confirmation"  placeholder="New Password Again" required name="new_password_confirmation" value="{{ old('new_password_confirmation')  }}">
                  @error('new_password_confirmation')     
                  <div class="text-danger">{{ $message }}</div>
                  @enderror   
                </div>


                      @csrf

                      <input type="submit" class="w3-btn w3-deep-orange w3-round w3-border" value="Update">
                  </form>

                    </div>
                  </div>
                </div>


    
 
    </section>
    <!-- /.content -->

@endsection



@push('js')
    <script>
         $( document ).ready(function() {
            $(document).on('click', '.copyboard', function(e) {
            e.preventDefault();

            $(".copyboard").text('Copy');
            $(this).text('Coppied!');
            var copyText = $(this).attr('data-text');

            var textarea = document.createElement("textarea");
            textarea.textContent = copyText;
            textarea.style.position = "fixed";
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand("copy");

            document.body.removeChild(textarea);
           });
           
         });
    </script>
@endpush
