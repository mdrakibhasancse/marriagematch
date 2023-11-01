@extends('admin::layouts.adminMaster')
@section('title')
    | Message Conversion
@endsection

@push('css')
@endpush

@section('content') 

<br>

<!-- Main content -->
<section class="content">

    <div class="card">
        <div class="card-header">
            <h4>Conversations Details Of Users ({{$user1->name}} and {{$user2->name}})</h4>
        </div>
        <div class="card-body">
            <div class="row">
               <div class="co-md-6">
                  <div class="direct-chat-messages">
               
                    @foreach($messages as $message)

                    @if($message->userfrom_id == $user1->id)
                    <div class="direct-chat-msg">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">{{$message->userFrom->name}}</span>
                        <span class="direct-chat-timestamp float-left">{{$message->created_at}}</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $message->userFrom->fi()]) }}" alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text"> 
                            {{$message->message}}

                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    @else
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-right">{{$message->userFrom->name}}</span>
                        <span class="direct-chat-timestamp float-left">{{$message->created_at}}</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $message->userFrom->fi()]) }}" alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                        {{$message->message}}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    @endif

                  
                    @endforeach
                    
                        
                   </div>
               </div>
            </div>
        </div>
    </div>
  
    
    
    
</section>
<!-- /.content -->

@endsection






