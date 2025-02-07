@extends('layouts.base')
@section('title', $title)
@section('description', $description)
@section('main')

    @php
    $bbs1 = $bbs;
    $bbs2 = $bbs;
    $tab_list = 'nav_list';
    if (isset($_COOKIE['tablist']))  $tab_list = $_COOKIE['tablist'];


    @endphp

    <section class="category-page section">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-5"><h1>{{$title}}</h1></div>
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">
                        <!-- Start Single Widget -->
                        @include('widgets.search_mini')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @if (Request::routeIs('rubric'))
                    @include('widgets.location')
                    @include('widgets.category')

                    @endif
                    @if (Request::routeIs('location'))
                        @include('widgets.category_location')

                    @endif
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                  {{--  @include('widgets.range')
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                    @include('widgets.options')--}}
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        @desktop
                    @include('widgets.banner')
                        @enddesktop
                        <!-- End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="category-grid-list">

                        <div class="row">
                            <div class="col-12">
                                <div class="category-grid-topbar">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-md-6 col-12">
                                            @if (!$alert_message)
                                            <h3 class="title">Показано {{$bbs->firstItem()}}-{{$bbs->lastItem()}} из {{$bbs->total()}} объявлений</h3>
                                            @else
                                            <h3  class="title"> {{$alert_message}}</h3>
                                                @endif
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-12">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                    <button class="nav-link @php echo $tab_list=='nav-grid' ? 'active' : '' @endphp" id="nav-grid-tab" data-bs-toggle="tab"
                                                            data-bs-target="#nav-grid" type="button" role="tab"
                                                            aria-controls="nav-grid" aria-selected="@php echo $tab_list=='nav-grid' ? 'true' : 'false' @endphp"><i
                                                            class="lni lni-grid-alt"></i></button>
                                                    <button class="nav-link @php echo $tab_list!='nav-grid' ? 'active' : '' @endphp" id="nav-list-tab"
                                                            data-bs-toggle="tab" data-bs-target="#nav-list" type="button"
                                                            role="tab" aria-controls="nav-list" aria-selected="@php echo $tab_list!='nav-grid' ? 'true' : 'false' @endphp"><i
                                                            class="lni lni-list"></i></button>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade @php echo $tab_list=='nav-grid' ? 'show active' : '' @endphp" id="nav-grid" role="tabpanel" aria-labelledby="nav-grid-tab">

                                        <div class="row">

                                            @foreach ($bbs1 as $bb_widget)
                                                @include('bb.minicard')
                                            @endforeach

                                        </div>
                                        @if (!$alert_message)
                                        <div class="row">
                                            <div class="col-12">
                                                <!-- Pagination -->
                                            {{ $bbs1->onEachSide(1)->links() }}
                                                <!--/ End Pagination -->
                                            </div>
                                        </div>
                                            @endif
                                    </div>
                                    <div class="tab-pane fade @php echo $tab_list!='nav-grid' ? 'show active' : ''; @endphp " id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                        <div class="row">
                                            @foreach ($bbs2 as $bb)
                                                @include('bb.card')
                                            @endforeach

                                        </div>
                                        @if (!$alert_message)
                                            <div class="row">
                                                <div class="col-12">
                                                    <!-- Pagination -->
                                                {{ $bbs2->onEachSide(1)->links() }}
                                                <!--/ End Pagination -->
                                                </div>
                                            </div>
                                        @endif
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


