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
                                    <h3 class="block-title">Изменение типа контакта {{$type->name}}</h3>
                                    <form class="default-form-style" action="{{route('editContactTypetoDB',[$type->id])}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <div class="inner-block">
                                            <div class="row">
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Название</label>
                                                        <input type="text" value="{{old('name',$type->name)}}"  name="name"  required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-12">
                                                    <div class="form-group">
                                                        <label>Маска</label>
                                                        <input type="number" value="{{old('mask',$type->mask)}}" name="period" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>Иконка</label>
                                                        <input type="text" value="{{old('icon',$type->icon)}}"  name="code">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-12">
                                                    <div class="form-group">
                                                        <label>Сортировка</label>
                                                        <input type="number" value="{{old('sort',$type->sort)}}" name="sort"   required>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4 col-12">

                                                    <div class="mb-3 " >
                                                        <label  class="form-label">Обязательное </label>
                                                        <div class="form-check">
                                                            <input type="checkbox" name='contact_required' value="Y" id="flexCheckChecked" {{isset($type->required) ? 'checked':''}}>
                                                            <label class="form-check-label">Да</label>
                                                        </div>
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


