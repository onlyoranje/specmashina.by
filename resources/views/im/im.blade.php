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

                                                @if (isset($messages))
                                                    @foreach($messages as $key=>$message)
                                                        @php
                                                        $user2 = $message['user'];
                                                        @endphp
                                                       {{-- @dd($message)--}}
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <div class="image">
                                                            <img src="assets/images/messages/image1.jpg" alt="#">
                                                        </div>
                                                        <span class="username">{{$user2->realname}}</span>
                                                        <span class="short-message">88</span>
                                                        <span class="unseen-message">02</span>
                                                    </a>
                                                </li>
                                                    @endforeach
                                                @endif




                                            </ul>
                                        </div>
                                        <!-- End User List -->
                                    </div>
                                    <div class="col-lg-7 col-12">
                                        <!-- Start Chat List -->
                                        <div class="chat-list">
                                            <ul class="single-chat-head">
                                                <li class="left">
                                                    <img src="assets/images/messages/image1.jpg" alt="#">
                                                    <p class="text">Lorem Ipsum is simply dummy text of the printing and
                                                        typesetting industry.
                                                        <span class="time">9:51 AM</span>
                                                    </p>
                                                </li>
                                                <li class="right">
                                                    <img src="assets/images/messages/image2.jpg" alt="#">
                                                    <p class="text">Lorem Ipsum is simply dummy text of the printing and
                                                        typesetting industry.
                                                        <span class="time">11:00 AM</span>
                                                    </p>
                                                </li>
                                                <li class="left">
                                                    <img src="assets/images/messages/image1.jpg" alt="#">
                                                    <p class="text">Lorem Ipsum is simply dummy text of the printing and
                                                        typesetting industry.
                                                        <span class="time">12:00 AM</span>
                                                    </p>
                                                </li>
                                                <li class="right">
                                                    <img src="assets/images/messages/image2.jpg" alt="#">
                                                    <p class="text">Lorem Ipsum is simply dummy text of the printing and
                                                        typesetting industry.
                                                        <span class="time">12:25 AM</span>
                                                    </p>
                                                </li>
                                            </ul>
                                            <div class="reply-block">
                                                <ul class="add-media-list">
                                                    <li><a href="javascript:void(0)"><i class="lni lni-link"></i></a></li>
                                                    <li><a href="javascript:void(0)"><i class="lni lni-image"></i></a></li>
                                                </ul>
                                                <input name="reply" type="text" placeholder="Type your message here...">
                                                <button class="reply-btn"><img src="assets/images/messages/send.svg" alt="#"></button>
                                            </div>
                                        </div>
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
<pre> @php
        print_r($messages)
    @endphp</pre>



@endsection

