@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')

    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')
                <div class="col-12 col-lg-8">
                    <div class="card p-0 p-md-4 mb-4">
                        <div class="d-grid"><a href="{{route('parameter_dashboard_add')}}"
                                               class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                        class="fas fa-plus"></span></span>Добавить Параметр</a></div>

                    <div class="d-grid"><a href="{{route('parameter_type_add')}}"
                                           class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                    class="fas fa-plus"></span></span>Добавить Тип Параметра</a></div>

                        <ul class="list-group list-group-flush">

                            @if (count($parameters)>0)
                            <?php

                                foreach ($parameters as $parameter) {?>
                            <li class="list-group-item py-3">
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="icon icon-md"><span
                                                class="fas fa-sms"></span></span></div>
                                    <div class="col ms-n2"><a href="{{route('parameter_dashboard_edit', ['parameter' => $parameter->id])}}"><h6  class="text-sm mb-0">{{$parameter->name}}</h6></a></div>
                                    <div class="col d-none d-md-block">{{--<span class="text-muted">Added:</span> 2021-02-12
                                        14:34:12--}}
                                    </div>
                                    <div class="col-auto">
                                        <div class="btn-group">
                                            <button
                                                class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="icon icon-sm"><span
                                                        class="fas fa-ellipsis-v icon-dark"></span> </span><span
                                                    class="sr-only">Toggle Dropdown</span></button>
                                            <div class="dropdown-menu py-0"><a class="dropdown-item rounded-top"
                                                                               href="{{route('parameter_dashboard_edit', ['parameter' => $parameter->id])}}"><span
                                                        class="fas fa-edit me-2"></span>Редактировать</a> <a
                                                    class="dropdown-item text-danger rounded-bottom" href="{{route('parameter_dashboard_delete', ['parameter' => $parameter->id])}}"><span
                                                        class="fa fa-trash me-2" aria-hidden="true"></span>Удалить</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                                <?}?>
                                @endif
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
