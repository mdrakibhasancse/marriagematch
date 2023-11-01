
<form method="post" action="{{route('admin.relativeInfoStore',$user->id)}}">
 @csrf
    <div class="row">
        <div class="form-group col-12">
            <label for="name">আত্নীয়ের নামঃ 
                <span style="color: red">*</span>
            </label>
            <input  
            type="text" 
            id="name" 
            value="{{ old('name')}}"
            class="form-control form-group-sm @error('name') is-invalid @enderror" 
            name="name"        
            placeholder="আত্নীয়ের নাম" 
            required
            />
            @error('name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group col-12">
            <label for="relation_with_user">আত্নীয় আপনার (প্রোফাইলের) কি হন? (সম্পর্ক) 
                <span style="color: red">*</span>
            </label>
            <input  
            type="text" 
            id="relation_with_user" 
            class="form-control form-group-sm @error('relation_with_user') is-invalid @enderror" 
            name="relation_with_user"  
            value="{{ old('relation_with_user')}}"      
            placeholder="আত্নীয় আপনার (প্রোফাইলের) কি হন?" 
            required
            />
            @error('relation_with_user')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        

        <div class="form-group col-12">
            <label for="working_role">পেশা/পদবীঃ 
                <span style="color: red">*</span>
            </label>
            <input  
            type="text" 
            id="working_role" 
            class="form-control form-control-sm @error('working_role') is-invalid @enderror"
            value="{{ old('working_role')}}"  
            name="working_role"       
            placeholder="তিনি কি করেন বা তার পদবী কী?"  
            required
            />
            @error('working_role')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        


        <div class="form-group col-12">
            <label for="org_name">প্রতিষ্ঠানের নামঃ 
               
            </label>
            <input  
            type="text" 
            id="org_name" 
            class="form-control form-control-sm @error('org_name') is-invalid @enderror" 
            name="org_name" 
            value="{{ old('org_name')}}"       
            placeholder="তিনি কোনো প্রতিষ্ঠানে কাজ করে থাকলে তার নাম"  
            
            />
            
            @error('org_name')
                <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
    

        <div class="form-group col-12">
            <label for="details">বিস্তারিত বিবরণঃ 
                <span style="color: red">*</span>
            </label>
            <textarea class="form-control form-control-sm @error('details') is-invalid @enderror" id="details" name="details" placeholder="এই আত্মীয় সম্পর্কে বিস্তারিত লিখুন" required>{{ old('details') }}</textarea> 
            @error('details')
                <span style="color: red">{{ $message }}</span>
            @enderror 
        </div>
            
            

        <br>

        <div class="form-group col-12">
            <button type="submit" class="btn btn-primary btn-sm next-btn-with-loading">সাবমিট করুন</button>
        </div>


            

    </div>

</form>