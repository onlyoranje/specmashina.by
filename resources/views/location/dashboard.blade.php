@extends('layouts.dashboard')
@section('title', 'Города')

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
                                        <h3 class="block-title">Города</h3>
                                        <div class="block-actions">
                                            <a href="{{route('location_dashboard_add')}}" class="btn">+ Добавить регион/город</a>
                                        </div>
                                    </div>

                                    {{--
                                        Поиск по названию города.
                                        Без JS это обычная GET-форма: /dashboard/location?q=минск —
                                        фильтр применяется на сервере (LocationsController::locations()).
                                        С public/js/location-search.js ввод уходит в AJAX на
                                        route('location_dashboard_search') и подменяет только
                                        #location-results, страница не перезагружается.
                                    --}}
                                    <div class="adm-toolbar">
                                        <form class="adm-search" role="search" method="get"
                                              action="{{ route('location_dashboard') }}"
                                              data-search-url="{{ route('location_dashboard_search') }}">
                                            <label class="visually-hidden" for="location-search-input">Поиск по названию города</label>
                                            <i class="lni lni-search" aria-hidden="true"></i>
                                            <input type="search" id="location-search-input" name="q"
                                                   value="{{ $q }}"
                                                   placeholder="Поиск по названию города"
                                                   autocomplete="off" spellcheck="false">
                                            <button type="button" class="adm-search-clear" id="location-search-clear"
                                                    aria-label="Очистить поиск" title="Очистить поиск" hidden>&times;</button>
                                        </form>
                                        <p class="adm-toolbar-count" id="location-count" aria-live="polite">
                                            {{ $q ? 'Найдено' : 'Всего' }}: {{ $locations->total() }}
                                        </p>
                                    </div>

                                    <div id="location-results">
                                        @include('location.partials.list')
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/location-search.js') }}" defer></script>

@endsection

