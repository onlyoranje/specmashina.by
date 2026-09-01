@extends('layouts.base')
@section('title', $title)
@section('main')

    <section class="category-page section">
        <div class="container">
            <div class="row">

                <div class="col-lg-3 col-md-12 col-12">
                    <!-- Start Dashboard Sidebar -->
                @include('layouts.dashboard_profile')
                <!-- Start Dashboard Sidebar -->
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="category-grid-list">

                        <div class="row">

                            <div class="col-12">
                                <div class="category-grid-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <h3 class="title">Показано {{$organizations->firstItem()}}-{{$organizations->lastItem()}} из {{$organizations->total()}} организаций</h3>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-12">

                                    @foreach ($organizations as $organization)

                                        <div class="single-item-grid">
                                            <div class="row align-items-center">


                                                <div class="col-lg-3 col-md-7 col-12">
                                                    <div class="image">
                                                        <a href="{{route('organization',$organization->id)}}">
                                                            @if (isset($organization->logo))
                                                                <img src="{{Storage::url($organization->logo)}}" alt="#">
                                                            @else
                                                                {!! Avatar::create($organization->realname)->toSvg() !!}
                                                            @endif
                                                        </a>

                                                    </div>
                                                </div>
                                                <div class="col-lg-9 col-md-5 col-12">
                                                    <div class="content">

                                                        <h3 class="title title-organization">
                                                            <a href="{{route('organization',$organization->id)}}">{{$organization->title}}</a>
                                                        </h3>

                                                        <a href="{{route('organization',$organization->id)}}" class="tag">Объявлений: {{$organization ? $organization->count_bbs() : 'нет'}}</a>
                                                        <br>
                                                        @if ($organization->active == 'Y')
                                                            <a  class="tag">Активен</a> / <a href="{{route('change_organization_status',['organization'=>$organization->id,'status'=>'N'])}}" class="tag text-danger">Заблокировать</a>
                                                        @else
                                                            <a  class="tag">Неактивен</a> / <a href="{{route('change_organization_status',['organization'=>$organization->id,'status'=>'Y'])}}" class="tag text-success">Активировать</a>
                                                        @endif
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Pagination -->
                                        {{ $organizations->onEachSide(1)->appends(request()->input())->links() }}
                                        <!--/ End Pagination -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection