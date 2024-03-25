<section class="categories">
    <div class="container">
        <div class="cat-inner">
            <div class="row">
                <div class="col-12 p-0">
                    <div class="tns-outer" id="tns1-ow">
                        <div class="tns-controls" aria-label="Carousel Navigation" tabindex="0">
                            <button type="button" data-controls="prev" tabindex="-1" aria-controls="tns1">
                                <i class="lni lni-chevron-left"></i>
                            </button>
                            <button type="button" data-controls="next" tabindex="-1" aria-controls="tns1">
                                <i class="lni lni-chevron-right"></i>
                            </button>
                        </div>
                        <div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide
                            <span class="current">10 to 15</span> of 13
                        </div>
                        <div id="tns1-mw" class="tns-ovh">
                            <div class="tns-inner" id="tns1-iw">
                                <div
                                    class="category-slider  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal"
                                    id="tns1"
                                    style="">
                                    @foreach ($rubrics_slider as $rubric)
                                    <a
                                        href="category.html" class="single-cat tns-item tns-slide-cloned"
                                        aria-hidden="true" tabindex="-1">
                                        <div class="icon">
                                            <img src="storage/images/categories/jobs.svg" alt="{{$rubric->title}}">
                                        </div>
                                        <h3>{{$rubric->title}}</h3>
                                        <h5 class="total">44</h5>
                                    </a>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
