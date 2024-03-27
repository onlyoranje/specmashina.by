@php
$col='col-lg-3 col-md-4 col-12';
@endphp
<section class="items-tab section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Trending Ads</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-latest-tab" data-bs-toggle="tab" data-bs-target="#nav-latest" type="button" role="tab" aria-controls="nav-latest" aria-selected="false">Свежие</button>
                        <button class="nav-link" id="nav-popular-tab" data-bs-toggle="tab" data-bs-target="#nav-popular" type="button" role="tab" aria-controls="nav-popular" aria-selected="false">Популярные</button>
                        <button class="nav-link" id="nav-random-tab" data-bs-toggle="tab" data-bs-target="#nav-random" type="button" role="tab" aria-controls="nav-random" aria-selected="true">В случайном порядке</button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane active fade show" id="nav-latest" role="tabpanel" aria-labelledby="nav-latest-tab">
                        <div class="row">
                            @foreach ($bbs_last as $bb_widget)
                            @include('bb.minicard')
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-popular" role="tabpanel" aria-labelledby="nav-popular-tab">
                        <div class="row">
                            @foreach ($bbs_popular as $bb_widget)
                                @include('bb.minicard')
                            @endforeach
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-random" role="tabpanel" aria-labelledby="nav-random-tab">
                        <div class="row">
                            @foreach ($bbs_random as $bb_widget)
                                @include('bb.minicard')
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
