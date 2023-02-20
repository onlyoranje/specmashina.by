@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="card">
                        <div class="add-resume section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-10 offset-lg-1 col-12">
                                        <div class="add-resume-inner box">

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Название организации</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Адрес организации</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Адрес организации</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">УНП</label>
                                    <input type="text" class="form-control" name="unp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Сайт</label>
                                    <input type="text" class="form-control" name="site">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Лого</label>
                                    <input type="file" class="form-control" name="file">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        </div>
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

