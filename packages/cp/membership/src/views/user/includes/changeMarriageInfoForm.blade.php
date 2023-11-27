 

 <form method="post" enctype="multipart/form-data" action="{{ route('user.newProfileNextStepStore')}}">
    @csrf


    @if($profile->gender == 'male')
        <div class="form-group input-group-sm">
            <label for="marital_status">
                {{-- বৈবাহিক অবস্থাঃ  --}}
                {{ translate('marital_status') }}
                <span style="color:red">*</span>
            </label>
            <select style="width:100%;" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status"  name="marital_status" required>
            <option value=""> {{ translate('marital_status') }}</option>
                    @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'female') as $item)
                        <option value="{{ $item->field_value }}" {{ $profile->marital_status == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach
            </select>
            @error('marital_status')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
    @elseif($profile->gender == 'female')
        <div class="form-group input-group-sm">
            <label for="marital_status">
                {{-- বৈবাহিক অবস্থাঃ  --}}
                {{ translate('marital_status') }}
                <span style="color:red">*</span>
            </label>
            <select style="width:100%;" class="form-control @error('marital_status') is-invalid @enderror" id="marital_status"  name="marital_status" required>
            <option value=""> {{ translate('marital_status') }}</option>
                    @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'male') as $item)
                        <option value="{{ $item->field_value }}" {{ $profile->marital_status == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                    @endforeach

            </select>
            @error('marital_status')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
    @endif


    <div class="form-group input-group-sm">
        <label for="education_level">
            {{-- শিক্ষাগত যোগ্যতা  --}}
            {{ translate('education_level') }}
              <span style="color:red">*</span>
        </label>
        <select style="width:100%;" class="form-control form-control-sm @error('education_level') is-invalid @enderror" id="education_level"   name="education_level" required>
            <option value="">{{ translate('education_level') }}</option>
          
                @foreach($parameters->where('field_name','education_level') as $item)
                    <option value="{{ $item->field_value }}" {{ $profile->education_level == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach

        </select>
        @error('education_level')
            <span style="color: red">{{ $message }}</span>
        @enderror
        
    </div>


    <div class="form-group input-group-sm">
        <label for="religion_id">{{ translate('religion') }} 
            <span style="color:red">*</span>
        </label>
        <select name="religion_id"  class="form-control religion-select @error('religion_id') is-invalid @enderror" required>
            <option value="">{{ translate('religion') }} </option>
           @foreach ($religions as $religion)
             <option value="{{ $religion->id }}" {{ $profile->religion_id == $religion->id  ? 'selected' : ''}}>{{ $religion->name }}</option>
            @endforeach
        </select>
        @error('religion_id')
            <span style="color:red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
        <label for="cast_id">{{ translate('cast') }} 
        </label>
        <select id="cast_id" class="cast-select form-control" name="cast_id">
            <option value="">{{ translate('cast') }} </option>
               @if($rid = $profile->religion_id)
                @foreach($casts->where('religion_id', $rid) as $cast)
                <option value="{{ $cast->id }}"
                {{ $profile->cast_id == $cast->id ? 'selected' : ' '}}>
                {{ $cast->name ?? '' }}
                </option>
                @endforeach
            @endif
        </select>
    
    </div>

    

    <hr class="w3-border">



    <div class="form-group input-group-sm">
        <label for="height">
            {{-- উচ্চতা  --}}
          {{ translate('height') }}
              <span style="color:red">*</span>
        </label>

        <select style="width:100%;" class="form-control form-control-sm @error('height') is-invalid @enderror" id="height" name="height" required>
            <option value=""> {{ translate('height') }}</option>
            
            @foreach (config('m_parameter.height') as  $item)
                <option value="{{ $item }}" {{ $profile->height == $item  ? 'selected' : ''}}>{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
        @error('height')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>



    <div class="form-group input-group-sm">
        <label for="weight">
            {{-- ওজন --}}
               {{ translate('weight') }}
            <span style="color:red">*</span>
        </label>
        <select style="width:100%;" class="form-control form-control-sm @error('weight') is-invalid @enderror" id="weight" placeholder="Weight" name="weight" required>
            <option value=""> {{ translate('weight') }}</option>
            @foreach (config('m_parameter.weight') as  $item)
                <option value="{{ $item }}" {{ $profile->weight == $item  ? 'selected' : ''}}>{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
        @error('weight')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="body_build">
            {{-- স্বাস্থের অবস্থা --}}
             {{ translate('body_build') }}
            <span style="color:red">*</span>
        </label>
        <select style="width:100%;" class="form-control form-control-sm @error('body_build') is-invalid @enderror" id="body_build" name="body_build" required>         
            <option value="" > {{ translate('body_build') }}</option>
            @foreach($parameters->where('field_name','body_build') as $item)
                <option value="{{ $item->field_value }}" {{ $profile->body_build == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
            @endforeach
        </select>
        @error('body_build')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="skin_color">
            {{-- গায়ের রঙ --}}
             {{ translate('skin_color') }}
            <span style="color:red">*</span>
        </label>

        <select style="width:100%;" class="form-control form-control-sm @error('skin_color') is-invalid @enderror" id="skin_color" name="skin_color" required>          
            <option >{{ translate('skin_color') }}</option>
           
            @foreach($parameters->where('field_name','skin_color') as $item)
                <option value="{{ $item->field_value }}" {{ $profile->skin_color == $item->field_value  ? 'selected' : '' }}>{{ Str::ucfirst($item->field_value) }}</option>
            @endforeach
           
        </select>
        @error('skin_color')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
    
        <label for="language_one">
            {{-- মাতৃভাষা  --}}
             {{ translate('mother_language') }}
              <span style="color:red">*</span>
        </label>

        <input 
        type="text"  
        class="form-control form-control-sm @error('language_one') is-invalid @enderror" 
        id="language_one"
        name="language_one"
        value="{{ $profile->language_one ?? old('language_one')}}" 
        placeholder="{{ translate('mother_language') }}" 
        required
        />
        @error('language_one')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="language_two">
            {{-- দ্বিতীয় ভাষা --}}
            {{ translate('language_two') }}
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm @error('language_two') is-invalid @enderror" 
        id="language_two"
        name="language_two"
        value="{{  $profile->language_two ?? old('language_two')}}" 
        placeholder="{{ translate('language_two') }}" 
        
        />
        @error('language_two')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
        <label for="language_three">
            {{-- তৃতীয় ভাষা --}}
            {{ translate('language_three') }}
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm" 
        id="language_three"
        name="language_three"
        value="{{ $profile->language_three ?? old('language_three')}}" 
        placeholder="{{ translate('language_three') }}"
        />
    </div>

    <hr class="w3-border">


    <div class="form-group input-group-sm">
        <label for="birth_country">
            {{-- জন্মভূমি (দেশ)  --}}
            {{ translate('birth_country') }}
              <span style="color:red">*</span>
        </label>
        <select class="form-control select2 @error('birth_country') is-invalid @enderror" 
        id="birth_country" name="birth_country" required> 

            <option >{{ translate('birth_country') }}</option>
            @foreach ($countries as  $country)
                <option value="{{ $country->name }}" {{ $profile->birth_country == $country->name  ? 'selected' : ''}}>{{ Str::ucfirst($country->name) }}</option>
            @endforeach
        </select>
        @error('birth_country')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>



    <div class="form-group input-group-sm">
        <label for="birth_city">
            {{-- জন্ম-শহর  --}}
            {{ translate('birth_city') }}
              <span style="color:red">*</span>
        </label>
        <input type="text"  
        class="form-control form-control-sm @error('birth_city') is-invalid @enderror" id="birth_city"
        name="birth_city" value="{{  $profile->birth_city ?? old('birth_city')}}" 
        placeholder="{{ translate('birth_city') }}" 
        required
        />
        @error('birth_city')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>



    <div class="form-group input-group-sm">
        <label for="present_country">
            {{-- বর্তমান দেশ  --}}
              {{ translate('present_country') }}
              <span style="color:red">*</span>
        </label>
        <select class="form-control select2 @error('present_country') is-invalid @enderror" 
        id="present_country"  name="present_country" required> 
            <option >{{ translate('present_country') }}</option>
            @foreach ($countries as  $country)
                <option value="{{ $country->name }}" {{ $profile->present_country == $country->name  ? 'selected' : ''}}>{{ Str::ucfirst($country->name) }}</option>
            @endforeach
    
        </select>
        @error('present_country')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
        <label for="present_city">
            {{-- বর্তমান শহর  --}}
            {{ translate('present_city') }}
              <span style="color:red">*</span>
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm @error('present_city') is-invalid @enderror" 
        id="present_city"
        name="present_city"
        value="{{  $profile->present_city ?? old('present_city')}}" 
        placeholder="{{ translate('present_city') }}" 
        required
        />
        @error('present_city')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="present_address">
            {{-- বর্তমান ঠিকানা  --}}
            {{ translate('present_address') }}
              <span style="color:red">*</span>
        </label>
        <textarea class="form-control form-control-sm @error('present_address') is-invalid @enderror" rows="2" id="present_address"
        name="present_address" placeholder="{{ translate('present_address') }}" required>{{  $profile->present_address ?? old('present_address') }}</textarea>
        @error('present_address')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
       <label for="permanent_address">
        {{-- স্থায়ী ঠিকানা  --}}
           {{ translate('permanent_address') }}
          <span style="color:red">*</span>
       </label>
        <textarea class="form-control form-control-sm @error('permanent_address') is-invalid @enderror" rows="2" id="permanent_address"
        name="permanent_address" placeholder="{{ translate('permanent_address') }}" required>{{ $profile->permanent_address ?? old('permanent_address') }}</textarea>
        @error('permanent_address')
            <span style="color: red">{{ $message }}</span>
        @enderror 
    </div>

    <div class="form-group input-group-sm">
        <label for="citizenship">
            {{-- নাগরিকত্ব (সিটিজেনশীপ) পাওয়া দেশ --}}
            {{ translate('country_of_citizenship') }}
            
        </label>
        <select class="form-control select2" id="citizenship" name="citizenship"
        data-placeholder="Citizenship">
            <option >{{ translate('country_of_citizenship') }}</option>
            @foreach ($countries as  $country)
                <option value="{{ $country->name }}" {{ $profile->citizenship == $country->name  ? 'selected' : ''}}>{{ Str::ucfirst($country->name) }}</option>
            @endforeach
        
        </select>
       
    </div>

    <hr class="w3-border">

    <div class="form-group">
        <label for="profile_pic">
            {{-- প্রোফাইল ছবি (ইমেজ ফাইল):  --}}
             {{ translate('profile_picture') }}
        </label>
        <input type="file" name="profile_pic" class="form-control" placeholder=" {{ translate('profile_picture') }}" {{$profile->profile_pic ? '' : 'required'}} id="profile_pic">
        {{-- @error('profile_pic')
            <span style="color: red">{{ $message }}</span>
        @enderror --}}
    </div>

    @if($profile and $profile->profile_pic)
       <img width="40" class="mb-3" src="{{ asset('storage/photo/'.$profile->profile_pic) }}" alt=""> 
       <small class=" badge badge-secondary">
        {{ translate('previously_uploaded_image') }}
       </small>

    @endif


    <div class="form-group">
        <label for="extra_photo_first">
            {{-- অতিরিক্ত ছবি ১ম (ইমেজ ফাইল): --}}
             {{ translate('extra_photo_first') }}
        </label>
        <input type="file" name="extra_pic_first" class="form-control" placeholder="{{ translate('extra_photo_first') }}" {{$profile->extra_pic_first ? '' : 'required'}} id="extra_photo_first">
        {{-- @error('extra_photo_first')
            <span style="color: red">{{ $message }}</span>
        @enderror --}}
    </div>

    @if($profile and $profile->extra_pic_first)
       <img width="40" class="mb-3" src="{{ asset('storage/photo/'.$profile->extra_pic_first) }}" alt="">
        <small class=" badge badge-secondary">
        {{ translate('previously_uploaded_image') }}
        </small>
    @endif



     <div class="form-group">
        <label for="extra_pic_second">
           {{-- অতিরিক্ত ছবি ২য় (ইমেজ ফাইল): --}}
             {{ translate('extra_photo_second') }}
        </label>
        <input type="file" name="extra_pic_second" class="form-control" placeholder="{{ translate('extra_photo_second') }}" {{$profile->extra_pic_second ? '' : 'required'}} id="extra_pic_second">
        {{-- @error('extra_photo_first')
            <span style="color: red">{{ $message }}</span>
        @enderror --}}
    </div>



     @if($profile and $profile->extra_pic_second)
       <img width="40" class="mb-3" src="{{ asset('storage/photo/'.$profile->extra_pic_second) }}" alt=""> 
       <small class=" badge badge-secondary">
       {{ translate('previously_uploaded_image') }}
       </small>
       
    @endif


    <div class="form-group">
        <label for="extra_photo_third">
            {{-- অতিরিক্ত ছবি ৩য় (ইমেজ ফাইল): --}}
            {{ translate('extra_photo_third') }}
        </label>
        <input type="file" name="extra_pic_third" class="form-control" placeholder="{{ translate('extra_photo_third') }}" {{$profile->extra_pic_third ? '' : 'required'}} id="extra_photo_third">
        {{-- @error('extra_photo_third')
            <span style="color: red">{{ $message }}</span>
        @enderror --}}
    </div>

    @if($profile and $profile->extra_pic_third)
       <img width="40" class="mb-3" src="{{ asset('storage/photo/'.$profile->extra_pic_third) }}" alt=""> 
       <small class=" badge badge-secondary">
        {{-- আগে আপলোড করা ছবি --}}
        {{ translate('previously_uploaded_image') }}
       </small>
      
    @endif


    <hr class="w3-border">


    <div class="form-group input-group-sm">
        <label for="father_name">
            {{-- বাবার নামঃ  --}}
             {{ translate('father_name') }}
              <span style="color:red">*</span>
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm @error('father_name') is-invalid @enderror" 
        id="father_name"
        name="father_name"
        value="{{ $profile->father_name ?? old('father_name')}}" 
        placeholder="{{ translate('father_name') }}"
        required 
        />
        @error('father_name')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>



    <div class="form-group input-group-sm">
        <label for="father_occupation">
            {{-- বাবার পেশাঃ  --}}
             {{ translate('father_occupation') }}
              <span style="color:red">*</span>
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm @error('father_occupation') is-invalid @enderror" 
        id="father_occupation"
        name="father_occupation"
        value="{{ $profile->father_occupation ?? old('father_occupation')}}" 
        placeholder="{{ translate('father_occupation') }}" 
        required
        />
        @error('father_occupation')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
        <label for="mother_name">
            {{-- মায়ের নামঃ  --}}
              {{ translate('mother_name') }}
              <span style="color:red">*</span>
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm @error('mother_name') is-invalid @enderror" 
        id="mother_name"
        name="mother_name"
        value="{{ $profile->mother_name ?? old('mother_name')}}" 
        placeholder="{{ translate('mother_name') }}" 
        required
        />
        @error('mother_name')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="mother_occupation">
            {{-- মায়ের পেশাঃ  --}}
            {{ translate('mother_occupation') }}
              <span style="color:red">*</span>
        </label>
        <input 
        type="text"  
        class="form-control form-control-sm @error('mother_occupation') is-invalid @enderror" 
        id="mother_occupation"
        name="mother_occupation"
        value="{{ $profile->mother_occupation ?? old('mother_occupation')}}" 
        placeholder="{{ translate('mother_occupation') }}" 
        required
        />
        @error('mother_occupation')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="number_of_brother">
            {{-- ভাইয়ের সংখ্যাঃ  --}}
         {{ translate('number_of_brother') }}
           
        </label>
        <input 
        type="number"  min="0" step="1" 
        class="form-control form-control-sm @error('number_of_brother') is-invalid @enderror" 
        id="number_of_brother"
        name="number_of_brother"
        value="{{ $profile->number_of_brother ?? old('number_of_brother')}}" 
        placeholder="{{ translate('number_of_brother') }}" 
        
        />
        @error('number_of_brother')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="how_many_brother_married">
            {{-- বিবাহিত ভাইয়ের সংখ্যাঃ  --}}
            {{ translate('how_many_brother_married') }}
             
        </label>
        <input 
        type="number"  min="0" step="1" 
        class="form-control form-control-sm @error('how_many_brother_married') is-invalid @enderror" 
        id="how_many_brother_married"
        name="how_many_brother_married"
        value="{{ $profile->how_many_brother_married ?? old('how_many_brother_married')}}" 
        placeholder="{{ translate('how_many_brother_married') }}" 
        
        />
        @error('how_many_brother_married')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>




    <div class="form-group input-group-sm">
        <label for="number_of_sister">
            {{-- বোনের সংখ্যাঃ  --}}
           {{ translate('number_of_sister') }}
             
        </label>
        <input 
        type="number"  min="0" step="1" 
        class="form-control form-control-sm @error('number_of_sister') is-invalid @enderror" 
        id="number_of_sister"
        name="number_of_sister"
        value="{{ $profile->number_of_sister ?? old('number_of_sister')}}" 
        placeholder="{{ translate('number_of_sister') }}" 
        
        />
        @error('number_of_sister')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
        <label for="how_many_sister_married">
            {{-- বিবাহিত বোনের সংখ্যাঃ  --}}
            {{ translate('how_many_sister_married') }}
             
        </label>
        <input 
        type="number"  min="0" step="1" 
        class="form-control form-control-sm @error('how_many_sister_married') is-invalid @enderror" 
        id="how_many_sister_married"
        name="how_many_sister_married"
        value="{{ $profile->how_many_sister_married ?? old('how_many_sister_married')}}" 
        placeholder="{{ translate('how_many_sister_married') }}" 
        
        />
        @error('how_many_sister_married')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <hr class="w3-border">

    <div class="form-group input-group-sm {{ $errors->has('about_myself') ? ' has-error' : '' }} ">
        <label for="about_myself">
            {{-- নিজের সম্পর্কে কিছু লিখুনঃ  --}}
            {{ translate('about_myself') }}
              <span style="color:red">*</span>
        </label>
        <textarea class="form-control form-control-sm @error('about_myself') is-invalid @enderror" rows="2" id="about_myself"
         value="{{ old('about_myself')}}"
        name="about_myself" placeholder="{{ translate('about_myself') }}" required>{{ $profile->about_myself ?? old('about_myself') }} </textarea>
        @error('about_myself')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <hr class="w3-border">

    <div class="checkbox">
        <label>
            <input type="checkbox" name="photo_hide"
            {{$profile->photo_hide == 1 ? 'checked' : '' }} /> 
            {{-- প্রোফাইলের ছবি সবাইকে দেখাতে চাই না   --}}
            {{ translate('donot_want_to_show_profile_picture_to_everyone') }}
        </label>
    </div>


    @if($profile && $profile->gender == 'female')
    <div class="checkbox">
    <label>
        <input type="checkbox"  name="will_job_after_marriage" {{ $profile->will_job_after_marriage == 1 ? 'checked' : '' }} /> 
        {{-- বিয়ের পর চাকুরি করতে ইচ্ছুক --}}
          {{ translate('willing_to_work_after_marriage') }}
    </label>
    </div>

    @endif

    <br>

    <div class="">
        <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">{{ translate('update_now') }}</button>
    </div>
</form>

  



