<section class="hero-area overlay">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                <div class="hero-text text-center">
                    <!-- Start Hero Text -->
                    <div class="section-heading">
                        <h2 class="wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">Добро пожаловать!</h2>
                        <p class="wow fadeInUp" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInUp;">Сдавайте в аренду и ищите технику на нашем сайте <br>Дорожная техника, краны, экскаваторы и прочее</p>
                    </div>
                    <!-- End Search Form -->
                    <!-- Start Search Form -->
                    <div class="search-form wow fadeInUp" data-wow-delay=".7s" style="visibility: visible; animation-delay: 0.7s; animation-name: fadeInUp;">
                        <form action="{{route('search')}}" id='hero_search' method="GET" enctype="text/plain">
                            <div class="row">
                            <div class="col-lg-10 col-md-10 col-12 p-0">

                                <div class="search-input">
                                    <label for="keyword"><i class="lni lni-search-alt theme-color" ></i></label>
                                    <input type="text" name="q" id="keyword" placeholder="Поиск ">

                                </div>

                                <div class="invalid-feedback invalid-feedback-hero-form"></div>
                            </div>


                            <div class="col-lg-2 col-md-2 col-12 p-0">
                                <div class="search-btn button hero-search">
                                    <span class="btn"><i class="lni lni-search-alt "></i> Поиск</span>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>
                    <!-- End Search Form -->
                </div>
            </div>
        </div>
    </div>
</section>
