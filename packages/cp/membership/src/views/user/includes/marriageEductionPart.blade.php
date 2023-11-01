
<form method="post" action="{{ route('user.newProfileEducationStore')}}">
    @csrf

    <div class="row">

        <div class="form-group col-12">
            <label for="organization_name ">
                {{-- প্রতিষ্ঠানের নামঃ  --}}
                {{ translate('name_of_the_institution') }}
                <span style="color:red">*</span>
            </label>
            <input  
            type="text" 
            id="organization_name " 
            class="form-control form-group-sm @error('organization_name') is-invalid @enderror" 
            value="{{ old('organization_name')}}"
            name="organization_name"        
            placeholder="{{ translate('name_of_the_institution') }}" 
            required
            />
            @error('organization_name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <div class="form-group col-12">
            <label for="organization_address"> {{ translate('institution_address') }}
            </label>
            <input  
            type="text" 
            id="organization_address" 
            class="form-control form-control-sm @error('organization_address') is-invalid @enderror" 
            name="organization_address" 
            value="{{ old('organization_address')}}"      
            placeholder="{{ translate('institution_address') }}"  
            
            />
            @error('organization_address')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <div class="form-group col-12">
            <label for="passed_degree">{{ translate('passed_degree') }} 
                <span style="color:red">*</span>
            </label>
            <input  
            type="text" 
            id="passed_degree" 
            value="{{ old('passed_degree')}}"   
            class="form-control form-control-sm @error('passed_degree') is-invalid @enderror" 
            name="passed_degree"
            placeholder="{{ translate('passed_degree') }}" 
            required
            />
            @error('passed_degree')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

          <div class="form-group col-12">
            <label for="passed_grade">
                {{-- পাশের গ্রেড  --}}
                {{ translate('passed_grade') }}
                <span style="color:red">*</span>
            </label>
            <input  
            type="text" 
            id="passed_grade" 
            class="form-control form-control-sm @error('passed_grade') is-invalid @enderror" 
            name="passed_grade"
            value="{{ old('passed_grade')}}"  
            placeholder="{{ translate('passed_grade') }}" 
            required
            />
            @error('passed_grade')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <div class="form-group col-12">
            <label for="passed_department">
                {{-- ডিপারটমেন্ট/বিভাগঃ  --}}
                {{ translate('department') }}
             
            </label>
            <input  
            type="text" 
            id="passed_department" 
            class="form-control form-control-sm @error('passed_department') is-invalid @enderror" 
            name="passed_department"
            value="{{ old('passed_department')}}" 
            placeholder="{{ translate('department') }}" 
            
            />
            @error('passed_department')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <div class="form-group col-12">
            <label for="year_from">
                {{-- সেশন শুরুর সালঃ  --}}
                  {{ translate('year_of_starting_session') }}
                <span style="color:red">*</span>
            </label>
            <select class="select2- form-control form-control-sm  @error('year_from') is-invalid @enderror" name="year_from" required style="width:100%;">
                
                
            <option value="">{{ translate('year_of_starting_session') }}</option>
                    

            @for ($i = date('Y'); $i >= date('Y') - 60; $i--)
            <option value="{{ $i}}">{{ $i }}</option>
            @endfor
                
            </select>
            @error('year_from')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="year_to">
                সেশন শেষের সালঃ 
                {{ translate('year_of_ending_session') }}
                <span style="color:red">*</span>
            </label>
            <select class="select2-  form-control form-control-sm @error('year_to') is-invalid @enderror" name="year_to" required style="width:100%;">
                <option value="">{{ translate('year_of_ending_session') }}</option>
                    

                    @for ($i = date('Y'); $i >= date('Y') - 60; $i--)
                    <option value="{{ $i}}">{{ $i }}</option>
                    @endfor
                
            </select>
            @error('year_to')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="passed_year">  {{ translate('adjacent_year') }}
                <span style="color:red">*</span>
            </label>
            <select class="select2-  form-control form-control-sm @error('passed_year') is-invalid @enderror" name="passed_year" required style="width:100%;">
                <option value="">{{ translate('adjacent_year') }}</option>
                    
                @for ($i = date('Y'); $i >= date('Y') - 60; $i--)
                <option value="{{ $i}}">{{ $i }}</option>
                @endfor
                
            </select>
            @error('passed_year')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>



        <br>

        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">{{ translate('submit_now') }}</button>
        </div>  

    </div>   
</form>