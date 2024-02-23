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
                    <div class="main-content">
                        <!-- Start Profile Settings Area -->
                        <div class="dashboard-block mt-0 profile-settings-block">
                            <h3 class="block-title">Настройки профиля</h3>
                            <div class="inner-block">
                                <div class="image">
                                    @if ($user->avatar)
                                    <img src="{{Storage::url($user->resizeImage($user->avatar,150, 150))}}" alt="#">
                                    @else
                                        {!! Avatar::create($user->realname)->toSvg() !!}
                                    @endif
                                </div>
                                <form class="profile-setting-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Имя*</label>
                                                <input name="realname" type="text" placeholder="Александр" value="{{old('name', $user->realname)}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Телефон*</label>
                                                <input name="phone" type="text" placeholder="+375 XX XXX-XX-XX" id="phone" value="{{old('name', $user->phone)}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-12">
                                            <div class="form-group">
                                                <label>Email*</label>
                                                <input name="email" type="email" placeholder="username@mail.com" value="{{old('email', $user->email)}}">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group upload-image">
                                                <label>Фото профиля</label>
                                                <input name="profileimage" type="file" placeholder="Upload Image">
                                            </div>
                                        </div>
                                        <div class="col-6">


                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input width-auto" name="remove_avatar" value="remove">
                                                    <label class="form-check-label">Удалить фото профиля*</label>
                                                </div>

                                        </div>
                                        {{--<div class="col-12">
                                            <div class="form-group message">
                                                <label>About You*</label>
                                                <textarea name="message" placeholder="Enter about yourself"></textarea>
                                            </div>
                                        </div>--}}
                                        <div class="col-12">
                                            <div class="form-group button mb-0 mt-5">
                                                <button type="submit" class="btn ">Обновить</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Profile Settings Area -->
                        <!-- Start Password Change Area -->
                        <div class="dashboard-block password-change-block">
                            <h3 class="block-title">Изменить пароль</h3>
                            <div class="inner-block">
                                <form class="default-form-style" method="post" action="{{ route('password.update') }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Текущий пароль*</label>
                                                <input name="current_password" type="password" >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Новый пароль*</label>
                                                <input name="password" type="password" >
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Повторите новый пароль*</label>
                                                <input name="password_confirmation" type="password">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group button mb-0">
                                                <button type="submit" class="btn ">Обновить пароль</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End Password Change Area -->
                    </div>
                </div>



            </div>
        </div>
    </div>
    </div>
</section>


<script>
    window.addEventListener("load", function(){
        $("#phone").mask("+375 99 999-99-99")
    });
</script>


@endsection

