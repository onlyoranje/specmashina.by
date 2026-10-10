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
                                <h3 class="block-title">Организации</h3>
                                <span class="block-count">Показано {{$organizations->firstItem()}}-{{$organizations->lastItem()}} из {{$organizations->total()}}</span>
                            </div>
                            <ul class="adm-list adm-list-plain">
                                @forelse ($organizations as $organization)
                                    <li>
                                        <a href="{{route('organization',$organization->id)}}" class="adm-avatar">
                                            @if (isset($organization->logo))
                                                <img src="{{Storage::url($organization->logo)}}" alt="{{$organization->title}}">
                                            @else
                                                {!! Avatar::create($organization->realname)->toSvg() !!}
                                            @endif
                                        </a>
                                        <a href="{{route('organization',$organization->id)}}" class="title">{{$organization->title}}</a>
                                        <span class="adm-meta">Объявлений: <b>{{$organization->count_bbs()}}</b></span>
                                        @if ($organization->active == 'Y')
                                            <span class="adm-state is-active">Активен</span>
                                            <span class="time"><a href="{{route('change_organization_status',['organization'=>$organization->id,'status'=>'N'])}}" class="text-danger">Заблокировать</a></span>
                                        @else
                                            <span class="adm-state is-blocked">Неактивен</span>
                                            <span class="time"><a href="{{route('change_organization_status',['organization'=>$organization->id,'status'=>'Y'])}}">Активировать</a></span>
                                        @endif
                                    </li>
                                @empty
                                    <li class="adm-empty">Организаций пока нет</li>
                                @endforelse
                            </ul>

                        <!-- Pagination -->
                        @if ($organizations->hasPages())
                            <div class="adm-list-pages">
                                {{ $organizations->appends(request()->input())->links('pagination::norwegian') }}
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
