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
                                    <h3 class="block-title">Изменение статуса {{$status->name}}</h3>
                                    <form class="default-form-style" action="{{route('editStatusToDB', ['status' => $status->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>Название</label>
                                                        <input type="text" value="{{old('name',$status->name)}}"  name="name"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12">
                                                    <div class="form-group">
                                                        <label>Активность</label>

                                                        <select class="form-select" name="active"  required>
                                                            <option value="Y" {{$status->active=='Y'?'selected':''}}>Да</option>
                                                            <option value="N" {{$status->active=='N'?'selected':''}}>Нет</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12">
                                                    <div class="form-group">
                                                        <label>Стоимость</label>
                                                        <input type="number" value="{{old('price',$status->price)}}" name="price" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12">
                                                    <div class="form-group">
                                                        <label>Период, дней</label>
                                                        <input type="number" value="{{old('period',$status->premium_status_days)}}" name="period" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',$status->sort)}}" name="sort"   required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-12">
                                                    <div class="form-group">
                                                        <label>Цвет</label>
                                                        <input type="color" value="{{old('color_badge',$status->color_badge)}}" name="color_badge"   required>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group mt-30">
                                                        <label>Описание</label>
                                                        <textarea name="description" placeholder="">{{old('description',$status->description)}}</textarea>
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


@endsection
