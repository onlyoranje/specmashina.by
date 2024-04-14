@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12">
                    <!-- Start Dashboard Sidebar -->
                @include('layouts.dashboard_profile')
                <!-- Start Dashboard Sidebar -->
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">

                        <div class="dashboard-block mt-0 pb-0">
                            <h3 class="block-title mb-0">Сообщения</h3>
                            <!-- Start Messages Body -->
                            <div class="messages-body">
                                <div class="form-head">
                                    <div class="row align-items-center">
                                        <div class="col-lg-5 col-12">
                                            <form class="chat-search-form">
                                                <input type="text" placeholder="Search username" name="search">
                                                <button value="search" type="submit"><i class="lni lni-search-alt"></i></button>
                                            </form>
                                        </div>
                                        <div class="col-lg-7 col-12 align-right">
                                            <h3 class="username-title">{{Auth::user()->realname}}</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5 col-12">
                                        <!-- Start User List -->
                                        <div class="user-list">
                                            <ul>
{{--@dd($messages)--}}
                                                @if (isset($messages))
                                                    @foreach($messages as $key=>$message)
                                                        @php
                                                        $user2 = $message['user2'];
                                                        @endphp
                                                       {{-- @dd($message)--}}
                                                <li>
                                                    <a onclick="ShowChat('{{$key}}')">
                                                        <div class="image">
                                                            @if ($user2->avatar)
                                                                <img src="{{Storage::url($user2->resizeImage($user2->avatar,150, 150))}}" alt="#">
                                                            @else
                                                                {!! Avatar::create($user2->realname)->toSvg() !!}
                                                            @endif
                                                        </div>
                                                        <span class="username">{{$user2->realname}}</span>
                                                        <span class="short-message">{{$message['last_message']}}</span>
                                                        @if (isset($message['unread']))
                                                        <span class="unseen-message">{{$message['unread']}}</span>
                                                        @endif
                                                    </a>
                                                </li>
                                                    @endforeach
                                                @endif




                                            </ul>
                                        </div>
                                        <!-- End User List -->
                                    </div>
                                    <div class="col-lg-7 col-12 chats">
                                        <!-- Start Chat List -->
                                        @if (isset($messages))
                                            @foreach($messages as $key=>$message)
                                        <div class="chat-list hide" id="{{$key}}">
                                            <ul class="single-chat-head">
                                                @foreach($message['message'] as $msg)
                                                    @if ($msg['user1_id'] ==Auth::id())
                                                <li class="right">
                                                    @if ($message['user1']->avatar)
                                                        <img src="{{Storage::url($message['user1']->resizeImage($message['user1']->avatar,150, 150))}}" alt="#">
                                                    @else
                                                        {!! Avatar::create($message['user1']->realname)->toSvg() !!}
                                                    @endif
                                                        @else
                                                            <li class="left">
                                                            @if ($message['user2']->avatar)
                                                                <img src="{{Storage::url($message['user2']->resizeImage($message['user2']->avatar,150, 150))}}" alt="#">
                                                            @else
                                                                <img src="{!! Avatar::create($message['user2']->realname)->toGravatar() !!}" alt="#">
                                                            @endif
                                                                @endif


                                                            <p class="text">{!! html_entity_decode($msg->text) !!}
                                                                <span class="time">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i:s d.m.Y') }}</span>
                                                            </p>
                                                        </li>

                                                @endforeach
                                            </ul>
                                            <div class="reply-block">
                                                <ul class="add-media-list">
                                                    <li><a href="javascript:void(0)"><i class="lni lni-link"></i></a></li>
                                                    <li><a href="javascript:void(0)"><i class="lni lni-image"></i></a></li>
                                                </ul>
                                                <input name="reply" id="reply_{{$key}}" type="text" placeholder="Type your message here...">
                                                <input type="hidden" id="user2_{{$key}}" value="{{$message['user2']->id}}">
                                                <button class="reply-btn"><img src={{asset("images/messages/send.svg")}} alt="#" onclick="createMsg('{{$key}}')"></button>
                                            </div>
                                        </div>

                                        @endforeach
                                    @endif
                                    <!-- End Chat List -->
                                    </div>
                                </div>
                            </div>
                            <!-- End Messages Body -->
                        </div>
                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>




@endsection

