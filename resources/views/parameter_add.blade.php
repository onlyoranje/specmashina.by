@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form class="form-ad" action="{{route('addParameterToDB')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    <input type="text" value="{{old('name')}}" name="name" class="form-control" placeholder="Name">
                                </div>
                            </div>

                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Мера</label>
                                    <input type="text" value="{{old('measure',500)}}" name="measure" class="form-control" placeholder="сортировка">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Мера</label>
                                    <input type="text" value="{{old('measure',500)}}" name="measure" class="form-control" placeholder="сортировка">
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="form-group">
                                    <label class="control-label">Сортировка</label>
                                    <input type="number" value="{{old('sort',500)}}" name="sort" class="form-control" placeholder="сортировка">
                                </div>
                            </div>



                            <div class="row align-items-center justify-content-center">
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



@endsection

