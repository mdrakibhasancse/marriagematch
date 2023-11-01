@if($user->userRelativeRecords->count())


<div class="card">
    <div class="card-header">
         <strong><i class="fa fa-book"></i> Relative</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Working Role</th>
                        <th>Relation with User</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tbody>
                  @foreach($user->userRelativeRecords as $relative)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$relative->name}}</td>
                        <td>{{$relative->working_role}}</td>
                         <td>{{$relative->relation_with_user}}</td>
                        <td>
                            {{-- <a href=""><i class="fa fa-edit text-red"></i></a> 
                            
                            --}}
                            <button type="button" class="btn btn-warning editRelative" data-toggle="modal" data-target="#modal-default" value="{{$relative->id}}" data-url="{{ route('admin.relativeInfoEdit')}}">
                               <i class="fa fa-edit text-white"></i>
                            </button>

                            <a class="btn btn-danger" href="{{ route('admin.relativeInfoDelete',$relative->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
               </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="editRelativeModal">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Relative Info</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ route('admin.relativeInfoUpdate')}}">
            <div class="modal-body">
                @csrf
                <div class="row">

                    <input type="hidden" id="relative_id" name="relative_id">
                   <div class="form-group col-12">
                        <label for="r_name">আত্নীয়ের নামঃ 
                            <span style="color: red">*</span>
                        </label>
                        <input  
                        type="text" 
                        id="r_name" 
                        value="{{ old('r_name')}}"
                        class="form-control form-group-sm @error('r_name') is-invalid @enderror" 
                        name="r_name"        
                        placeholder="আত্নীয়ের নাম" 
                        required
                        />
                        @error('r_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="r_relation_with_user">আত্নীয় আপনার (প্রোফাইলের) কি হন? (সম্পর্ক) 
                            <span style="color: red">*</span>
                        </label>
                        <input  
                        type="text" 
                        id="r_relation_with_user" 
                        class="form-control form-group-sm @error('r_relation_with_user') is-invalid @enderror" 
                        name="r_relation_with_user"  
                        value="{{ old('r_relation_with_user')}}"      
                        placeholder="আত্নীয় আপনার (প্রোফাইলের) কি হন?" 
                        required
                        />
                        @error('r_relation_with_user')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    

                    <div class="form-group col-12">
                        <label for="r_working_role">পেশা/পদবীঃ 
                            <span style="color: red">*</span>
                        </label>
                        <input  
                        type="text" 
                        id="r_working_role" 
                        class="form-control form-control-sm @error('r_working_role') is-invalid @enderror"
                        value="{{ old('r_working_role')}}"  
                        name="r_working_role"       
                        placeholder="তিনি কি করেন বা তার পদবী কী?"  
                        required
                        />
                        @error('r_working_role')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    


                    <div class="form-group col-12">
                        <label for="r_org_name">প্রতিষ্ঠানের নামঃ 
                           
                        </label>
                        <input  
                        type="text" 
                        id="r_org_name" 
                        class="form-control form-control-sm @error('r_org_name') is-invalid @enderror" 
                        name="r_org_name" 
                        value="{{ old('r_org_name')}}"       
                        placeholder="তিনি কোনো প্রতিষ্ঠানে কাজ করে থাকলে তার নাম"  
                        
                        />
                        
                        @error('org_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                

                    <div class="form-group col-12">
                        <label for="r_details">বিস্তারিত বিবরণঃ 
                            <span style="color: red">*</span>
                        </label>
                        <textarea class="form-control form-control-sm @error('details') is-invalid @enderror" id="r_details" name="r_details" placeholder="এই আত্মীয় সম্পর্কে বিস্তারিত লিখুন" required>{{ old('r_details') }}</textarea> 
                        @error('r_details')
                            <span style="color: red">{{ $message }}</span>
                        @enderror 
                    </div>

                </div>  
            
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
        <!-- /.modal-dialog -->
</div>

@endif


@if($user->userRelativeRecords->count())
<hr class="w3-border-gray">
@endif