@if(Auth::user()->userEducationRecords->count())

<div class="card">
    <div class="card-header">
         <strong><i class="fa fa-book"></i> Education</strong>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
               <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Passed Degree</th>
                        <th>Passed Year</th>
                        <th>Department</th>
                        <th>Session</th>
                        <th>Grade</th>
                        <th>Action</th>
                    </tr>
               </thead>
               <tbody>
                  @foreach(Auth::user()->userEducationRecords as $edu)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$edu->passed_degree}}</td>
                        <td>
                        {{ \Carbon\Carbon::parse($edu->passed_year)->format('Y')}}
                        </td>

                        <td>{{$edu->passed_department}}</td>

                        <td>
                            {{ \Carbon\Carbon::parse($edu->year_from)->format('Y')}}-
                            {{ \Carbon\Carbon::parse($edu->year_to)->format('Y')}} 
                        </td>
                        <td>{{$edu->passed_grade}}</td>
                        <td>
                            {{-- <a href=""><i class="fa fa-edit text-red"></i></a> 
                            
                            --}}
                            <button type="button" class="btn btn-warning editEduUserEnd" data-toggle="modal" data-target="#modal-default" value="{{$edu->id}}" data-url="{{ route('user.newProfileEducationEdit')}}">
                               <i class="fa fa-edit text-white"></i>
                            </button>

                            <a class="btn btn-danger" href="{{ route('user.newProfileEducationDelete',$edu->id)}}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
               </tbody>
            </table>
        </div>
    </div>
</div>



<div class="modal fade" id="editEduModalUserEnd">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Education Info</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="post" action="{{ route('user.newProfileEducationUpdate')}}">
            <div class="modal-body">
                @csrf
                <div class="row">

                    <input type="hidden" id="edu_id" name="edu_id">
                    <div class="form-group col-12">
                        <label for="organization_name ">প্রতিষ্ঠানের নামঃ 
                            <span style="color:red">*</span>
                        </label>
                        <input  
                        type="text" 
                        id="organization_name" 
                        class="form-control form-group-sm @error('name') is-invalid @enderror" 
                        value="{{ old('name')}}"
                        name="name"        
                        placeholder="প্রতিষ্ঠানের নাম"
                        required 
                        />
                        @error('name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group col-12">
                        <label for="organization_address">প্রতিষ্ঠানের ঠিকানাঃ
                            
                        </label>
                        <input  
                        type="text" 
                        id="organization_address" 
                        class="form-control form-control-sm @error('address') is-invalid @enderror" 
                        name="address" 
                        value="{{ old('address')}}"      
                        placeholder="প্রতিষ্ঠানের ঠিকানা"  
                        
                        />
                        @error('organization_address')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group col-12">
                        <label for="passed_degree">পাশের ডিগ্রীঃ 
                            <span style="color:red">*</span>
                        </label>
                        <input  
                        type="text" 
                        id="passed_degree" 
                        value="{{ old('degree')}}"   
                        class="form-control form-control-sm @error('degree') is-invalid @enderror" 
                        name="degree"
                        
                        placeholder="পাশের পর অর্জিত ডিগ্রী e.g: PhD" 
                        required
                        />
                        @error('degree')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="grade">পাশের গ্রেড 
                            <span style="color:red">*</span>
                        </label>
                        <input  
                        type="text" 
                        id="passed_grade" 
                        class="form-control form-control-sm @error('passed_grade') is-invalid @enderror" 
                        name="grade"
                        value="{{ old('grade')}}"  
                        placeholder="পাশের গ্রেড" 
                        required
                        />
                        @error('grade')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group col-12">
                        <label for="
                        department">ডিপারটমেন্ট/বিভাগঃ 
                            
                        </label>
                        <input  
                        type="text" 
                        id="passed_department" 
                        class="form-control form-control-sm @error('
                        department') is-invalid @enderror" 
                        name="department"
                        value="{{ old('
                        department')}}" 
                        placeholder="ডিপার্টমেন্ট/বিভাগ ex: Science" 
                        
                        />
                        @error('department')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>



                    <div class="form-group col-12">
                        <label for="year_from">সেশন শুরুর সালঃ 
                            <span style="color:red">*</span>
                        </label>
                        <select class="select2- form-control form-control-sm @error('from') is-invalid @enderror" name="from" id="year_from" required style="width:100%;">
                            
                            
                        <option value="">যে সাল থেকে সেশন শুরু করা হয়েছে, সেই সাল</option>
                                

                        @for ($i = date('Y'); $i >= date('Y') - 60; $i--)
                        <option value="{{ $i}}">{{ $i }}</option>
                        @endfor
                            
                        </select>
                        @error('from')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="year_to">সেশন শেষের সালঃ 
                            <span style="color:red">*</span>
                        </label>
                        <select class="select2-  form-control form-control-sm @error('to') is-invalid @enderror" name="to" id="year_to" required style="width:100%;">
                            <option value="">যেই বছর সেশন শেষ হয়েছে, সেই সাল</option>
                                

                                @for ($i = date('Y'); $i >= date('Y') - 60; $i--)
                                <option value="{{ $i}}">{{ $i }}</option>
                                @endfor
                            
                        </select>
                        @error('to')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group col-12">
                        <label for="year">পাশের সালঃ 
                            <span style="color:red">*</span>
                        </label>
                        <select class="select2-  form-control form-control-sm @error('year') is-invalid @enderror" name="year" id="passed_year" required style="width:100%;">
                            <option value="">যেই বছর পাশ করা হয়েছে, সেই সাল</option>
                                
                            @for ($i = date('Y'); $i >= date('Y') - 60; $i--)
                            <option value="{{ $i}}">{{ $i }}</option>
                            @endfor
                            
                        </select>
                        @error('year')
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
    <!-- /.modal -->
    

@endif


@if(Auth::user()->userEducationRecords->count())
<hr class="w3-border-gray">
@endif