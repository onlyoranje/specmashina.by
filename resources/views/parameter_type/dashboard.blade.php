@extends('layouts.dashboard')
@section('title', 'Типы параметров')

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

                        <!-- Start Activity Log -->
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h3 class="block-title">Типы параметров</h3>
                                <div class="block-actions">
                                    <a href="{{route('parameter_type_add')}}" class="btn">+ Добавить тип параметра</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($types as $type)
                                    <li>
                                        <div class="log-icon">
                                            <i class="lni lni-flag-alt"></i>
                                        </div>
                                        <a href="{{route('parameter_type_edit', ['type' => $type->id])}}" class="title">
                                            {{$type->type_name}} <span class="adm-muted">({{$type->type}})</span>
                                        </a>
                                        <span class="time"><a href="{{route('parameter_type_edit', ['type' => $type->id])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('parameter_type_delete', ['type' => $type->id])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одного типа параметра</li>
                                @endforelse
                            </ul>

                            {{-- Пагинация в стиле Norwegian Air — как в разделах
                                 городов / производителей / новостей. --}}
                            @if ($types->hasPages())
                                <div class="adm-list-pages">
                                    {{ $types->links('pagination::norwegian') }}
                                </div>
                            @endif
                        </div>
                        <!-- End Activity Log -->

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
