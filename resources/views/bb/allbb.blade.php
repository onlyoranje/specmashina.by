@extends('layouts.dashboard')

@section('title', 'Мои объявления')

@section('main')
    @include('dashboard_nav')

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
                        <div class="dashboard-block mt-0">
                            <div class="block-head d-flex justify-content-between align-items-center flex-wrap gap-2">
                                <h3 class="block-title mb-0 border-0 pb-0">Все объявления</h3>
                            </div>
                            <nav class="list-nav">
                                <ul>
                                    <li class="{{ $request->status_id ? '':'active' }}"><a href="{{route('allbb')}}">Все <span>{{$bbs_count}}</span></a></li>
                                    @foreach($status_bb as $status)
                                        @if ($status->count_bbs())
                                    <li class="{{ $request->status_id==$status->id ? 'active':'' }}"><a href="?status_id={{$status->id}}">{{$status->name}} <span>{{$status->count_bbs()}}</span></a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </nav>

                            <!-- Start Items Area -->
                            <div class="my-items">
                                <table class="bb-table">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="bb-col-listing">Объявление</th>
                                            <th scope="col" class="bb-col-status">Статус</th>
                                            <th scope="col" class="bb-col-city">Город</th>
                                            <th scope="col" class="bb-col-views">Просмотры</th>
                                            <th scope="col" class="bb-col-actions">Действия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                            @if (count($bbs) > 0)
                                @foreach ($bbs as $bb)

                                    @php
                                        $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
                                        $parent_rubric = $parent_rubrics[0];
                                        $subparent_rubric = $parent_rubrics[1];
                                    @endphp
                                <!-- Start Single List -->
                                <tr class="bb-row">
                                    <td class="bb-cell-listing">
                                        <div class="bb-listing">
                                            @if (count($bb->userfile)> 0)
                                                <img class="bb-listing__thumb" src="{{Storage::url($bb->userfile[0]->resize(100, 100))}}" alt="{{ $bb->title }}" width="70" height="70" loading="lazy">
                                            @else
                                                <img class="bb-listing__thumb" src="http://placehold.it/100x100&text={{ $bb->title }}" alt="{{ $bb->title }}" width="70" height="70">
                                            @endif
                                            <div class="bb-listing__body">
                                                <a class="bb-listing__title" href="{{route('bb',['bb'=>$bb->id])}}">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{$bb->vendor->name}} {{ $bb->title }}</a>
                                                <span class="bb-listing__price">{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</span>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="bb-cell-status">
                                        <span class="bb-owner">{{$bb->user->organization->title}}</span>
                                        <span class="status-badge" style="--badge: {{$bb->status_bb->color_badge ? '#' . $bb->status_bb->color_badge : '#D92323'}}">{{$bb->status_bb->name}}</span>
                                        <div class="bb-dates">
                                            <span class="bb-dates__line">Создано: {{date('d.m.Y H:i',strtotime($bb->created_at))}}</span>
                                            @if ($bb->created_at!=$bb->updated_at)
                                                <span class="bb-dates__line">Обновлено: {{date('d.m.Y H:i',strtotime($bb->updated_at))}}</span>
                                            @endif
                                            @if ($bb->lifted_at)
                                                <span class="bb-dates__line">Поднято: {{date('d.m.Y H:i',strtotime($bb->lifted_at))}}</span>
                                            @endif
                                        </div>
                                    </td>

                                    <td class="bb-cell-meta bb-cell-city" data-label="Город">{{$bb->location->title}}</td>
                                    <td class="bb-cell-meta bb-cell-views" data-label="Просмотры">{{$bb->count_views()}}</td>

                                    <td class="bb-cell-actions">
                                        <div class="bb-actions">
                                            <a class="bb-btn-edit" href="{{route('bb_edit', ['bb'=>$bb->id]) }}">Редактировать</a>
                                            @if ($bb->active=='Y')
                                                <a class="bb-icon bb-icon--view" href="{{route('bb',['bb'=>$bb->id])}}" target="_blank" rel="noopener" title="Просмотреть" aria-label="Просмотреть"><i class="fa-solid fa-eye" aria-hidden="true"></i></a>
                                            @endif
                                            @if ($bb->status_bb->active=='Y' and $bb->active=='N')
                                                <a class="bb-icon bb-icon--play" href="{{route('bb_active',['bb'=>$bb->id,'active'=>'Y'])}}{{url_parameters($request)}}" title="Снять с паузы" aria-label="Снять с паузы"><i class="fa-solid fa-play" aria-hidden="true"></i></a>
                                            @endif
                                            @if ($bb->status_bb->active=='Y' and $bb->active=='Y')
                                                <a class="bb-icon bb-icon--pause" href="{{route('bb_active',['bb'=>$bb->id,'active'=>'N'])}}{{url_parameters($request)}}" title="Пауза" aria-label="Поставить объявление на паузу"><i class="fa-solid fa-pause" aria-hidden="true"></i></a>
                                            @endif
                                            @if ($bb->active=='Y')
                                                <a class="bb-icon bb-icon--lift" href="{{route('bb_up',['bb'=>$bb->id])}}{{url_parameters($request)}}" title="Поднять объявление" aria-label="Поднять объявление"><i class="fa-solid fa-arrow-up" aria-hidden="true"></i></a>
                                            @endif
                                            <a class="bb-icon bb-icon--danger" href="{{route('bb_delete', ['bb'=>$bb->id]) }}{{url_parameters($request)}}" title="Удалить" aria-label="Удалить объявление"><i class="fa-solid fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                <!-- End Single List -->
                                @endforeach
                            @else
                                <tr>
                                    <td class="adm-empty" colspan="5">Объявлений пока нет.</td>
                                </tr>
                            @endif
                                </tbody>
                                </table>
                                <!-- Pagination -->
                                @if ($bbs->hasPages())
                                    <div class="adm-list-pages">
                                        {{ $bbs->links('pagination::norwegian') }}
                                    </div>
                                @endif
                                <!--/ End Pagination -->
                            </div>
                            <!-- End Items Area -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
