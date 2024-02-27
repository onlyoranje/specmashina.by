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
                            <div class="col-12">
                                <!-- Start Activity Log -->
                                <div class="profile-settings-block dashboard-block mt-0">
                                    <h3 class="block-title">Добавление типа параметра</h3>
                                    <form class="default-form-style" action="{{route('addTypeToDB')}}" method="post">
                                        @csrf

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Тип</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                            <select class="user-chosen-select" name="type"  required>
                                                                <option selected disabled>- выбрать -</option>

                                                                @foreach($types as $type)
                                                                    <option value="{{$type}}" @if (old('type')==$type) selected @endif >{{$type}}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label >Имя типа</label>
                                                        <input type="text" value="{{old('type_name')}}" name="type_name" class="form-control"  required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Добавить</button>
                                                    </div>
                                                </div>
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

