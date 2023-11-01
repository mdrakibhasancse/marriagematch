<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="width: 10px">#SL</th>
      <th style="width: 80px">Action</th>
      <th>Date</th>
      <th>Contact</th>
      <th>Profession</th>
      <th width="10" class="px-0">Image</th>
      <th>Profile</th>
      <th>Final Submit</th>

    </tr>
  </thead>
  <tbody>
    <?php $i = (($users->currentPage() - 1) * $users->perPage() + 1); ?>
    @foreach($users as $user)
    <tr>
      <td style="width: 10px">{{$i++}}</td>
      <td style="width: 80px">
          <div class="dropdown show">
            <a class="btn btn-primary btn-xs dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Action
            </a>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a href="{{ route("admin.userEdit",$user->id)}}" class="dropdown-item"><i class="fa fa-edit"></i> Edit</a>
            </div>
      </td>
      <td>{{date('d-m-Y', strtotime($user->created_at))}}</td>
      <td>
        <p class="m-0 p-0"> {{$user->name}}</p>
        <p class="m-0 p-0">{{$user->email}}</p>
        <p class="m-0 p-0"> {{$user->mobile}}</p>
      
      </td>
      <td>
        <p class="m-0 p-0"> {{$user->myProfession()}}</p>
        <p class="m-0 p-0">{{$user->myGender()}}</p>
        <p class="m-0 p-0"> {{$user->age()}}</p>
      </td>
      
      <td width="10" class="px-1 py-0"><img  src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $user->fi()]) }}" alt="user"></td>
      {{-- membership part start --}}
      
      <td>{!!$user->profile && $user->profile->religion_id ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-danger">No</span>'!!}</td>

      <td>
          @if($user->profile)
            {!!$user->profile->submit_by_user == 1 ? '<span class="badge badge-primary">Yes</span>' : '<span class="badge badge-danger">No</span>'!!}
          @endif
      </td>
      {{-- membership part end --}}
      
    </tr>  
    @endforeach
  </tbody>
</table>

<div class="{{request()->ajax() ? 'myLink' : ''}}">
  {{ $users->links() }}
</div>