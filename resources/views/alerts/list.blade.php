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

                        <div class="row">
                            <div class="col-6">
                                <div class="single-block comments">
                                    <h3>Уведомления</h3>
                                    <!-- Start Single Comment -->
                                    <div class="single-comment">

                                        <div class="content">
                                            <h4>Luis Havens</h4>
                                            <span>25 Feb, 2023</span>
                                            <p>
                                                There are many variations of passages of Lorem Ipsum available, but the majority
                                                have suffered alteration in some form, by injected humour, or randomised words
                                                which don't look even slightly believable.
                                            </p>
                                            <a href="javascript:void(0)" class="reply"><i class="lni lni-reply"></i> Reply</a>
                                        </div>
                                    </div>
                                    <!-- End Single Comment -->
                                </div>
                            </div>
                            <div class="col-6">2</div>

                    </div>

                    {{ $alerts->onEachSide(1)->links() }}

                </div>
            </div>
        </div>
        </div>
    </section>



@endsection
