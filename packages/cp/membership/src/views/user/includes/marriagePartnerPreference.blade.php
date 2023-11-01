@if(Auth::user()->partnerPreference)
<form method="post" class="form-user-partner-preference" enctype="multipart/form-data" action="{{ route('user.marriagePartnerPreference')}}">
    @csrf
    <div class="form-group input-group-sm">
        <label for="min_age">{{ translate('minimum_age_of_husband_wife') }}? 
            <span style="color:red">*</span>
        </label>
        <select class="form-control @error('min_age') is-invalid @enderror" id="min_age" name="min_age" required>
            <option value="">{{ translate('minimum_age_of_husband_wife') }}</option>
            @for($i = 16; $i <= 60; $i++)
             <option value="{{$i}}" {{ Auth::user()->partnerPreference->min_age == $i  ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
          
        </select>
        @error('min_age')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group input-group-sm">
        <label for="max_age"> {{ translate('maximum_age_of_husband_wife') }}? 
            <span style="color:red">*</span>
        </label>
        <select class="form-control @error('max_age') is-invalid @enderror" id="max_age" name="max_age" required>
             <option value="">{{ translate('maximum_age_of_husband_wife') }}</option>
          
            @for($i = 16; $i <= 60; $i++)
             <option value="{{$i}}" {{ Auth::user()->partnerPreference->max_age == $i  ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
           
        </select>
        @error('max_age')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="min_height">{{ translate('minimum_height') }}? 
           <span style="color:red">*</span>
        </label>
        <select class="form-control select2 form-control-sm @error('min_height') is-invalid @enderror" name="min_height" data-placeholder="{{ translate('minimum_height') }}"  style="width: 100%;" required>
            <option value="">{{ translate('minimum_height') }}</option>
           
            @foreach (config('m_parameter.height') as  $item)
            <option value="{{ $item }}" {{ Auth::user()->partnerPreference->min_height == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
        @error('min_height')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="max_height">{{ translate('maximum_height') }}? 
            <span style="color:red">*</span>
        </label>
        <select class="form-control select2 form-control-sm @error('max_height') is-invalid @enderror" name="max_height"  data-placeholder="{{ translate('maximum_height') }}"  style="width: 100%;" required>
            <option value="">{{ translate('maximum_height') }}</option>
          
            @foreach (config('m_parameter.height') as  $item)
            <option value="{{ $item }}" {{ Auth::user()->partnerPreference->max_height == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
        @error('max_height')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="min_weight">{{ translate('minimum_weight') }}? 
            <span style="color:red">*</span>
        </label>
        <select class="form-control select2 form-control-sm @error('min_weight') is-invalid @enderror" name="min_weight"  data-placeholder="{{ translate('minimum_weight') }}"  style="width: 100%;" required>
            <option value="">{{ translate('minimum_weight') }}</option>
           
            @foreach (config('m_parameter.weight') as  $item)
            <option value="{{ $item }}" {{ Auth::user()->partnerPreference->min_weight == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
         @error('min_weight')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>


    <div class="form-group input-group-sm">
        <label for="max_weight">{{ translate('maximum_weight') }}? 
            <span style="color:red">*</span>
        </label>
        <select class="form-control select2 form-control-sm @error('max_weight') is-invalid @enderror" name="max_weight"  data-placeholder="{{ translate('maximum_weight') }} "  style="width: 100%;" required>
            <option value="">{{ translate('cast') }} </option>
           
            @foreach (config('m_parameter.weight') as  $item)
            <option value="{{ $item }}" {{ Auth::user()->partnerPreference->max_weight == $item  ? 'selected' :   ''}}>{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
        @error('max_weight')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>




    <div class="form-group input-group-sm">
            <label for="">{{ translate('religion') }}  
                <span style="color:red">*</span>
            </label>
            <select name="u_religion_id"  class="form-control religion-select @error('u_religion_id') is-invalid @enderror" required>
                <option value="">{{ translate('religion') }}  </option>
                @foreach ($religions as $religion)
                <option value="{{ $religion->id }}" {{ Auth::user()->partnerPreference->religion_id == $religion->id  ? 'selected' : ''}}>{{ $religion->name }}</option>
                @endforeach
            </select>
            @error('u_religion_id')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group input-group-sm">
            <label for="a_cast_id">{{ translate('cast') }}  
            </label>
            <select id="u_cast_id" class="cast-select form-control" name="u_cast_id">
                    <option value="">{{ translate('cast') }} </option>
                @if($rid = Auth::user()->partnerPreference->religion_id)
                    @foreach($casts->where('religion_id', $rid) as $cast)
                    <option value="{{ $cast->id }}"
                    {{ Auth::user()->partnerPreference->cast_id == $cast->id ? 'selected' : ' '}}>
                    {{ $cast->name ?? '' }}
                    </option>
                    @endforeach
                @endif
            </select>
            
        </div>
  


  

    @if($profile->gender == 'male')
    <div class="form-group input-group-sm">
        <label for="maritals_status">
            {{-- বৈবাহিক অবস্থাঃ  --}}
            {{ translate('marital_status') }}
            <span style="color:red">*</span>
        </label>
        <select class="form-control  select2 @error('maritals_status') is-invalid @enderror" multiple="multiple" name="maritals_status[]" data-placeholder="{{ translate('marital_status') }}"  style="width: 100%;">
          
            @foreach($parameters->where('field_name','marital_status')->where('gender', '!=' , 'male') as $item)
                
                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->marital_status)) or (old('maritals_status') and (in_array($item->field_value, old('maritals_status')))))  
                    selected
                @endif
                                
                >{{ Str::ucfirst($item->field_value) }}</option>
            @endforeach
          
        </select>
        @error('maritals_status')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>

    @elseif($profile->gender == 'female')
    <div class="form-group input-group-sm">
        <label for="maritals_status">
            {{-- বৈবাহিক অবস্থাঃ  --}}
            {{ translate('marital_status') }}
            <span style="color:red">*</span>
        </label>
        <select class="form-control  select2 @error('maritals_status') is-invalid @enderror" multiple="multiple" name="maritals_status[]" data-placeholder="{{ translate('marital_status') }}"  style="width: 100%;">
            @foreach($parameters->where('field_name','marital_status')->where('active', 1)->where('gender', '!=' , 'female') as $item)
                
                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->marital_status)) or (old('maritals_status') and (in_array($item->field_value, old('maritals_status')))))  
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


    @if(Auth::user()->profile->gender == 'male')
    <div class="form-group input-group-sm">
        <label for="profession">  {{ translate('profession') }} 
            <span style="color:red">*</span>
        </label>
        <select class="form-control  select2 @error('professions') is-invalid @enderror" name="professions[]" multiple="multiple" 
        data-placeholder="পেশা" required style="width: 100%;">

            @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'male') as $item)
                
                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->profession)) or (old('professions') and (in_array($item->field_value, old('professions')))))  
                    selected
                @endif
                                
                >{{ Str::ucfirst($item->field_value) }}</option>
            @endforeach
         
        </select>
        @error('professions')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>
    @elseif(Auth::user()->profile->gender == 'female')
    <div class="form-group input-group-sm">
        <label for="profession">পেশা 
            <span style="color:red">*</span>
        </label>
        <select class="form-control  select2 @error('professions') is-invalid @enderror" name="professions[]" multiple="multiple" 
        data-placeholder="পেশা" required style="width: 100%;">
            @foreach($parameters->where('field_name','profession')->where('gender', '!=' , 'female') as $item)
                
                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->profession)) or (old('professions') and (in_array($item->field_value, old('professions')))))  
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
        <label for="skin_colors">
            {{-- গায়ের রঙ  --}}
              {{ translate('skin_color') }}
            <span style="color:red">*</span>
        </label>
        <select class="form-control  select2 @error('skin_colors') is-invalid @enderror" multiple="multiple" name="skin_colors[]" data-placeholder="  {{ translate('skin_color') }}" required style="width: 100%;">

            @foreach($parameters->where('field_name','skin_color') as $item)
                
                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->skin_color)) or (old('skin_colors') and (in_array($item->field_value, old('skin_colors')))))  
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
        <label for="body_builds">
            {{-- দৈহিক গঠন  --}}
              {{ translate('body_build') }}
            <span style="color:red">*</span>
        </label>
        <select class="form-control  select2 @error('body_builds') is-invalid @enderror" multiple="multiple" name="body_builds[]" data-placeholder="  {{ translate('body_build') }}" required style="width: 100%;">
           
            @foreach($parameters->where('field_name','body_build') as $item)
                
                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->body_build)) or (old('body_builds') and (in_array($item->field_value, old('body_builds')))))  
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
        <label for="education_levels">
            {{-- শিক্ষাগত যোগ্যতা  --}}
            {{ translate('education_level') }}
             <span style="color: red">*</span>
        </label>
        <select class="form-control  select2 @error('education_levels') is-invalid @enderror" name="education_levels[]" data-placeholder="{{ translate('education_level') }}" multiple="multiple" required style="width: 100%;">
         
                    
            @foreach($parameters->where('field_name','education_level') as $item)

                <option value="{{ $item->field_value }}" 

                @if (in_array($item->field_value, explode(", ", Auth::user()->partnerPreference->education_level)) or (old('education_levels') and (in_array($item->field_value, old('education_levels')))))  
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
        <label for="present_countries">
            {{-- বর্তমান দেশ  --}}
            {{ translate('present_country') }}
            <span style="color:red">*</span>
        </label>
        <select class="form-control select2 @error('present_countries') is-invalid @enderror" multiple="multiple" name="present_countries[]" data-placeholder="{{ translate('present_country') }}" required style="width: 100%;">
            
            @foreach ($countries as $country)
                <option value="{{ $country->name }}" 

                @if (in_array($country->name, explode(", ", Auth::user()->partnerPreference->present_country)) or (old('present_countries') and (in_array($country->name, old('present_countries')))))  
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
        <label for="citizenships">
            {{-- সিটিজেনশিপ (নাগরিকত্ব) --}}
             {{ translate('country_of_citizenship') }}
        </label>
        <select class="form-control  select2 form-control-sm" multiple="multiple" name="citizenships[]" data-placeholder=" {{ translate('country_of_citizenship') }}" style="width: 100%;">
     
            @foreach ($countries as $country)
                <option value="{{ $country->name }}" 

                @if (in_array($country->name, explode(", ", Auth::user()->partnerPreference->citizenship)) or (old('citizenships') and (in_array($country->name, old('citizenships')))))  
                    selected
                @endif
                                
                >{{ Str::ucfirst($country->name) }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group input-group-sm">
        <label for="birth_countries">
            {{-- জন্মস্থান (দেশ)  --}}
                {{ translate('birth_country') }}
            <span style="color:red">*</span>
        </label>
        <select class="form-control select2 @error('birth_countries') is-invalid @enderror" multiple="multiple" name="birth_countries[]" data-placeholder=" {{ translate('birth_country') }}" required style="width: 100%;">
            @foreach ($countries as $country)
                <option value="{{ $country->name }}" 

                @if (in_array($country->name, explode(", ", Auth::user()->partnerPreference->present_country)) or (old('birth_countries') and (in_array($country->name, old('birth_countries')))))  
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
        <label for="languages">
            {{-- ভাষা --}}
               {{ translate('language') }}
             <span style="color:red">*</span>
        </label>
       <select class="form-control  select2 @error('languages') is-invalid @enderror" multiple="multiple" name="languages[]" data-placeholder=" {{ translate('language') }}" required style="width: 100%;">

            @foreach (config('m_parameter.language') as  $item)
                <option value="{{ $item }}" 

                @if (in_array($item, explode(", ", Auth::user()->partnerPreference->language)) or (old('languages') and (in_array($item, old('languages')))))  
                    selected
                @endif
                                
                >{{ Str::ucfirst($item) }}</option>
            @endforeach
        </select>
        @error('language')
            <span style="color: red">{{ $message }}</span>
        @enderror
    </div>



    <div class="checkbox">
    <label>
       
     <input  type="checkbox" {{Auth::user()->partnerPreference->will_job_after_marriage == 1 ? 'checked' : '' }}  name="will_job_after_marriage"/> {{ translate('bride_can_work_after_marriage') }}</label>
    </div>
  

    <div class="">
        <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">  {{ translate('update_now') }}</button>
    </div>

   <br>


 
</form>
@endif

@if(!Auth::user()->partnerPreference)
 <div class="row">
    <div class="col-md-3">
        <a href="{{ route('user.newUserEndPartnerPreference')}}" class="btn btn-info btn-block">নতুন পার্টনার প্রেফারেন্স তৈরি করুন</a>
    </div>
</div>
@endif





