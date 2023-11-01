@extends('userrole::user.layouts.userMaster')
@section('title')
    | Dashboard
@endsection

@push('css')
@endpush

@section('content') 

<br>

    <!-- Main content -->
    <section class="content">

      <div class="card shadow-lg">
        <div class="card-body text-center">
          <p class="p-0 m-0 text-md">
            {{-- আপনি নতুন প্রোফাইল তৈরি করতে যাচ্ছেন --}}
             {{ translate('you_are_going_to_create_a_new_profile') }}
          </p>
        </div>
      </div>
       
    </section>

    <section class="pt-4">
        <div class="container">
              <div class="card card-primary">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title text-lg " >
                      {{-- নতুন প্রোফাইল তৈরি করুন --}}
                      {{ translate('create_new_profile') }}
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="get" action="{{ route('user.newProfileFor')}}">

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="me" checked>{{ translate('for_yourself') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="brother" >{{ translate('for_brother') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="sister" >{{ translate('for_sister') }}
                        </label>
                        </div>



                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="nephew" >{{ translate('for_nephew') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="niece" >{{ translate('for_niece') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="son" >{{ translate('for_son') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="daughter" >  {{ translate('for_daughter') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="friend" >
                        {{ translate('for_a_friend') }}'
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="cousin" >
                              {{ translate('for_cousins') }}
                        </label>
                        </div>

                        <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" name="profile_for" class="form-check-input" value="other" >{{ translate('for_others') }}
                        </label>
                        </div>
                        @csrf
                        
                        <button class="w3-btn w3-blue w3-hover-shadow w3-round mt-2 next-btn-with-loading">{{ translate('next_step') }}</button>
                    </form>


                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


             
        </div>
    </section>
    <!-- /.content -->
    <p class="text-center text-xl"> {{ translate('or') }}</p>
    <section>
         <div class="container">
             <div class="card text-center shadow-lg">
               <div class="card-body">
                 <p class="card-text text-md">
                  {{-- আপনি যদি চান যে আপনার হয়ে আমরাই প্রোফাইল তৈরি করে দিই, তাহলে নিচের বাটনে ক্লিক করে সিভি ও চার কপি ছবি আপলোড করে দিন। আমরাই আপনার জন্য একটি চমৎকার প্রোফাইল তৈরি করে দিব। --}}
                     {{ translate('if_you_want_us_to_create_a_profile_for_you_click_the_button_below_and_upload_your_cv_and_four_copies_of_photos_we_will_create_a_wonderful_profile_for_you') }}
                </p>
               </div>
             </div>
         </div>
    </section>

    <section class="pt-4">
        <div class="container">
              <div class="card card-primary {{session('card-open') ? '' : 'collapsed-card'}} ">
                <div class="card-header" data-card-widget="collapse">
                    <h3 class="card-title text-lg"><i class="fas fa-upload"></i>
                       {{-- সিভি ও ছবি আপলোড করুন --}}
                          {{ translate('upload_cv_and_photo') }}
                    </h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                        </button>
                    </div>
                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                   <form method="post" enctype="multipart/form-data" action="{{ route('user.cvPictureUpload')}}">
                    @csrf
                    <div class="form-group">
                      <label for="cv">
                        {{-- সিভি/বায়োডাটা (পিডিএফ/ওয়ার্ড/ইমেজ ফাইল) --}}
                          {{ translate('cv_biodata__pdf_fword_image_file') }} :</label>
                      <input type="file" name="cv" class="form-control" placeholder="সিভি / বায়োডাটা" id="cv" accept="pdf/doc">
                       @error('cv')
                           <span style="color:red">{{ $message}}</span>
                        @enderror
                        <div class="text-right">
                            <small>
                               {{-- সিভি কেমন হবে সেই ধারনার জন্য নিচের  বাটনে ক্লিক করে  সিভি ফরম ডাউনলোড করে নিতে পারেন  --}}
                                  {{ translate('you_can_download_the_cv_form_by_clicking_the_button_below_to_get_an_idea_of_​​how_the_cv_will_look_like') }}
                               <br>
                                
                            <a class="btn-link" href="">
                              {{-- ডাউনলোড সিভি ফরম --}}
                              {{ translate('download_cv_form') }}
                            </a>
                            </small> 
                        </div>

                       
                    </div>

                    <hr>

                    <div class="form-group">
                      <label for="profile_pic">
                        {{-- প্রোফাইল ছবি (ইমেজ ফাইল) --}}
                        {{ translate('profile_picture') }}:</label>
                      <input type="file" name="profile_pic" class="form-control" placeholder="প্রোফাইলের" id="profile_pic">
                       @error('profile_pic')
                           <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="extra_photo_first">
                        {{-- অতিরিক্ত ছবি ১ম (ইমেজ ফাইল) --}}
                        {{ translate('extra_photo_first') }}:</label>
                      <input type="file" name="extra_photo_first" class="form-control" placeholder="অতিরিক্ত ছবি ১ম" id="extra_photo_first">
                       @error('extra_photo_first')
                           <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="extra_photo_second">
                        {{-- অতিরিক্ত ছবি ২য় (ইমেজ ফাইল) --}}
                       {{ translate('extra_photo_second') }} :</label>
                      <input type="file" name="extra_photo_second" class="form-control" placeholder="অতিরিক্ত ছবি ২য়" id="extra_photo_second">
                      @error('extra_photo_second')
                           <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                      <label for="extra_photo_third">
                        {{-- অতিরিক্ত ছবি ৩য় (ইমেজ ফাইল) --}}
                             {{ translate('extra_photo_third') }}:</label>
                      <input type="file" name="extra_photo_third" class="form-control" placeholder="অতিরিক্ত ছবি ৩য়" id="extra_photo_third">
                       @error('extra_photo_third')
                           <span style="color:red">{{ $message}}</span>
                        @enderror
                    </div>

                    

                     <div class="form-group">
                        <label for="profile_for">
                          {{-- প্রোফাইলটি কার জন্য --}}
                                   {{ translate('who_is_the_profile_for') }} ?:<label>
                        <select class="form-control" name="profile_for" id="profile_for">

                          <option value="">
                            {{-- কার জন্য প্রোফাইল তা সিলেক্ট করুন --}}
                            {{ translate('select_who_the_profile_is_for') }}

                          </option>
                          <option value="me">
                            {{-- নিজের জন্য --}}
                            {{ translate('for_yourself') }}
                          </option>               
                          <option value="brother">
                            {{-- ভাইয়ের জন্য --}}
                           {{ translate('for_brother') }}
                          </option>
                          <option value="sister">
                            {{-- বোনের জন্য --}}
                            {{ translate('for_sister') }}
                          </option>
                          <option value="nephew">
                            {{-- ভাগিনার / ভাতিজার জন্য  --}}
                            {{ translate('for_nephew') }}
                          </option>
                          <option value="niece">
                            {{-- ভাগনির / ভাতিজীর জন্য  --}}
                            {{ translate('for_niece') }}
                          </option>
                          <option value="son">
                            {{-- ছেলের জন্য --}}
                              {{ translate('for_son') }}
                          </option>
                          <option value="daughter">
                            {{-- মেয়ের জন্য --}}
                                {{ translate('for_daughter') }}
                          </option>
                          <option value="cousin">
                            {{-- চাচাতো/মামাতো/খালাতো/ফুফাতো ভাই-বোনের জন্য --}}
                              {{ translate('for_cousins') }}
                          </option>
                          <option value="friend">
                            {{-- বন্ধুর জন্য --}}
                             {{ translate('for_a_friend') }}
                          </option>
                          <option value="other">
                            {{-- অন্যান্যের জন্য --}}
                             {{ translate('for_others') }}
                          </option>
 
                        </select>
                        @error('profile_for')
                           <span style="color:red">{{ $message}}</span>
                        @enderror
                      </div>

                       <div class="form-group">
                          <label for="gender">
                            {{-- প্রোফাইল জেন্ডার --}}
                            {{ translate('profile_gender') }}

                          </label>
                          <select name="gender" id="gender" class="form-control">
                          <option value="">{{ translate('profile_gender') }}</option>
                            @foreach (config('m_parameter.gender') as $item)
                                <option value="{{ $item }}" {{ old('gender') == $item  ? 'selected' : ' '}}>{{ Str::ucfirst($item) }}</option>
                            @endforeach
                          </select>
                           @error('profile_for')
                           <span style="color:red">{{ $message}}</span>
                           @enderror
                      </div>
                    

                
                    <button class="w3-btn w3-blue w3-hover-shadow w3-round mt-2 next-btn-with-loading">
                      {{-- সাবমিট করুন --}}
                      {{ translate('submit_now') }}
                    </button>


                  </form>

                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->


             
        </div>
    </section>

    <p class="text-center text-xl">{{ translate('or') }}</p>

    <section>
         <div class="container">
             <div class="card shadow-lg text-center">
               <div class="card-body">
                <a  class="btn-link text-md" href="tel:{{ $ws->contact_mobile}}">     
                  {{-- নতুন প্রোফাইলের জন্য কল করুন  --}}
                  {{ translate('call_for_new_profile') }}
                  {{ $ws->contact_mobile}}   
                </a>
                <br><br>
                <a  class="btn-link text-md" href="tel:{{ $ws->contact_mobile}}">
                  {{-- আমাদের হোয়াটসএপ নাম্বার  --}}
                    {{ translate('our_whatsapp_number') }}
                  {{ $ws->contact_mobile}}  </a>
                <br><br>
                <a  class="btn-link text-md" href="mailto:{{ $ws->contact_email}}">
                  {{-- ইমেইল  --}}
                      {{ translate('email') }}
                  {{ $ws->contact_email}} 
                </a>
                <br><br>
                <a  class="btn-link text-md" href="tel:{{ $ws->contact_mobile}}">
                  {{-- ইমো নাম্বার --}}
                      {{ translate('imo_number') }}
                  {{ $ws->contact_mobile}}  
                </a>
                

               </div>
              </div>
         </div>
    </section>

@endsection