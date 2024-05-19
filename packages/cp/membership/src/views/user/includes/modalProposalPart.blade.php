<div class="modal-header">
   <h4 class="modal-title">Proposal</h4>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<form action="{{route('membership.proposalSend', $user)}}" method="post">
   @csrf
<div class="modal-body">
      <div class="row justify-content-center align-items-center">
         <div class="col-md-4">
            <img src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => Auth::user()->fi()]) }}" alt="user_profile"><br>
            {{Auth::user()->name}}
         </div>
         <div class="col-md-2">
            <span style="font-size: 20px;">To</span>
         </div>
         <div class="col-md-4">
               <img src="{{ route('imagecache', ['template' => 'ppmd', 'filename' => $user->fi()]) }}" alt="user_profile"><br>
               <span class="text-center">{{$user->name}}</span>
         </div>
      </div>
    
      <div class="text-center">
       <input class="form-control" name="message" value="I like your profile, let me know your interest" type="text"  readonly>
      </div>
</div>
<div class="modal-footer">
 
   @if ($user->isConnectedWithMe())

   <button type="button" class="btn btn-primary">Connected</button> 

   @elseif($a = $user->hasPendingProposalToMe())

      <a onclick="return confirm('Are you sure to accept proposal?')" href="{{ route('membership.proposalAccept', $a)}}" class="btn btn-primary">Accept Proposal</a>

      <a onclick="return confirm('Are you sure to croposal cancel?')" href="{{ route('membership.proposalDelete', $a)}}" class="btn btn-danger">Cancel Proposal</a> 

   @elseif($a = $user->hasPendingProposalFromMe())
      <a onclick="return confirm('Are you sure to croposal cancel?')" href="{{ route('membership.proposalDelete', $a)}}" class="btn btn-danger">Cancel Proposal</a> 

   @else

   <button type="submit" class="btn btn-primary">Send Proposal</button> 


   @endif

  
</div>

</form>