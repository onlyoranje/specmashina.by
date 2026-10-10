@extends('layouts.dashboard')
@section('title', $title)

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
                                <h3 class="block-title">Новости</h3>
                                <div class="block-actions">
                                    <a href="{{route('post_add')}}" class="btn">+ Добавить новость</a>
                                </div>
                            </div>
                            <ul class="adm-list">
                                @forelse ($posts as $post)
                                    <li>
                                        <div class="log-icon">
                                            <i class="lni lni-flag-alt"></i>
                                        </div>
                                        <a href="" class="title">{{$post->title}}</a>
                                        <span class="time"><a href="{{route('post_dashboard', ['post' => $post->id])}}">Редактировать</a></span>
                                        <span class="time"><a href="{{route('delete_post', ['post' => $post->id])}}" class="text-danger">Удалить</a></span>
                                    </li>
                                @empty
                                    <li class="adm-empty">Пока нет ни одной новости</li>
                                @endforelse
                            </ul>

                            {{-- Пагинация — та же, что в разделах городов
                                 (/dashboard/location) и производителей
                                 (/dashboard/vendor): .adm-list-pages + вид
                                 pagination::norwegian вместо легаси
                                 .pagination/.pagination-list из bootstrap-4.
                                 Ссылка — обычный GET-переход ?page=N, JS не нужен. --}}
                            @if ($posts->hasPages())
                                <div class="adm-list-pages">
                                    {{ $posts->links('pagination::norwegian') }}
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
