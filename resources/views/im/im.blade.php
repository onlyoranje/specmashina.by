@extends('layouts.dashboard')
@section('title', 'Сообщения')

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

                        <div class="dashboard-block mt-0 pb-0 all_chats">
                            <div class="block-head">
                                <h3 class="block-title">Сообщения</h3>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>

    <script>

        </script>

@endsection
