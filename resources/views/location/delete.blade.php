@extends('layouts.dashboard')
@section('title',' Удаление параметра')
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
                            <div class="col-12">
                                <!-- Start Activity Log -->

                                <h3 class="block-title">Удалить категорию {{$location->title}}</h3>
                                <form class="form-ad" action="{{route('location_dashboard_destroy', ['location'=>$location->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="col-12">
                                        <div class="form-group button mb-0 mt-5">
                                            <button type="submit" class="btn ">Удалить местоположение</button>
                                        </div>

                                    </div>
                                </form>

                            </div>
                            <!-- End Activity Log -->
                        </div>

                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>


@endsection
