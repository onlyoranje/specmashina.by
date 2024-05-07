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

                        @if (session('status') === 'password-updated')
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Пароль обновлен!</h4>

                            </div>
                    @endif

                        <!-- Start Profile Settings Area -->
                        <div class="dashboard-block mt-0 profile-settings-block">
                            <h3 class="block-title">Настройки профиля</h3>
                            <div class="inner-block">

                                <form class="profile-setting-form" method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('patch')
                                    <div class="row">
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label>Имя*</label>
                                                <input name="realname" type="text" placeholder="Александр" value="{{old('name', $user->realname)}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label>Телефон*</label>
                                                <input name="phone" type="text" placeholder="+375 XX XXX-XX-XX" id="phone" value="{{old('name', $user->phone)}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-12">
                                            <div class="form-group">
                                                <label>Email*</label>
                                                <input name="email" type="email" placeholder="username@mail.com" value="{{old('email', $user->email)}}">
                                            </div>
                                        </div>
                                        <div class="col-3"><div class="image">
                                                @if ($user->avatar)
                                                    <img src="{{Storage::url($user->resizeImage($user->avatar,150, 150))}}" alt="#">
                                                @else
                                                    {!! Avatar::create($user->realname)->toSvg() !!}
                                                @endif
                                            </div></div>
                                        <div class="col-9">
                                            <div class="form-group upload-image">
                                                <label>Фото профиля</label>
                                                <input name="profileimage" type="file" placeholder="Upload Image">
                                            </div><div class="form-check">
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
                            <div class="dashboard-block  profile-settings-block">
                                <h3 class="block-title">Реквизиты организации</h3>
                                <div class="inner-block">

                                    <form class="profile-setting-form" method="post" action="{{route('organization_update')}}" enctype="multipart/form-data">
                                        @csrf
                                        @method('patch')
                                        <div class="row">
                                            <div class="col-lg-3 col-12">
                                                <div class="form-group">
                                                    <label>Название организации</label>
                                                    <input type="text" class="form-control" name="title" value="{{old('title',$user->organization?->title)}}" >
                                                </div>
                                            </div>
                                            <div class="col-lg-2 col-12">

                                                    <div class="form-group">
                                                        <label>УНП</label>
                                                        <input name="unp" type="text" id="unp" value="{{old('title',$user->organization?->unp)}}">
                                                    </div>

                                            </div>
                                            <div class="col-lg-3 col-12">
                                                <div class="form-group">
                                                    <label>Телефон</label>
                                                    <input type="text"  id="phone" name="phone" value="{{old('title',$user->organization?->phone)}}">
                                                </div>
                                                </div>
                                            <div class="col-lg-4 col-12">
                                                <div class="form-group">
                                                    <label>E-mail</label>
                                                    <input type="email"  name="email" value="{{old('title',$user->organization?->email)}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-12">

                                            <div class="form-group">
                                                <label>Город</label>
                                                <div class="selector-head">

                                                    <div id="container_location_0" class="container_location"></div>

                                                </div>
                                            </div>

                                        </div>
                                            <div class="col-lg-6 col-12">
                                                <div class="form-group">
                                                    <label>Адрес организации</label>
                                                    <textarea name="address" cols="1" >{{$user->organization?->address}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-3"><div class="image">
                                                    @if ($user->organization?->logo)
                                                        <img src="{{Storage::url($user->resizeImage($user->organization->logo,150, 150))}}" alt="#">
                                                    @elseif ($user->organization?->title)
                                                        {!! Avatar::create($user->organization?->title)->toSvg() !!}
                                                    @endif
                                                </div></div>
                                            <div class="col-9">
                                                <div class="form-group upload-image">
                                                    <label>Логотип организации</label>
                                                    <input name="logo" type="file" placeholder="Upload Image">
                                                </div><div class="form-check">
                                                    <input type="checkbox" class="form-check-input width-auto" name="remove_logo" value="remove">
                                                    <label class="form-check-label">Удалить логотип*</label>
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
        $("input [name='phone']").mask("+375 (99) 999-99-99")
        $("#unp").mask("999999999")
        window.json_location = @json($locations);
        NewSelect('location');
    });
</script>


@endsection

