@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{route('addVendorToDB')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label  class="form-label">Бренд</label>
                        <input type="text" name="name" class="form-control" >
                        <div class="col-lg-6 col-md-5 col-12">
                            <div class="button">
                                <button type="submit" class="btn">Save</button>
                            </div>
                        </div>
                    </form>
                    </div>
                    </div>
                    </div>
                    </div>

@endsection
