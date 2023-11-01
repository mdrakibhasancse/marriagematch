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

    <div class="card card-widget">
              <div class="card-header">
                <div class="user-block">
                  <img class="img-circle" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $user->fi()]) }}" alt="User Image">
                  <span class="username">Conversations of {{$user->name}} (ID {{$user->id}})</span>
                 
                </div>
              
              </div>
              <!-- /.card-header -->
             
              <!-- /.card-body -->
              @foreach($msgUsers as $mu)
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <img class="img-circle img-sm" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $mu->userTo->fi()]) }}" alt="User Image">
                    
                  @php
                      $u2nd = ($mu->userfrom_id == $user->id) ? $mu->userto_id : $mu->userfrom_id;
                  @endphp
                  <a href="{{route('admin.conversationsDetailsOfUsers',['user1'=>$user,'user2'=>$u2nd])}}">
                    <div class="comment-text">
                    <span class="username">
                      {{$mu->userTo->name}}
                      <span class="text-muted float-right">{{$mu->created_at}}</span>
                    </span><!-- /.username -->
                       {{$mu->message}}
                  </div>
                  </a>
                  
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                
                <!-- /.card-comment -->
              </div>

                 @endforeach
              <!-- /.card-footer -->
              
              <!-- /.card-footer -->
            </div>


  
    
    
    
</section>
<!-- /.content -->

@endsection






