{{--
    Главная личного кабинета пользователя (/dashboard).
    Стиль: скандинавский лоукост-минимализм Norwegian Air (norwegian.com) —
    белый фон, подложки #F8FAFC, тонкие границы, тёмно-синий текст и красный
    акцент только для главных (коммерческих) действий.

    Данные готовит App\Http\Controllers\ProfileController::dashboard():
      $user, $lastLoginAt, $activeListingsCount, $totalViews,
      $unreadAlertsCount, $favoritesCount, $totalListingsCount, $recentListings.

    CSS: public/css/admin.css, раздел 19 «ГЛАВНАЯ ЛИЧНОГО КАБИНЕТА».
--}}
@extends('layouts.dashboard')

@section('title', 'Личный кабинет')

@section('main')
    <section class="dashboard section">
        <div class="container">
            <div class="dash-page">

                <!-- Start Приветствие -->
                <div class="dash-topbar">
                    <div class="dash-hello">
                        <h1 class="dash-hello__title">Здравствуйте, {{ $user->name }}!</h1>
                        @if ($lastLoginAt)
                            <p class="dash-hello__meta">Последний вход:
                                {{ $lastLoginAt->format('d.m.Y H:i') }} ({{ timesince($lastLoginAt) }})</p>
                        @endif
                    </div>
                </div>
                <!-- End Приветствие -->

                <!-- Start Статистика -->
                <div class="stat-grid">
                    <div class="stat-card">
                        <span class="stat-card__label">Активные объявления</span>
                        <span class="stat-card__value">{{ $activeListingsCount }}</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__label">Просмотры за 30 дней</span>
                        <span class="stat-card__value">{{ $totalViews }}</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__label">Новые уведомления</span>
                        <span class="stat-card__value">{{ $unreadAlertsCount }}</span>
                    </div>
                    <div class="stat-card">
                        <span class="stat-card__label">Закладки</span>
                        <span class="stat-card__value">{{ $favoritesCount }}</span>
                    </div>
                </div>
                <!-- End Статистика -->

                <!-- Start Быстрые действия -->
                <nav class="quick-actions" aria-label="Быстрые действия">
                    <a class="quick-card quick-card--primary" href="{{ route('addForm') }}">
                        <i class="fa-solid fa-circle-plus" aria-hidden="true"></i>
                        <span>Добавить объявление</span>
                    </a>
                    <a class="quick-card" href="{{ route('profile.edit') }}">
                        <i class="fa-solid fa-user-pen" aria-hidden="true"></i>
                        <span>Редактировать профиль</span>
                    </a>
                    <a class="quick-card" href="{{ route('my_organization') }}">
                        <i class="fa-solid fa-building" aria-hidden="true"></i>
                        <span>Данные организации</span>
                    </a>
                    <a class="quick-card" href="{{ route('alerts') }}">
                        <i class="fa-solid fa-bell" aria-hidden="true"></i>
                        <span>Управлять уведомлениями</span>
                    </a>
                </nav>
                <!-- End Быстрые действия -->

                <!-- Start Последние объявления -->
                <div class="row">
                    {{-- На мобильных содержимое идёт первым, меню кабинета — внизу (order) --}}
                    <div class="col-lg-3 col-md-12 col-12 order-2 order-lg-1">
                        <!-- Start Dashboard Sidebar -->
                        @include('layouts.dashboard_profile')
                        <!-- End Dashboard Sidebar -->
                    </div>
                    <div class="col-lg-9 col-md-12 col-12 order-1 order-lg-2">
                        <div class="dashboard-block mt-0">
                            <div class="block-head">
                                <h2 class="block-title mb-0 border-0 pb-0">Мои последние объявления</h2>
                            </div>

                            <div class="my-items">
                                @if (count($recentListings))
                                    <ul class="ticket-list">
                                        @foreach ($recentListings as $listing)
                                            @php
                                                /* Фото 60x60: превью из user_files, иначе заглушка */
                                                $file = $listing->userfile->first();
                                                $thumb = ($file and Storage::exists('public/' . $file->url))
                                                    ? Storage::url($file->resize(120, 120))
                                                    : asset('images/placeholder/no-image.svg');

                                                /* Плоский бейдж состояния объявления */
                                                $status = $listing->status_bb;
                                                $badge_class = 'is-paused';
                                                $badge_text  = $status ? $status->name : 'Без статуса';
                                                if ($status) {
                                                    if ($listing->active == 'Y' and $status->active == 'Y') {
                                                        $badge_class = 'is-active';
                                                        $badge_text  = 'Активно';
                                                    } elseif ($status->status == 'P' or $status->active == 'Y') {
                                                        $badge_class = 'is-paused';
                                                        $badge_text  = 'На паузе';
                                                    } elseif ($status->status == 'M') {
                                                        $badge_class = 'is-moderation';
                                                        $badge_text  = 'На модерации';
                                                    } elseif ($status->status == 'N') {
                                                        $badge_class = 'is-rejected';
                                                        $badge_text  = 'Отклонено';
                                                    }
                                                }
                                            @endphp
                                            <!-- Start Строка-«билет» -->
                                            <li class="ticket">
                                                <a class="ticket__thumb" href="{{ route('bb', ['bb' => $listing->id]) }}"
                                                   tabindex="-1" aria-hidden="true">
                                                    <img src="{{ $thumb }}" alt="{{ $listing->title }}"
                                                         width="60" height="60" loading="lazy">
                                                </a>

                                                <div class="ticket__info">
                                                    <a class="ticket__title" href="{{ route('bb', ['bb' => $listing->id]) }}">{{ $listing->title }}</a>
                                                    <span class="ticket__meta">
                                                        <span class="ticket__date">{{ $listing->created_at->format('d.m.Y') }}</span>
                                                        <span class="ticket__badge {{ $badge_class }}">{{ $badge_text }}</span>
                                                    </span>
                                                </div>

                                                <div class="ticket__side">
                                                    @if ($listing->bbprice and $listing->bbprice->price !== null)
                                                        <span class="ticket__price">{{ $listing->bbprice->price }} <em>{{ optional($listing->bbprice->pricetype)->type }}</em></span>
                                                    @else
                                                        <span class="ticket__price ticket__price--none">Цена не указана</span>
                                                    @endif
                                                    <a class="bb-icon ticket__edit" href="{{ route('bb_edit', ['bb' => $listing->id]) }}"
                                                       title="Редактировать" aria-label="Редактировать объявление">
                                                        <i class="fa-solid fa-pen" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </li>
                                            <!-- End Строка-«билет» -->

                                        @endforeach
                                    </ul>

                                    <a class="dash-more" href="{{ route('mybb') }}">Смотреть все объявления
                                        ({{ $totalListingsCount }}) <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                                @else
                                    <p class="adm-empty">Объявлений пока нет.
                                        <a href="{{ route('addForm') }}">Добавить объявление</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Последние объявления -->

            </div>
            <!-- End .dash-page -->
        </div>
    </section>

@endsection

