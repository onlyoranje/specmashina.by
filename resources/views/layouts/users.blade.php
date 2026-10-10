@extends('layouts.base')
@section('title', $title)
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

                        <!-- Start Activity Log -->
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Пользователи</h3>
                                <span class="block-count">Показано {{$users->firstItem()}}-{{$users->lastItem()}} из {{$users->total()}}</span>
                            </div>
                            <ul class="adm-list adm-list-plain">
                                @forelse ($users as $user)
                                    <li>
                                        <a href="{{route('user',$user->id)}}" class="adm-avatar">
                                            @if (isset($user->avatar))
                                                <img src="{{Storage::url($user->resizeImage($user->avatar,150, 150))}}" alt="{{$user->realname}}">
                                            @else
                                                {!! Avatar::create($user->realname)->toSvg() !!}
                                            @endif
                                        </a>
                                        <a href="{{route('user',$user->id)}}" class="title">{{$user->realname}}</a>
                                        <span class="adm-meta">
                                            {{$user->organization->title ?? 'нет организации'}}<br>
                                            Объявлений: <b>{{$user->organization ? $user->organization->count_bbs() : 'нет'}}</b>
                                        </span>
                                        @if ($user->active == 'Y')
                                            <span class="adm-state is-active">Активен</span>
                                            <span class="time"><a href="{{route('change_user_status',['user'=>$user->id,'status'=>'N'])}}" class="text-danger">Заблокировать</a></span>
                                            <span class="time"><a href="{{route('admin_user_edit',['user'=>$user->id])}}" class="text-primary">Редактировать</a></span>
                                        @else
                                            <span class="adm-state is-blocked">Неактивен</span>
                                            <span class="time"><a href="{{route('change_user_status',['user'=>$user->id,'status'=>'Y'])}}">Активировать</a></span>
                                            <span class="time"><a href="{{route('admin_user_edit',['user'=>$user->id])}}" class="text-primary">Редактировать</a></span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="adm-empty">Пользователей пока нет</li>
                                @endforelse
                            </ul>

                        <!-- Pagination -->
                        @if ($users->hasPages())
                            <div class="adm-list-pages">
                                {{ $users->appends(request()->input())->links('pagination::norwegian') }}
                            </div>
                        @endif
                        <!--/ End Pagination -->
                        </div>
                        <!-- End Activity Log -->

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
