@extends($layout)
@section('content')
    <!-- Admin User/Student Messages Area -->
<div id="page-wrapper">
  <div class="container-fluid">
 <div class="row">
                   <div class="col-lg-12">
                       <ol class="breadcrumb">
                           <li><a href="{{PREFIX}}"><i class="mdi mdi-home"></i></a> </li>
                           <li><a href="{{URL_MESSAGES}}">Messages</a> </li>

                       </ol>
                   </div>
               </div>
               <div class="panel panel-custom">
                   <div class="panel-heading">
                       <div class="pull-right messages-buttons">
                           <a class="btn btn-lg btn-primary button" href="{{URL_MESSAGES}}"> {{getPhrase('inbox').'('.$count = Auth::user()->newThreadsCount().')'}} </a>
                           <a class="btn btn-lg btn-danger button" href="{{URL_MESSAGES_CREATE}}">
                           {{getPhrase('compose')}}</a>


                       </div>
                       <h1>{{getPhrase('inbox')}}</h1>
                   </div>
                   <?php $currentUserId = Auth::user()->id;?>
                   <div class="panel-body packages">
                       <div class="row">

                           <div class="col-md-12">

                               <ul class="inbox-message-list inbox-message-nocheckbox">





                                     @if(count($threads)>0)

                                       @foreach($threads as $thread)

                                       <?php $class = $thread->isUnread($currentUserId) ? 'alert-info' : ''; ?>
                                      <?php

                                           $thread_r = \Cmgmyr\Messenger\Models\Thread::findOrFail($thread->id);
                                           $participants=$thread_r->participants()->get();
//                                           echo $thread->latestMessage->user_id;
                                           $sender = getUserRecord($thread->latestMessage->user_id); ?>

                                   <li class="unread-message {!!$class!!}">
                                   <?php
                                    //dd($sender->slug);
                                   $image_path ='';
                                   if(isset($sender->image))
                                       $image_path = getProfilePath($sender->image);
                                   else
                                       $image_path = IMAGE_PATH_PROFILE_THUMBNAIL_DEFAULT;


                                   ?>

                                       <a  href="{{URL_USER_DETAILS}}" target="_blank"> <img class="sender" src="{{$image_path}}" alt=""></a>
                                        <a href="{{URL_MESSAGES_SHOW.$thread->id}}" class="message-suject">
                                           <h3>{{ucfirst($thread->subject)}}</h3>
                                           <p>{!! $thread->latestMessage->body !!}</p>

                                       </a>
                                       <span class="receive-time"><i class="mdi mdi-clock"></i> {{$thread->latestMessage->updated_at->diffForHumans()}}</span>
                                   </li>
                                     @endforeach
                                   @else
                                       <p>Sorry, no messages.</p>
                                   @endif




                               </ul>

                                 <div class="custom-pagination pull-right">
                                  {!! $threads->links() !!}
                               </div>
                           </div>
                       </div>





                   </div>
               </div>
           </div>
           <!-- /.container-fluid -->
       </div>

@stop