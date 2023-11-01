
@if($userto)
<div class="row justify-content-center">
<div class="col-md-3">
    <!-- DIRECT CHAT PRIMARY -->

        <div class="text-center w3-text-gray" style="margin-bottom: -10px;">
            <h3 style="font-size: 1.5rem;">Conversation</h3>
        </div>
        <hr>
 
    <div class="card card-primary card-outline direct-chat direct-chat-primary">
        <div class="card-header">
        <h3 class="card-title">
            <?php Auth::user()->readMsgOf($userto); ?>
            <img  class="w3-circle" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $userto->fi()]) }}" alt="{{ $userto->name }}"> &nbsp;&nbsp;
            {{ $userto->name }}</h3>
        </h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool text-dark chat-contacts-btn " title="Contacts" data-widget="chat-pane-toggle" style="margin-top: 0px;" >
            <i class="fas fa-comments"></i>
            </button>
        </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
        <!-- Conversations are loaded here -->
        <div class="direct-chat-messages">
            <!-- Message. Default to the left -->
            @foreach(Auth::user()->messageWithUser($userto) as $m)

            @if($m->userfrom_id == Auth::id())

            <div class="direct-chat-msg">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-left">{{ $m->userFrom->name }}</span>
                <span class="direct-chat-timestamp float-right">{{ $m->created_at }}</span>
            </div>
            <!-- /.direct-chat-infos -->
            <img class="direct-chat-img" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $m->userFrom->fi()]) }}" alt="{{ $m->userFrom->name }}">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
               {{ $m->message }}
            </div>
            <!-- /.direct-chat-text -->
            </div>
            <!-- /.direct-chat-msg -->
            @else
            <!-- Message to the right -->
            <div class="direct-chat-msg right">
            <div class="direct-chat-infos clearfix">
                <span class="direct-chat-name float-right">{{ $m->userFrom->name }}</span>
                <span class="direct-chat-timestamp float-left">{{ $m->created_at }}</span>
            </div>
            <!-- /.direct-chat-infos -->
              <img class="direct-chat-img" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $m->userFrom->fi()]) }}" alt="{{ $m->userFrom->name }}">
            <!-- /.direct-chat-img -->
            <div class="direct-chat-text">
              {{ $m->message }}
            </div>
            <!-- /.direct-chat-text -->
            </div>
            @endif

            @endforeach
        </div>
        <!--/.direct-chat-messages-->

        <!-- Contacts are loaded here -->
        <div class="direct-chat-contacts">
            <ul class="contacts-list">
            @foreach(Auth::user()->messageContacts() as $c)

                @if($c->userfrom_id == Auth::id())

                <li>
                <a href="{{ route('membership.messageDashboard', $c->userto_id) }}">
                    <img class="contacts-list-img" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $c->userTo->fi()]) }}" alt="{{ $c->userTo->name }}">


                    <div class="contacts-list-info">
                        <span class="contacts-list-name">
                            {{ $c->userTo->name }} 
                            <small class="contacts-list-date float-right">{{ $c->created_at }}</small>
                        </span>
                    <span class="contacts-list-msg">{{ Str::limit($c->message, 20 , '...') }}</span>
                    </div>
                    <!-- /.contacts-list-info -->
                </a>
                </li>
                <!-- End Contact Item -->

                @else

                <li>
                <a href="{{ route('membership.messageDashboard', $c->userfrom_id) }}">
                    <img class="contacts-list-img" src="{{ route('imagecache', ['template' => 'ppxs', 'filename' => $c->userFrom->fi()]) }}" alt="{{ $c->userFrom->name }}">

                    <div class="contacts-list-info">
                        <span class="contacts-list-name">
                            {{ $c->userFrom->name }}
                            @if (!$c->read)
                            <i class="fa fa-circle"></i>

                            @endif
                            <small class="contacts-list-date pull-right">{{ $c->created_at }}</small>
                        </span>
                    <span class="contacts-list-msg">{{ Str::limit($c->message, 20, '...') }}</span>
                    </div>
                    <!-- /.contacts-list-info -->
                </a>
                </li>
                <!-- End Contact Item -->

                @endif
                
            @endforeach
            </ul>
            <!-- /.contatcts-list -->
        </div>
        <!-- /.direct-chat-pane -->
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
        <form action="{{ route('membership.messageDashboardPost', $userto) }}" method="post">
            @csrf
            <div class="input-group">
            <input type="text" name="message" placeholder="Type Message ..." class="form-control">
            <span class="input-group-append">
                <button type="submit" class="btn btn-primary">Send</button>
            </span>
            </div>
        </form>
        </div>
        <!-- /.card-footer-->
    </div>
    <!--/.direct-chat -->
</div>
    <!-- /.col -->
</div>

@else
   <div class="card shadow-lg">
       <div class="card-body">
           <h3 class="text-red text-center">Message not found</h3>
       </div>
   </div>
@endif