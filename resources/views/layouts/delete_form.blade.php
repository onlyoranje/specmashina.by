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
                    <!-- Start Profile Settings Area -->
                    <div class="dashboard-block mt-0 profile-settings-block">
                        <h3 class="block-title">{{$title}}</h3>
                        <div class="inner-block">
                            @if ($errors_form)
                                @foreach ($errors_form as $error)
                                    <div class="alert alert-warning" role="alert">
                                        {{$error}}
                                    </div>
                                @endforeach
                            @else
                                <form class="form-ad" action="{{route($route, $id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group button mb-0">
                                                <button type="submit" class="btn">Удалить</button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            @endif

                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>
    </div>
</section>
