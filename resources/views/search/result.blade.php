@extends('layouts.base')
@section('title', 'Поиск по сайту')
@section('main')

    <div class="section section-lg py-5" @if (Request::routeIs('home')) style="padding-top: 100px !important;"@endif>
        <div class="container">
            <div class="row pt-5 pt-md-0">
                <div class="col-lg-3 col-md-4 col-12">
                    <div class="category-sidebar">
                        <!-- Start Single Widget -->
                    @include('widgets.search_mini')
                    <!-- End Single Widget -->

                    @include('widgets.banner')
                    <!-- End Single Widget -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row justify-content-center">
                        <h3> Поиск: {{$query}}</h3>
                        @if (count($bbs) > 0)
                            @foreach ($bbs as $bb)
                                @include('bb.card')
                            @endforeach
                        @endif
                    </div>

                </div>

                <div class="col-12">
                    <!-- Pagination -->
                {{ $bbs->onEachSide(1)->links() }}
                <!--/ End Pagination -->
                </div>

            </div>




        </div>
    </div>


@endsection



