@extends('layouts.dashboard')
@section('title', 'Категории')

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
                                <div class="dashboard-block mt-0">
                                    <div class="block-head">
                                        <h3 class="block-title">Категории</h3>
                                        <div class="block-actions block-actions--tools">
                                            <div class="adm-tree-tools">
                                                <button type="button" class="adm-tree-tool" id="rubric-collapse-all">Свернуть все</button>
                                                <button type="button" class="adm-tree-tool" id="rubric-expand-all">Развернуть все</button>
                                            </div>
                                            <a href="{{route('rubric_dashboard_add')}}" class="btn">+ Добавить категорию</a>
                                        </div>
                                    </div>

                                    {{-- Дерево: плоский список строк, сворачивание вложенных
                                         категорий — public/js/rubric-tree.js (кнопки-шевроны
                                         в строках + «Свернуть/Развернуть все» выше),
                                         состояние хранится в localStorage. --}}
                                    @if (count($rubrics) > 0)
                                        <ul class="adm-list" id="rubric-tree">
                                            @include('rubric.partials.tree', ['rubrics' => $rubrics, 'prefix' => '', 'depth' => 0])
                                        </ul>
                                    @else
                                        <ul class="adm-list" id="rubric-tree">
                                            <li class="adm-empty">Пока нет ни одной категории</li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/rubric-tree.js') }}" defer></script>

@endsection
