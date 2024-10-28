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
                            <h3 class="block-title">Мои объявления</h3>
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
                                <!-- Start Item List Title -->
                                <div class="item-list-title">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4 col-md-5 col-12">
                                            <p>Объявление</p>
                                        </div>

                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Статус</p>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>Город</p>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-12">
                                            <p>Просмотры</p>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-12 align-right">
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                <!-- End List Title -->
                            @if (count($bbs) > 0)
                                @foreach ($bbs as $bb)

                                    @php
                                        $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
                                        $parent_rubric = $parent_rubrics[0];
                                        $subparent_rubric = $parent_rubrics[1];
                                    @endphp
                                <!-- Start Single List -->
                                <div class="single-item-list">
                                    <div class="row align-items-center" style="border-left: 8px solid #{{$bb->status_bb->color_badge}};">
                                        <div class="col-lg-4 col-md-5 col-12 " >
                                            <div class="item-image">
                                                @if (count($bb->userfile)> 0)
                                                    <img   src="{{Storage::url($bb->userfile[0]->resize(100, 100))}}" alt="{{ $bb->title }}" >
                                                @else
                                                    <img   src="http://placehold.it/100x100&text={{ $bb->title }}" alt="{{ $bb->title }}">
                                                @endif
                                               <div class="content">
                                                    <h3 class="title"><a href="javascript:void(0)">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{$bb->vendor->name}} {{ $bb->title }}</a></h3>
                                                   <span class="price">{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-3 col-md-2 col-12">
                                            <p><b>{{$bb->user->organization->title}}</b></p>
                                            <p>{{$bb->status_bb->name}}</p>
                                            <p>Создано: {{date('d.m.Y H:i:s',strtotime($bb->created_at))}}</p>
                                            @if ($bb->created_at!=$bb->updated_at)
                                                <p>Обновлено: {{date('d.m.Y H:i:s',strtotime($bb->updated_at))}}</p>
                                                @endif

                                           @if ($bb->lifted_at)
                                                <p>Поднято: {{date('d.m.Y H:i:s',strtotime($bb->lifted_at))}}</p>
                                               @endif
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-12">
                                            <p>{{$bb->location->title}}</p>
                                        </div>
                                        <div class="col-lg-1 col-md-2 col-12">
                                            <p>{{$bb->count_views()}}</p>
                                        </div>
                                        <div class="col-lg-2 col-md-3 col-12 align-right">
                                            {{--<ul class="action-btn">
                                                <li><a href="{{route('bb_edit', ['bb'=>$bb->id]) }}"><i class="lni lni-pencil"></i></a></li>
                                                <li><a href="{{route('bb',['bb'=>$bb->id])}}" target="_blank"><i class="lni lni-eye"></i></a></li>
                                                <li><a href="{{route('bb_delete', ['bb'=>$bb->id]) }}"><i class="lni lni-trash"></i></a></li>
                                            </ul>--}}
                                            <ul>
                                                @if ($bb->active=='Y')
                                                    <li><a href="{{route('bb',['bb'=>$bb->id])}}" target="_blank">Просмотреть</a></li>

                                                @endif
                                                @if ($bb->status_bb->active=='Y' and $bb->active=='N')
                                                    <li><a href="{{route('bb_active',['bb'=>$bb->id,'active'=>'Y'])}}{{url_parameters($request)}}">Снять с паузы</a></li>
                                                @endif

                                                @if ($bb->status_bb->active=='Y' and $bb->active=='Y')
                                                    <li><a href="{{route('bb_active',['bb'=>$bb->id,'active'=>'N'])}}{{url_parameters($request)}}">Пауза</a></li>
                                                @endif
                                                @if (isset($bb->user->credit->credits) and $bb->user->credit->credits>0 and $bb->active=='Y')
                                                    <li><a href="{{route('bb_up_credit',['bb'=>$bb->id])}}{{url_parameters($request)}}">Поднять за кредит</a></li>
                                                @endif
                                                <li><a href="{{route('bb_edit', ['bb'=>$bb->id]) }}">Редактировать</a></li>
                                                <li><a href="{{route('bb_delete', ['bb'=>$bb->id]) }}{{url_parameters($request)}}">Удалить</a></li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- End Single List -->
                                @endforeach
                            @endif
                                <!-- Pagination -->
                            {{ $bbs->onEachSide(1)->links() }}
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
