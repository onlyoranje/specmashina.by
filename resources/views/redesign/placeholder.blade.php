@extends('redesign.layouts.base')

@section('title', $section . ' — LANDI.BY')

@section('content')
  {{-- Страница-заглушка раздела (Аренда / Продажа / Новости).
       Наполняется реальным контентом на следующих шагах редизайна. --}}
  <section class="section section--light">
    <div class="container placeholder">
      <p class="eyebrow">Раздел в разработке</p>
      <h1>{{ $section }}</h1>
      <p class="hero__lead placeholder__lead">
        Мы уже работаем над этим разделом. Пока посмотрите каталог на главной —
        там вся техника в аренду и на продажу.
      </p>
      <a class="btn btn--primary" href="{{ url('/') }}">На главную</a>
    </div>
  </section>
@endsection

@push('styles')
  <style>
    .placeholder {
      padding: 96px 24px;
      text-align: center;
    }
    .placeholder .eyebrow {
      margin-bottom: 12px;
    }
    .placeholder h1 {
      margin-bottom: 16px;
    }
    .placeholder__lead {
      max-width: 32rem;
      margin: 0 auto 32px;
    }
  </style>
@endpush
