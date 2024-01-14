 <div class="card card-primary card-default">
     <div class="card-body">

         <form method="post" class="form-user-setting" enctype="multipart/form-data"
             action="{{ route('admin.marriageInfoPost', $user->id)}}">
             {{ csrf_field() }}

         
            @if($user->profile->gender == 'male')
            <div class="form-group input-group-sm">
                 <label for="marital_status">বৈবাহিক অবস্থাঃ 
                    <span style="color:red">*</span>
                 </label>

               <select style="width:100%;" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status"  name="marital_status" required>
                    <option value="">select marital status</option>
                    @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'female') as $item)
                        <option value="{{ $item->field_value }}" {{ $user->profile->marital_status == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach
                </select>
                @error('marital_status')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            @elseif($user->profile->gender == 'female')
            <div class="form-group input-group-sm">
                 <label for="marital_status">বৈবাহিক অবস্থাঃ 
                    <span style="color:red">*</span>
                 </label>

               <select style="width:100%;" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status"  name="marital_status" required>
                    <option value="">select marital status</option>
                    @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'male') as $item)
                        <option value="{{ $item->field_value }}" {{ $user->profile->marital_status == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach
                    

                </select>
                @error('marital_status')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            @endif

            

            <div class="form-group input-group-sm">
                <label for="religion_id">ধর্মঃ 
                    <span style="color:red">*</span>
                </label>
                <select name="religion_id"  class="form-control religion-select @error('religion_id') is-invalid @enderror" required>
                    <option value="">Select Religion</option>
                    @foreach ($religions as $religion)
                    <option value="{{ $religion->id }}" {{ $user->profile->religion_id == $religion->id  ? 'selected' : ''}}>{{ $religion->name }}</option>
                    @endforeach
                </select>
                @error('religion_id')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group input-group-sm">
                <label for="cast_id">বর্ণঃ 
                </label>
                <select id="cast_id" class="cast-select form-control" name="cast_id">
                    <option value="">Select Cast</option>
                    @if($rid = $user->profile->religion_id)
                      @foreach($casts->where('religion_id', $rid) as $cast)
                        <option value="{{ $cast->id }}"
                        {{ $user->profile->cast_id == $cast->id ? 'selected' : ' '}}>
                        {{ $cast->name ?? '' }}
                        </option>
                      @endforeach
                    @endif
                </select>
               
            </div>



            <div class="form-group input-group-sm">
                 <label for="education_level">শিক্ষাগত যোগ্যতাঃ 
                    <span style="color:red">*</span>
                 </label>
                 <select style="width:100%;" class="form-control form-control-sm @error('education_level') is-invalid @enderror" id="education_level"  name="education_level" required>
                    <option value="">Education Level</option>
                        @foreach($parameters->where('field_name','education_level') as $item)
                            <option value="{{ $item->field_value }}" {{ $user->profile->education_level == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                        @endforeach
                </select>
                @error('education_level')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                
            </div>


            {{-- @if($user->profile->gender == 'male')
                <div class="form-group input-group-sm">
                    <label for="profession">পেশাঃ 
                        <span style="color:red">*</span>
                    </label>
                    <select name="profession" id="profession" class="form-control @error('profession') is-invalid @enderror" required>
                    <option value="">select profession</option>
                    
                    @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'female') as $item)
                        <option value="{{ $item->field_value }}" {{ $user->profile->profession == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach
                    
                    
                    </select>
                    @error('profession')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>

            @elseif($user->profile->gender == 'female')
                <div class="form-group input-group-sm">
                    <label for="profession">পেশাঃ 
                        <span style="color:red">*</span>
                    </label>
                    <select name="profession" id="profession" class="form-control @error('profession') is-invalid @enderror" required>
                    <option value="">select profession</option>   
                        @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'male') as $item)
                            <option value="{{ $item->field_value }}" {{ $user->profile->profession == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                        @endforeach
                    </select>
                    @error('profession')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
                    
            @endif --}}








            <hr class="w3-border">

            
            <div class="form-group input-group-sm">
                <label for="height">উচ্চতাঃ 
                    <span style="color:red">*</span>
                </label>

                <select style="width:100%;" class="form-control form-control-sm @error('height') is-invalid @enderror" id="height" name="height" required>
                    <option value="">select height</option>
                    @foreach (config('m_parameter.height') as  $item)
                        <option value="{{ $item }}" {{ $user->profile->height == $item  ? 'selected' : ''}}>{{ Str::ucfirst($item) }}</option>
                    @endforeach
                </select>
                @error('height')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group input-group-sm">
                <label for="weight">ওজনঃ
                    {{-- <span style="color:red">*</span> --}}
                </label>

                <select style="width:100%;" class="form-control form-control-sm @error('weight') is-invalid @enderror" id="weight" placeholder="Weight" name="weight" required>
                    <option value="">select weight</option>
                    @foreach (config('m_parameter.weight') as  $item)
                        <option value="{{ $item }}" {{ $user->profile->weight == $item  ? 'selected' : ''}}>{{ Str::ucfirst($item) }}</option>
                    @endforeach
                </select>
                @error('weight')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm">
                <label for="body_build">স্বাস্থের অবস্থাঃ
                    {{-- <span style="color:red">*</span> --}}
                </label>
                <select style="width:100%;" class="form-control form-control-sm @error('body_build') is-invalid @enderror" id="body_build" name="body_build" required>           
                    <option value="" >select body build</option>
                    @foreach($parameters->where('field_name','body_build') as $item)
                        <option value="{{ $item->field_value }}" {{ $user->profile->body_build == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach
                </select>
                @error('body_build')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm">
                <label for="skin_color">গায়ের রঙঃ
                    {{-- <span style="color:red">*</span> --}}
                </label>
                <select style="width:100%;" class="form-control form-control-sm @error('skin_color') is-invalid @enderror" id="skin_color" name="skin_color" required>        
                    <option >select skin color</option>
                 
                    @foreach($parameters->where('field_name','skin_color') as $item)
                        <option value="{{ $item->field_value }}"  {{ $user->profile->skin_color == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach
                  
                </select>
                @error('skin_color')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group input-group-sm">
                <label for="language_one">মাতৃভাষাঃ 
                    <span style="color:red">*</span>
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('language_one') is-invalid @enderror" 
                id="language_one"
                name="language_one"
                value="{{ $user->profile->language_one ?? old('language_one')}}" 
                placeholder="মাতৃভাষা (প্রথম ভাষা) e.g: Bangla"
                required/>
                @error('language_one')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm">
                <label for="language_two">দ্বিতীয় ভাষাঃ 
                   
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('language_two') is-invalid @enderror" 
                id="language_two"
                name="language_two"
                value="{{  $user->profile->language_two ?? old('language_two')}}" 
                placeholder="দ্বিতীয় ভাষা e.g: English"
                />
                @error('language_two')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group input-group-sm">
                <label for="language_three">তৃতীয় ভাষাঃ</label>
                <input 
                type="text"  
                class="form-control form-control-sm" 
                id="language_three"
                name="language_three"
                value="{{ $user->profile->language_three ?? old('language_three')}}" 
                placeholder="তৃতীয় ভাষা e.g: Hindi"/>
            </div>


            <hr class="w3-border">


            <div class="form-group input-group-sm {{ $errors->has('birth_country') ? ' has-error' : '' }}">
                <label for="birth_country">জন্মভূমি (দেশ) 
                    <span style="color:red">*</span>
                </label>
                <select  class="form-control select2  @error('birth_country') is-invalid @enderror" 
                id="birth_country" name="birth_country" required> 

                    <option >select birth country</option>
                    @foreach ($countries as  $country)
                        <option value="{{ $country->name }}" {{ $user->profile->birth_country == $country->name  ? 'selected' : ''}}>{{ Str::ucfirst($country->name) }}</option>
                    @endforeach
                </select>
                @error('birth_country')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group input-group-sm {{ $errors->has('birth_city') ? ' has-error' : '' }}">
                <label for="birth_city">জন্ম-শহর 
                     <span style="color:red">*</span>
                </label>
                <input type="text"  
                class="form-control form-control-sm @error('birth_city') is-invalid @enderror" id="birth_city"
                name="birth_city" value="{{  $user->profile->birth_city ?? old('birth_city')}}" 
                placeholder="Birth City"
                required/>
                @error('birth_city')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group input-group-sm">
                <label for="present_country">বর্তমান দেশ 
                     <span style="color:red">*</span>
                </label>
                <select  class="form-control select2  @error('present_country') is-invalid @enderror" 
                id="present_country"  name="present_country" required> 
                    <option >select present country</option>
                    @foreach ($countries as  $country)
                        <option value="{{ $country->name }}" {{ $user->profile->present_country == $country->name  ? 'selected' : ''}}>{{ Str::ucfirst($country->name) }}</option>
                    @endforeach
                </select>
                @error('present_country')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group input-group-sm">
                <label for="present_city">বর্তমান শহরঃ 
                     <span style="color:red">*</span>
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('present_city') is-invalid @enderror" 
                id="present_city"
                name="present_city"
                value="{{ $user->profile->present_city ?? old('present_city')}}" 
                placeholder="Present City"
                required/>
                @error('present_city')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm {{ $errors->has('present_address') ? ' has-error' : '' }} ">
                <label for="present_address">বর্তমান ঠিকানাঃ 
                     {{-- <span style="color:red">*</span> --}}
                </label>
                <textarea class="form-control form-control-sm @error('present_address') is-invalid @enderror" rows="2" id="present_address"
                name="present_address" placeholder="Present Address" required>@if($user->profile){{  $user->profile->present_address }}@endif</textarea>
                @error('present_address')
                    <span style="color: red">{{ $message }}</span>
                @enderror   
            </div>

            <div class="form-group input-group-sm">
            <label for="permanent_address">স্থায়ী ঠিকানাঃ 
                 {{-- <span style="color:red">*</span> --}}
            </label>
                <textarea class="form-control form-control-sm @error('permanent_address') is-invalid @enderror" rows="2" id="permanent_address"
                name="permanent_address" placeholder="Permanent Address" required>@if($user->profile){{ $user->profile->permanent_address }}@endif</textarea>
                @error('permanent_address')
                    <span style="color: red">{{ $message }}</span>
                @enderror  
            </div>



            <div class="form-group input-group-sm">
                <label for="citizenship">নাগরিকত্ব (সিটিজেনশীপ) পাওয়া দেশঃ</label>
                
                <select  class="form-control  select2" id="citizenship" name="citizenship"
                data-placeholder="Citizenship">
                    <option >select citizenship</option>
                    @foreach ($countries as  $country)
                        <option value="{{ $country->name }}" {{ $user->profile->citizenship == $country->name  ? 'selected' : ''}}>{{ Str::ucfirst($country->name) }}</option>
                    @endforeach
                </select>
            </div>


            <hr class="w3-border">

            <div class="form-group">
                <label for="profile_pic">প্রোফাইল ছবি (ইমেজ ফাইল):</label>
                <input type="file" name="profile_pic" class="form-control" placeholder="Profile Picture" id="profile_pic">
            </div>

            @if($user->profile && $user->profile->profile_pic)
            <img width="40" class="mb-3" src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $user->profile->profile_pic]) }}" alt=""> <small class=" badge badge-secondary">আগে আপলোড করা ছবি</small>
            <a href="{{ asset('storage/photo/'.$user->profile->profile_pic) }}" class="badge badge-secondary" Download> Download</a>
            @endif


            <div class="form-group">
                <label for="extra_photo_first">অতিরিক্ত ছবি ১ম (ইমেজ ফাইল):</label>
                <input type="file" name="extra_photo_first" class="form-control" placeholder="Extra Photo First" id="extra_photo_first">
            </div>

            @if($user->profile && $user->profile->extra_pic_first)
            <img width="40" class="mb-3" src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $user->profile->extra_pic_first]) }}" alt=""> <small class=" badge badge-secondary">আগে আপলোড করা ছবি</small>
             <a href="{{ asset('storage/photo/'.$user->profile->extra_pic_first) }}" class="badge badge-secondary" Download> Download</a>
            @endif


            <div class="form-group">
                <label for="extra_photo_second">অতিরিক্ত ছবি ২য় (ইমেজ ফাইল): </label>
                <input type="file" name="extra_photo_second" class="form-control" placeholder="Extra Photo Second" id="extra_photo_second">
            </div>

            @if($user->profile && $user->profile->extra_pic_second)
            <img width="40" class="mb-3" src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $user->profile->extra_pic_second ]) }}" alt=""> <small class=" badge badge-secondary">আগে আপলোড করা ছবি</small>
             <a href="{{ asset('storage/photo/'.$user->profile->extra_pic_second) }}" class="badge badge-secondary" Download> Download</a>
            @endif


            <div class="form-group">
                <label for="extra_photo_third">অতিরিক্ত ছবি ৩য় (ইমেজ ফাইল):</label>
                <input type="file" name="extra_photo_third" class="form-control" placeholder="Extra Photo Third" id="extra_photo_third">
                
            </div>

            @if($user->profile && $user->profile->extra_pic_third)
            <img width="40" class="mb-3" src="{{ route('imagecache', ['template' => 'ppsm', 'filename' => $user->profile->extra_pic_third ]) }}" alt=""> <small class=" badge badge-secondary">আগে আপলোড করা ছবি</small>
             <a href="{{ asset('storage/photo/'.$user->profile->extra_pic_third) }}" class="badge badge-secondary" Download> Download</a>
            @endif


            <hr class="w3-border">


            <div class="form-group input-group-sm">
                <label for="father_name">বাবার নামঃ 
                     <span style="color:red">*</span>
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('father_name') is-invalid @enderror" 
                id="father_name"
                name="father_name"
                value="{{ $user->profile->father_name ??  old('father_name') }}" 
                placeholder="Father Name"
                required/>
                @error('father_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group input-group-sm">
                <label for="father_occupation">বাবার পেশাঃ 
                     <span style="color:red">*</span>
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('father_occupation') is-invalid @enderror" 
                id="father_occupation"
                name="father_occupation"
                value="{{ $user->profile->father_occupation ?? old('father_occupation')}}" 
                placeholder="Father Occupation"
                required/>
                @error('father_occupation')
                    <span style="color: red">{{ $message }}</span>
                @enderror   
            </div>
            

            <div class="form-group input-group-sm">
                <label for="mother_name">মায়ের নামঃ 
                     <span style="color:red">*</span>
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('mother_name') is-invalid @enderror" 
                id="mother_name"
                name="mother_name"
                value="{{ $user->profile->mother_name ?? old('mother_name')}}" 
                placeholder="Mother Name"
                required/>
                @error('mother_name')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm">
                <label for="mother_occupation">মায়ের পেশাঃ 
                     <span style="color:red">*</span>
                </label>
                <input 
                type="text"  
                class="form-control form-control-sm @error('mother_occupation') is-invalid @enderror" 
                id="mother_occupation"
                name="mother_occupation"
                value="{{ $user->profile->mother_occupation ?? old('mother_occupation')}}" 
                placeholder="Mother Occupation"
                required/> 
                @error('mother_occupation')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm">
                <label for="number_of_brother">ভাইয়ের সংখ্যাঃ 
                    
                </label>
                <input 
                type="number"  min="0" step="1" 
                class="form-control form-control-sm @error('number_of_brother') is-invalid @enderror" 
                id="number_of_brother"
                name="number_of_brother"
                value="{{ $user->profile->number_of_brother ?? old('number_of_brother')}}" 
                placeholder="Numberof Brother"
                />
                @error('number_of_brother')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <div class="form-group input-group-sm {{ $errors->has('how_many_brother_married') ? ' has-error' : '' }}">
                <label for="how_many_brother_married">বিবাহিত ভাইয়ের সংখ্যাঃ 
                    
                </label>
                <input 
                type="number"  min="0" step="1" 
                class="form-control form-control-sm @error('how_many_brother_married') is-invalid @enderror" 
                id="how_many_brother_married"
                name="how_many_brother_married"
                value="{{ $user->profile->how_many_brother_married ?? old('how_many_brother_married')}}" 
                placeholder="How many brother married"
                />
                @error('how_many_brother_married')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>




            <div class="form-group input-group-sm {{ $errors->has('number_of_sister') ? ' has-error' : '' }}">
                <label for="number_of_sister">বোনের সংখ্যাঃ 
                     
                </label>
                <input 
                type="number"  min="0" step="1" 
                class="form-control form-control-sm @error('number_of_sister') is-invalid @enderror" 
                id="number_of_sister"
                name="number_of_sister"
                value="{{ $user->profile->number_of_sister ?? old('number_of_sister')}}" 
                placeholder="Number of Sister"
                />
                @error('number_of_sister')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>



            <div class="form-group input-group-sm {{ $errors->has('how_many_sister_married') ? ' has-error' : '' }}">
                <label for="howmany_sister_married">বিবাহিত বোনের সংখ্যাঃ 
                   
                </label>
                <input 
                type="number"  min="0" step="1" 
                class="form-control form-control-sm  @error('how_many_sister_married') is-invalid @enderror" 
                id="how_many_sister_married"
                name="how_many_sister_married"
                value="{{ $user->profile->how_many_sister_married ?? old('how_many_sister_married') }}" 
                placeholder="How many sister married"
                />
                @error('how_many_sister_married')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <hr class="w3-border">

            <div class="form-group input-group-sm">
                <label for="about_myself">নিজের সম্পর্কে কিছু লিখুনঃ 
                     <span style="color:red">*</span>
                </label>
                <textarea class="form-control form-control-sm @error('about_myself') is-invalid @enderror" rows="2" id="about_myself"
                value=""
                name="about_myself" placeholder="About Myself" required>@if($user->profile){{ $user->profile->about_myself ?? '' }}@endif</textarea>
                    
                @error('about_myself')
                    <span style="color: red">{{ $message }}</span>
                @enderror
            </div>


            <hr class="w3-border">


             <div class="checkbox">
                <label>
                     <input type="checkbox" name="photo_hide" {{$user->profile->photo_hide == 1 ? 'checked' : '' }}
                         /> প্রোফাইলের ছবি সবাইকে দেখাতে
                     চাই না
                </label>
             </div>

              @if($user->profile && $user->profile->gender == 'female')
                <div class="checkbox">
                    <label>
                    <input type="checkbox"  name="will_job_after_marriage" {{ $user->profile->will_job_after_marriage == 1 ? 'checked' : '' }} /> 
                    বিয়ের পর চাকুরি করতে ইচ্ছুক</label>
                </div>

            @endif


           

            <div class="checkbox">
                <label>
                <input type="checkbox" name="checked"
                {{$user->profile->checked == 1 ? 'checked' : '' }} /> প্রোফাইল ইনফো চেক করা হয়েছে </label>
            </div>

             <div class="checkbox">
                <label>
                <input type="checkbox" name="family_info_checked"
                {{$user->profile->family_info_checked == 1 ? 'checked' : '' }} /> ফেমিলি ইনফো চেক করা হয়েছে </label>
            </div>

             <div class="checkbox">
                <label>
                <input type="checkbox" name="education_info_checked"
                {{$user->profile->education_info_checked == 1 ? 'checked' : '' }} /> এডুকেশন চেক করা হয়েছে </label>
            </div>

             <div class="checkbox">
                <label>
                <input type="checkbox" name="partner_info_checked"
                {{$user->profile->partner_info_checked == 1 ? 'checked' : '' }} /> পার্টনার প্রেফারেন্স চেক করা হয়েছে </label>
            </div>


             <div class="checkbox">
                <label>
                <input type="checkbox" name="submit_by_user"
                {{$user->profile->submit_by_user == 1 ? 'checked' : '' }} /> এপ্রুভ এর জন্য সাবমিট করা হয়েছে </label>
            </div>

             <br>

             <div class="row">
                <div class="col-sm-12">
                    <div class="card card-default" style="margin-bottom: 5px;">
                        <div class="card-header">
                           <h6> User Profile Status:</h6>
                        </div>
                        <div class="card-body">
                           <b> Pending : প্রোফাইল ইনফো চেক করা হয়েছে এবং এপ্রুভ এর জন্য সাবমিট করা হয় নাই।</b>
                           <p></p>
                            <b>Active : প্রোফাইল ইনফো চেক করা হয়েছে এবং এপ্রুভ এর জন্য সাবমিট করা হয়েছে।</b>
                            <p></p>
                           <b> Inactive : প্রোফাইল ইনফো চেক করা হয় নাই এবং এপ্রুভ এর জন্য সাবমিট করা হয় নাই।</b>
                        </div>
                    </div>
                </div>

            </div>

            <br>

            {{-- add category subcategory --}}
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-default" style="margin-bottom: 5px;">

                        <div class="card-header">
                            <h3 class="card-title">Add Profile Category & SubCategory</h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                 @foreach ($categories as $cat)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <div class="form-check">
                                            <input class="form-check-input" type="checkbox" data-id="{{ $cat->id }}" id="cat-{{ $cat->id }}" name="categories[]" value="{{ $cat->id }}"
                                                {{ in_array($cat->id,$user->profileCategories()->pluck('profile_category_id')->toArray()) ? 'checked': " "}}>
                                            <label class="form-check-label" for="cat-{{ $cat->id }}">{{ $cat->title }}</label>
                                            </div>
                                            @foreach($cat->profileSubcategories as $subcat)
                                            <div class="form-check">
                                                &nbsp;&nbsp;&nbsp;<input class="form-check-input" type="checkbox" data-category-id="{{ $cat->id }}" id="subcat-{{ $subcat->id }}" name="subcategories[]" value="{{ $subcat->id }}"
                                                    {{ in_array($subcat->id,$user->profileSubcategories()->pluck('profile_subcategory_id')->toArray()) ? 'checked' : " "}}>
                                                <label class="form-check-label" for="subcat-{{ $subcat->id }}">{{ $subcat->title }}</label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
             {{-- add category subcategory --}}
              <br>
             <div class="">
                 <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">আপডেট করুন</button>
             </div>




         </form>

     </div>
 </div>

 @push('js')
   
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
 
