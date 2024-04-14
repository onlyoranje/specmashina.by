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
                                                    <a onclick="chats('{{$key}}')">
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
                                    <div class="col-lg-7 col-12 chats"></div>
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

