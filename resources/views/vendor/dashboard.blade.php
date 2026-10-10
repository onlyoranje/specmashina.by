@extends('layouts.dashboard')
@section('title', 'Производители')

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
                                <h3 class="block-title">Производители</h3>
                                <div class="block-actions">
                                    <a href="{{route('vendor_dashboard_add')}}" class="btn">+ Добавить производителя</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($vendors as $vendor)
                                    <li>
                                        <div class="log-icon">
                                            <i class="lni lni-flag-alt"></i>
                                        </div>
                                        <a href="{{route('vendor_dashboard_edit', ['vendor' => $vendor->id])}}" class="title">{{$vendor->name}}</a>
                                        <span class="time"><a href="{{route('vendor_dashboard_edit', ['vendor' => $vendor->id])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('vendor_dashboard_delete', ['vendor' => $vendor->id])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одного производителя</li>
                                @endforelse
                            </ul>

                            {{-- Пагинация — та же, что в разделе городов
                                 (/dashboard/location): .adm-list-pages + вид
                                 pagination::norwegian вместо легаси
                                 .pagination/.pagination-list из bootstrap-4.
                                 Ссылка — обычный GET-переход ?page=N, JS не нужен. --}}
                            @if ($vendors->hasPages())
                                <div class="adm-list-pages">
                                    {{ $vendors->onEachSide(1)->links('pagination::norwegian') }}
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
