@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="add-resume section">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 col-12">
                                    <div class="add-resume-inner box">

                    <form class="form-ad" action="{{route('addContactTypeToDB')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Тип</label>
                                    <input type="text" value="{{old('name')}}" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Сортировка</label>
                                    <input type="number" value="{{old('sort',500)}}" name="sort" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Иконка</label>
                                    <input type="text" value="{{old('icon')}}" name="icon" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Маска</label>
                                    <input type="text" value="{{old('mask')}}" name="mask" class="form-control" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox"  name='contact_required' value="Y" id="flexCheckChecked">
                                    <label class="form-check-label" for="flexCheckChecked">
                                        Обязательное
                                    </label>
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
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>



@endsection

