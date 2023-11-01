
<form method="post" class="form-user-profile-relative" action="{{route('user.newProfileRelativeStore')}}">
    {{csrf_field()}}

  <div class="row">
        <div class="form-group col-12">
            <label for="name">
                {{-- আত্নীয়ের নামঃ  --}}
          {{ translate('relative_name') }}
                <span style="color: red">*</span>
            </label>
            <input  
            type="text" 
            id="name" 
            value="{{ old('name')}}"
            class="form-control form-group-sm @error('name') is-invalid @enderror" 
            name="name"        
            placeholder="{{ translate('relative_name') }}" 
            required
            />
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="relation_with_user">
                {{-- আত্নীয় আপনার (প্রোফাইলের) কি হন? (সম্পর্ক)  --}}
                 {{ translate('what_is_your_relationship_with_relatives') }}
                <span style="color: red">*</span>
            </label>
            <input  
            type="text" 
            id="relation_with_user" 
            class="form-control form-group-sm @error('relation_with_user') is-invalid @enderror" 
            name="relation_with_user"  
            value="{{ old('relation_with_user')}}"      
            placeholder="{{ translate('what_is_your_relationship_with_relatives') }}" 
            required
            />
            @error('relation_with_user')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        

        <div class="form-group col-12">
            <label for="working_role">
                {{-- পেশা/পদবীঃ  --}}
                 {{ translate('profession_designation') }}
                <span style="color: red">*</span>
            </label>
            <input  
            type="text" 
            id="working_role" 
            class="form-control form-control-sm @error('working_role') is-invalid @enderror"
            value="{{ old('working_role')}}"  
            name="working_role"       
            placeholder="{{ translate('profession_designation') }}"  
            required
            />
            @error('working_role')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        


        <div class="form-group col-12">
            <label for="org_name">
                {{-- প্রতিষ্ঠানের নামঃ  --}}
                {{ translate('name_of_the_institution') }}
                
            </label>
            <input  
            type="text" 
            id="org_name" 
            class="form-control form-control-sm @error('org_name') is-invalid @enderror" 
            name="org_name" 
            value="{{ old('org_name')}}"       
            placeholder="{{ translate('name_of_the_institution') }}"  
            
            />
            
            @error('org_name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
    

        <div class="form-group col-12">
            <label for="details">
                {{-- বিস্তারিত বিবরণঃ --}}
                {{ translate('details') }} 
                <span style="color: red">*</span>
            </label>
            <textarea class="form-control form-control-sm @error('details') is-invalid @enderror" id="details" name="details" placeholder="{{ translate('details') }} " required>{{ old('details') }}</textarea> 
            @error('details')
                <span style="color: red">{{ $message }}</span>
            @enderror 
        </div>
            
            

        <br>

        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">{{ translate('submit_now') }}</button>
        </div>


            

    </div>
    
</form>