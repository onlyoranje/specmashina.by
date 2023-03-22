@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')


    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')

                <div class="col-12 col-lg-8">
                    <div class="row justify-content-center">


<form class="form-ad" action="{{route('addOrganizationToDB')}}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                                <script>
                                    $(function() {
                                        $("#phone").mask("+375 (99) 999-99-99")
                                        $("#unp").mask("999999999")
                                    });
                                </script>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Название организации</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Адрес организации</label>
                                    <input type="text" class="form-control" name="address">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">email</label>
                                    <input type="email" class="form-control" name="email">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">УНП</label>
                                    <input type="text" id="unp"  class="form-control" name="unp">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Сайт</label>
                                    <input type="text" class="form-control" name="site">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Телефон</label>
                                    <input type="text" class="form-control" id="phone" name="phone">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Лого</label>
                                    <input type="file" class="form-control" name="file">
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
</form>
                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                        </div>

@endsection

