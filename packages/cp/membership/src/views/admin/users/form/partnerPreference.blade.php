<div class="card card-primary card-default">
 <div class="card-body">

    <form method="post" enctype="multipart/form-data" action="{{ route('admin.partnerPreferenceInfoStore',$user->id)}}">
    @csrf
        <div class="form-group input-group-sm">
            <label for="min_age"> পাত্র/পাত্রীর সর্বনিম্ন বয়স? 
                <span style="color:red">*</span>
            </label>
            <select class="form-control @error('min_age') is-invalid @enderror" id="min_age" name="min_age" required>
                <option value="">পাত্র/পাত্রীর সর্বনিম্ন বয়স</option>
            
                @for ($i = 16; $i <= 60; $i++)
                    <option value="{{$i}}" {{ $user->partnerPreference->min_age == $i  ? 'selected' : '' }}>{{ $i }}</option>
                @endfor

              
                
                
            </select>
            @error('min_age')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group input-group-sm">
            <label for="max_age"> পাত্র/পাত্রীর সর্বোচ্চ বয়স? 
                <span style="color:red">*</span>
            </label>
            <select class="form-control @error('max_age') is-invalid @enderror" id="max_age" name="max_age" required>
                <option value="">পাত্র/পাত্রীর সর্বোচ্চ বয়স</option>
            
                @for ($i = 16; $i <= 60; $i++)
                    <option value="{{$i}}" {{ $user->partnerPreference->max_age == $i  ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
              
            </select>
            @error('max_age')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group input-group-sm">
            <label for="min_height">সর্বনিম্ন উচ্চতা? 
            <span style="color:red">*</span>
            </label>
            <select class="form-control select2 form-control-sm @error('min_height') is-invalid @enderror" name="min_height" data-placeholder="পাত্র/পাত্রীর সর্বনিম্ন উচ্চতা"  style="width: 100%;" required>
                <option value="">সর্বনিম্ন উচ্চতা</option>
            
                @foreach (config('m_parameter.height') as  $item)
                <option value="{{ $item }}" {{ $user->partnerPreference->min_height == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
                @endforeach
            </select>
            @error('min_height')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group input-group-sm">
            <label for="max_height">সর্বোচ্চ উচ্চতা? 
                <span style="color:red">*</span>
            </label>
            <select class="form-control select2 form-control-sm @error('max_height') is-invalid @enderror" name="max_height"   data-placeholder="পাত্র/পাত্রীর সর্বোচ্চ উচ্চতা"  style="width: 100%;" required>
                <option value="">সর্বোচ্চ উচ্চতা</option>
            
                @foreach (config('m_parameter.height') as  $item)
                <option value="{{ $item }}" {{ $user->partnerPreference->max_height == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
                @endforeach
            </select>
            @error('max_height')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group input-group-sm">
            <label for="min_weight">সর্বনিম্ন ওজনঃ? 
                <span style="color:red">*</span>
            </label>
            <select class="form-control select2 form-control-sm @error('min_weight') is-invalid @enderror" name="min_weight" data-placeholder="পাত্র/পাত্রীর সর্বোচ্চ ওজন"  style="width: 100%;" required>
                <option value="">পাত্র/পাত্রীর সর্বনিম্ন ওজন</option>
            
                @foreach (config('m_parameter.weight') as  $item)
                <option value="{{ $item }}" {{ $user->partnerPreference->min_weight == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
                @endforeach
            </select>
            @error('min_weight')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group input-group-sm">
            <label for="max_weight">সর্বোচ্চ ওজন? 
                <span style="color:red">*</span>
            </label>
            <select class="form-control select2 form-control-sm @error('max_weight') is-invalid @enderror" name="max_weight" data-placeholder="পাত্র/পাত্রীর সর্বোচ্চ ওজন"  style="width: 100%;" required>
                <option value="">পাত্র/পাত্রীর সর্বোচ্চ ওজন</option>
            
                @foreach (config('m_parameter.weight') as  $item)
                <option value="{{ $item }}" {{ $user->partnerPreference->max_weight == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
                @endforeach
            </select>
            @error('max_weight')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <div class="form-group input-group-sm">
            <label for="">ধর্মঃ 
                <span style="color:red">*</span>
            </label>
            <select name="a_religion_id"  class="form-control religion-select @error('a_religion_id') is-invalid @enderror" required>
                <option value="">Select Religion</option>
                @foreach ($religions as $religion)
                <option value="{{ $religion->id }}" {{ $user->partnerPreference->religion_id == $religion->id  ? 'selected' : ''}}>{{ $religion->name }}</option>
                @endforeach
            </select>
            @error('a_religion_id')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group input-group-sm">
            <label for="a_cast_id">বর্ণঃ 
            </label>
            <select id="a_cast_id" class="cast-select form-control" name="a_cast_id">
                    <option value="">Select Cast</option>
                @if($rid = $user->partnerPreference->religion_id)
                    @foreach($casts->where('religion_id', $rid) as $cast)
                    <option value="{{ $cast->id }}"
                    {{ $user->partnerPreference->cast_id == $cast->id ? 'selected' : ' '}}>
                    {{ $cast->name ?? '' }}
                    </option>
                    @endforeach
                @endif
            </select>
            
        </div>




        @if($user->profile->gender == 'male')
        <div class="form-group input-group-sm">
            <label for="maritals_status">বৈবাহিক অবস্থাঃ 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('maritals_status') is-invalid @enderror" multiple="multiple" name="maritals_status[]" data-placeholder="বৈবাহিক অবস্থাঃ"  style="width: 100%;">
            
    
                @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'male') as $item)
                  
                  <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->marital_status)) or (old('maritals_status') and (in_array($item->field_value, old('maritals_status')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach
          

            </select>
            @error('maritals_status')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        @elseif($user->profile->gender == 'female')
        <div class="form-group input-group-sm">
            <label for="maritals_status">বৈবাহিক অবস্থাঃ 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('maritals_status') is-invalid @enderror" multiple="multiple" name="maritals_status[]" data-placeholder="বৈবাহিক অবস্থাঃ"  style="width: 100%;">
            
                @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'female') as $item)
                  
                  <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->marital_status)) or (old('maritals_status') and (in_array($item->field_value, old('maritals_status')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach
         

            </select>
            @error('maritals_status')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        @endif


        
        @if($user->profile->gender == 'male')
        <div class="form-group input-group-sm">
            <label for="professions">পেশা 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('professions') is-invalid @enderror" name="professions[]" multiple="multiple" 
            data-placeholder="পেশা" required style="width: 100%;">

                @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'male') as $item)
                  
                  <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->profession)) or (old('professions') and (in_array($item->field_value, old('professions')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach
            

            </select>
            @error('professions')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        @elseif($user->profile->gender == 'female')
          <div class="form-group input-group-sm">
            <label for="professions">পেশা 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('professions') is-invalid @enderror" name="professions[]" multiple="multiple" 
            data-placeholder="পেশা" required style="width: 100%;">

            
                @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'female') as $item)
                  
                  <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->profession)) or (old('professions') and (in_array($item->field_value, old('professions')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach
         

            </select>
            @error('professions')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        @endif


    



        <div class="form-group input-group-sm">
            <label for="skin_colors">গায়ের রঙ 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('skin_colors') is-invalid @enderror" multiple="multiple" required name="skin_colors[]"  data-placeholder="গায়ের রঙ"  style="width: 100%;">

              
                @foreach($parameters->where('field_name','skin_color') as $item)
                    
                    <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->skin_color)) or (old('skin_colors') and (in_array($item->field_value, old('skin_colors')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach
              


            </select>
            @error('skin_colors')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group input-group-sm">
            <label for="body_builds">দৈহিক গঠন 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('body_builds') is-invalid @enderror" multiple="multiple" name="body_builds[]" data-placeholder="দৈহিক গঠন" required style="width: 100%;">
            
              
                @foreach($parameters->where('field_name','body_build') as $item)
                    <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->body_build)) or (old('body_builds') and (in_array($item->field_value, old('body_builds')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>
                @endforeach
              



            </select>
            @error('body_builds')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        


        <div class="form-group input-group-sm">
            <label for="education_levels">শিক্ষাগত যোগ্যতা 
                <span style="color: red">*</span>
            </label>
            <select class="form-control  select2 @error('education_levels') is-invalid @enderror" name="education_levels[]" data-placeholder="শিক্ষাগত যোগ্যতা" multiple="multiple" required style="width: 100%;">  
                @foreach($parameters->where('field_name','education_level') as $item)

                    <option value="{{ $item->field_value }}" 

                    @if (in_array($item->field_value, explode(", ", $user->partnerPreference->education_level)) or (old('education_levels') and (in_array($item->field_value, old('education_levels')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item->field_value) }}</option>

                @endforeach

            </select>
            @error('education_levels')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group input-group-sm">
            <label for="present_countries">বর্তমান দেশ 
                <span style="color:red">*</span>
            </label>
            <select class="form-control  select2 @error('present_countries') is-invalid @enderror" multiple="multiple" name="present_countries[]" data-placeholder="বর্তমানে যেই দেশে বসবাস করছেন, সেই দেশ" required style="width: 100%;">

                
                @foreach ($countries as $country)
                    <option value="{{ $country->name }}" 
                    @if (in_array($country->name, explode(", ", $user->partnerPreference->present_country)) or (old('present_countries') and (in_array($country->name, old('present_countries')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($country->name) }}</option>
                @endforeach
            </select>
            @error('present_countries')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>


        <div class="form-group input-group-sm">
            <label for="citizenships">সিটিজেনশিপ (নাগরিকত্ব)
            </label>
            <select class="form-control  select2 form-control-sm" multiple="multiple" name="citizenships[]" data-placeholder="সিটিজেনশিপ (নাগরিকত্ব)"   style="width: 100%;">
        
                @foreach ($countries as $country)
                    <option value="{{ $country->name }}" 

                    @if (in_array($country->name, explode(", ", $user->partnerPreference->citizenship)) or (old('citizenships') and (in_array($country->name, old('citizenships')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($country->name) }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group input-group-sm">
            <label for="birth_countries">জন্মস্থান (দেশ) 
                <span style="color:red">*</span>
            </label>
            <select class="form-control select2 @error('birth_countries') is-invalid @enderror" multiple="multiple" name="birth_countries[]" data-placeholder="জন্মস্থান (দেশ)" required style="width: 100%;">

                @foreach ($countries as $country)
                    <option value="{{ $country->name }}" 

                    @if (in_array($country->name, explode(", ", $user->partnerPreference->birth_country)) or (old('birth_countries') and (in_array($country->name, old('birth_countries')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($country->name) }}</option>
                @endforeach
            </select>
            @error('birth_countries')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group input-group-sm">
            <label for="languages">ভাষা
                <span style="color:red">*</span>
            </label>
        <select class="form-control  select2 @error('languages') is-invalid @enderror" multiple="multiple" name="languages[]" data-placeholder="ভাষা"
        required style="width: 100%;">
    
                @foreach (config('m_parameter.language') as  $item)
                    <option value="{{ $item }}" 

                    @if (in_array($item, explode(", ", $user->partnerPreference->language)) or (old('languages') and (in_array($item, old('languages')))))  
                        selected
                    @endif
                                    
                    >{{ Str::ucfirst($item) }}</option>
                @endforeach

            </select>
            @error('languages')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <div class="checkbox">
        <label>
        
        <input  type="checkbox" {{$user->partnerPreference->will_job_after_marriage == 1 ? 'checked' : '' }}  name="will_job_after_marriage"/>  পাত্রী বিয়ের পর চাকুরি করতে পারবে</label>
        </div>
    

        <div class="">
            <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">আপডেট করুন</button>
        </div>

    <br>

    
    </form>

 </div>
</div>



