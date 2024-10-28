@extends('layouts.dashboard')

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
                                    <h3 class="block-title">Редактирование типа параметра "{{$type->type_name}} {{$type->id}}"</h3>
                                    <form class="default-form-style" action="{{route('editTypetoDB',['type'=>$type->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')

                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Тип</label>
                                                        <div class="selector-head">
                                                            <span class="arrow"><i class="lni lni-chevron-down"></i></span>
                                                            <select class="user-chosen-select" name="type"  required>
                                                                <option selected disabled>- выбрать -</option>

                                                                @foreach($types as $type_)
                                                                    <option value="{{$type_}}" @if (old('type',$type->type)==$type_) selected @endif >{{$type_}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label >Имя типа</label>
                                                        <input type="text" value="{{old('type_name',$type->type_name)}}" name="type_name" class="form-control"  required>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group button mb-0 mt-5">
                                                        <button type="submit" class="btn ">Обновить</button>
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

{{--    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form class="form-ad" action="{{route('editTypetoDB',['id'=>$type->id])}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Тип</label>
                                        <input type="text" value="{{old('type',$type->type)}}"  name="type" class="form-control" required>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label class="control-label">Имя типа</label>
                                        <input type="text" value="{{old('type_name',$type->type_name)}}" name="type_name" class="form-control"  required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-5 col-12">
                                    <div class="button">
                                        <button type="submit" class="btn">Save</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>--}}



@endsection


