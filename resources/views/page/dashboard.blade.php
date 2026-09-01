@extends('layouts.dashboard')
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

                    <div class="row">
                        <div class="col-12">
                            <!-- Start Activity Log -->
                            <ul class="activity-log dashboard-block mt-0">
                                <h3 class="block-title">Новости</h3>




                                <ul>
                                    <li>
                                        <div class="form-group button mb-0 mt-0"><a href="{{route('page_add')}}" class="btn ">Добавить страницу</a></div>
                                    </li>
                                    @if (count($pages)>0)


                                    @foreach ($pages as $page)



                                    <li>
                                        <div class="log-icon">
                                            <i class="lni lni-flag-alt"></i>
                                        </div>
                                        <a href="" class="title">{{$page->title}}</a>
                                        <span class="time"><a href='{{route('edit_page', ['page' => $page->id])}}'>Редактировать </a></span>
                                        <span class="time"><a href='{{route('delete_page', ['page' => $page->id])}}'>Удалить </a></span>
                                        <span class="time"><a href='{{route('page',['page' => $page->id])}}'>{{route('page',['page' => $page->id])}} </a></span>



                                    </li>

                                    @endforeach
                                    @endif
                                </ul>
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
