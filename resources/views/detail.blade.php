@extends('layouts.base')
@section('title', $bb->title)

@section('main')
    <?php
    $parent_rubrics = App\Models\Rubric::whereAncestorOrSelf($bb->rubric_id)->orderBy('level')->get();
    $parent_rubric = $parent_rubrics[0];
    ?>
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div id="carouselExampleIndicators" class="carousel  /*carousel-dark*/ slide "  data-bs-interval="false">

                                    <div class="carousel-inner main-img" {{--style="height: 480px"--}}>
                                        @foreach($bb->userfile as $key=>$image)
                                            <div class="carousel-item @if ($key==0) active @endif"
                                            >

                                                <img src="{{ Storage::url($image->resize(null, 480, function ($constraint) { $constraint->aspectRatio();})) }}" class="" alt="..." style="margin:auto">
                                            </div>
                                        @endforeach
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>


                                        <div class="images">
                                            @foreach($bb->userfile as $key=>$image)
                                                <img  src="{{ Storage::url($image->resize(110, 110, function ($constraint) { $constraint->aspectRatio();})) }}" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" id="carousel-thumb-{{$key}}"
                                                      @if ($key==0)
                                                      aria-current="true" class="active carousel-thumbs"
                                                      @else
                                                      class="carousel-thumbs"
                                                      @endif
                                                      aria-label="1">
                                            @endforeach
                                        </div>

                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{ $bb->vendor->name }} {{ $bb->title }}</h2>
                            <p class="location"><i class="lni lni-map-marker"></i><a href="javascript:void(0)">{{$bb->location->title}}, {{$bb->location->parent->title}}</a></p>
                            <h3 class="price">{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</h3>
                            <div class="list-info">
                                <h4>Informations</h4>
                                <ul>
                                    <li><span>Condition:</span> New</li>
                                    <li><span>Brand:</span> Apple</li>
                                    <li><span>Model:</span> Mackbook Pro</li>
                                </ul>
                            </div>
                            <div class="contact-info">
                                <ul>
                                    <li>
                                        <a href="tel:+002562352589" class="call">
                                            <i class="lni lni-phone-set"></i>
                                            +00 256 235 2589
                                            <span>Call &amp; Get more info</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="mailto:example@gmail.com" class="mail">
                                            <i class="lni lni-envelope"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="social-share">
                                <h4>Share Ad</h4>
                                <ul>
                                    <li><a href="javascript:void(0)" class="facebook"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)" class="twitter"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)" class="google"><i class="lni lni-google"></i></a></li>
                                    <li><a href="javascript:void(0)" class="linkedin"><i class="lni lni-linkedin-original"></i></a></li>
                                    <li><a href="javascript:void(0)" class="pinterest"><i class="lni lni-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-details-blocks">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12">
                        <!-- Start Single Block -->
                        <div class="single-block description">
                            <h3>Description</h3>
                            <p>
                                There are many variations of passages of Lorem Ipsum available, but the majority have
                                suffered alteration in some form, by injected humour, or randomised words which don't
                                look even slightly believable.
                            </p>
                            <ul>
                                <li>Model: Apple MacBook Pro 13.3-Inch MYDA2</li>
                                <li>Apple M1 chip with 8-core CPU and 8-core GPU</li>
                                <li>8GB RAM</li>
                                <li>256GB SSD</li>
                                <li>13.3-inch 2560x1600 LED-backlit Retina Display</li>
                            </ul>
                            <p>The generated Lorem Ipsum is therefore always free from repetition, injected humour, or
                                non-characteristic words etc.</p>
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block tags">
                            <h3>Tags</h3>
                            <ul>
                                <li><a href="javascript:void(0)">Bike</a></li>
                                <li><a href="javascript:void(0)">Services</a></li>
                                <li><a href="javascript:void(0)">Brand</a></li>
                                <li><a href="javascript:void(0)">Popular</a></li>
                            </ul>
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comments">
                            <h3>Comments</h3>
                            <!-- Start Single Comment -->
                            <div class="single-comment">
                                <img src="assets/images/testimonial/testi2.jpg" alt="#">
                                <div class="content">
                                    <h4>Luis Havens</h4>
                                    <span>25 Feb, 2023</span>
                                    <p>
                                        There are many variations of passages of Lorem Ipsum available, but the majority
                                        have suffered alteration in some form, by injected humour, or randomised words
                                        which don't look even slightly believable.
                                    </p>
                                    <a href="javascript:void(0)" class="reply"><i class="lni lni-reply"></i> Reply</a>
                                </div>
                            </div>
                            <!-- End Single Comment -->
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comment-form">
                            <h3>Post a comment</h3>
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="text" name="name" class="form-control form-control-custom" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="email" name="email" class="form-control form-control-custom" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-box form-group">
                                            <textarea name="#" class="form-control form-control-custom" placeholder="Your Comments"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="button">
                                            <button type="submit" class="btn">Post Comment</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Single Block -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">
                            <!-- Start Single Block -->
                            <div class="single-block author">
                                <h3>Author</h3>
                                <div class="content">
                                    <img src="assets/images/testimonial/testi3.jpg" alt="#">
                                    <h4>Miliya Jessy</h4>
                                    <span>Member Since May 15,2023</span>
                                    <a href="javascript:void(0)" class="see-all">See All Ads</a>
                                </div>
                            </div>
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            <div class="single-block contant-seller comment-form ">
                                <h3>Contact Seller</h3>
                                <form action="#" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <input type="text" name="name" class="form-control form-control-custom" placeholder="Your Name">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <input type="email" name="email" class="form-control form-control-custom" placeholder="Your Email">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <textarea name="#" class="form-control form-control-custom" placeholder="Your Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="button">
                                                <button type="submit" class="btn">Send Message</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            <div class="single-block ">
                                <h3>Location</h3>
                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://putlocker-is.org"></a><br>
                                        <style>
                                            .mapouter {
                                                position: relative;
                                                text-align: right;
                                                height: 300px;
                                                width: 100%;
                                            }
                                        </style><a href="https://www.embedgooglemap.net">google map code for website</a>
                                        <style>
                                            .gmap_canvas {
                                                overflow: hidden;
                                                background: none !important;
                                                height: 300px;
                                                width: 100%;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="section-header pb-10 pb-lg-11 mb-4 mb-lg-6 bg-primary text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center mb-4 mb-lg-5"><h1
                        class="display-2 font-weight-extreme mb-4">{{$parent_rubric->title}} {{$bb->rubric->title_r}} {{ $bb->vendor->name }} {{ $bb->title }}
                    </h1>
                    <div class="d-flex flex-column flex-lg-row justify-content-center"><span
                            class="h5 mb-3 mb-lg-0"><span class="fas fa-map-marker-alt"></span><span
                                class="ms-3">{{$bb->location->title}}</span></span>
                        <span class="ms-lg-5 mb-3 mb-lg-0 h5"><span class="fas fa-user-tie"></span><span class="ms-3">Full Time</span></span>
                        <span class="ms-lg-5 mb-3 mb-lg-0 h5"><span class="fas fa-file-invoice-dollar"></span><span
                                class="ms-3">{{$bb->bbprice->price}} {{$bb->bbprice->pricetype->type}}</span></span>
                    </div>
                </div>

            </div>
        </div>
        <div class="pattern bottom"></div>
    </section>
    <section class="section section-lg pt-0">
        <div class="container mt-n8 mt-lg-n11 z-2">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8">
                    <div class="card border-gray-300 p-3 p-md-5">

                        <div id="carouselExampleIndicators" class="carousel  /*carousel-dark*/ slide "  data-bs-interval="false">

                            <div class="carousel-inner" style="height: 480px">
                                @foreach($bb->userfile as $key=>$image)
                                <div class="carousel-item @if ($key==0) active @endif"
                                    >
                                    <img src="{{ Storage::url($image->resize(null, 480, function ($constraint) { $constraint->aspectRatio();})) }}" class="d-block " alt="..." style="margin:auto">
                                </div>
                                @endforeach
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>

                            <div class="carousel-indicators">
                                <div class="car-thumbs">
                                @foreach($bb->userfile as $key=>$image)
                                    <img  src="{{ Storage::url($image->resize(64, 64, function ($constraint) { $constraint->aspectRatio();})) }}" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" id="carousel-thumb-{{$key}}"
                                          @if ($key==0)
                                          aria-current="true" class="active carousel-thumbs"
                                          @else
                                          class="carousel-thumbs"
                                          @endif
                                          aria-label="1">
                                @endforeach
                                </div>
                            </div>
                        </div>

                        <script>
                           /* $( ".carousel-thumbs" ).on( "click", function() {

                            var marginleft =(parseInt($(this).data('bs-slide-to'))-1)*58;
                            var thumbswidth1 =parseInt($('.carousel-indicators').width());
                            var thumbswidth2 =parseInt($('.car-thumbs').width());
                            if (marginleft<0) marginleft=0;
                            if ((thumbswidth2-marginleft)>thumbswidth1) $('.car-thumbs').css({'transform':'translate3d(-'+marginleft+'px, 0px, 0px)','transition-duration':'500ms'});

                            });*/
                        </script>

                        <p class="lead mb-5"><strong
                                class="font-weight-extreme">Rocket</strong> is currently seeking a Frontend Engineer to
                            join our Digital Team focusing on wines &amp; spirits, beauty and lifestyle brands. In this
                            position you will be responsible for effectively managing multiple accounts and team
                            members, including serving as key client contact. The successful candidate is an established
                            leader viewed as a seasoned professional in the digital + social space; respected by senior
                            clients, with a proven track record that demonstrates team growth by leading, maintaining
                            and winning new business.</p>
                        <p class="lead mb-5">Ideal candidates will have 3+ years of full time experience building social
                            media channels for brands, as well creating digital identity, leading content creation,
                            developing an audience, working on event activations and strategic partnerships.</p>
                        <h2>Responsibilities:</h2>
                        <ul class="list-unstyled mb-5">
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm me-3"><span
                                            class="fas fa-arrow-alt-circle-right"></span></span>
                                    <div>Work with our leadership team to drive strategic planning and prioritization
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm me-3"><span
                                            class="fas fa-arrow-alt-circle-right"></span></span>
                                    <div>Partner with cross-functional teams to drive flawless execution of global
                                        initiatives, including the definition and rollout of our international plan
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm me-3"><span
                                            class="fas fa-arrow-alt-circle-right"></span></span>
                                    <div>Own the end-to-end process: build work plans, synthesize relevant data, lead
                                        analyses and develop recommendations
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <h2>Requirements:</h2>
                        <ul class="list-unstyled mb-5">
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm me-3"><span
                                            class="fas fa-plus-circle"></span></span>
                                    <div>3+ years of related work experience at a high-performing technology company or
                                        management consulting; enterprise experience strongly preferred
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm me-3"><span
                                            class="fas fa-plus-circle"></span></span>
                                    <div>Advanced analytical skills (including data modeling) and business insight</div>
                                </div>
                            </li>
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm me-3"><span
                                            class="fas fa-plus-circle"></span></span>
                                    <div>Experience dealing with unstructured business issues and successfully leading
                                        teams to resolve these issues
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <h2>We offer great benefits too!</h2>
                        <ul class="list-unstyled mb-5">
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm text-success me-3"><span
                                            class="fas fa-check-circle"></span></span>
                                    <div>Generous vacation package that increases with tenure in addition to sick days,
                                        personal days and your birthday off too!
                                    </div>
                                </div>
                            </li>
                            <li class="py-3 lead">
                                <div class="d-flex"><span class="icon icon-sm text-success me-3"><span
                                            class="fas fa-check-circle"></span></span>
                                    <div>Strong company culture and happy work environment!</div>
                                </div>
                            </li>
                        </ul>
                        <div id="apply" class="row">
                            <div class="col">
                                <div class="card bg-gray-200 border-gray-300 text-black py-4 p-lg-5">
                                    <div class="card-body p-3 p-md-4">
                                        <div class="mb-5 mb-lg-6 text-center"><h2 class="h1">Apply for this Job</h2>
                                        </div>
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3"><label for="firstNameLabel">First Name <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group"><span class="input-group-text"
                                                                                       id="basic-addon1"><span
                                                                    class="fas fa-user-alt"></span></span> <input
                                                                type="text" class="form-control" id="firstNameLabel"
                                                                placeholder="First Name" aria-label="name"
                                                                aria-describedby="basic-addon1" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3"><label for="lastNameLabel">Last Name <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group"><span class="input-group-text"
                                                                                       id="basic-addon2"><span
                                                                    class="fas fa-user-alt"></span></span> <input
                                                                type="text" class="form-control" id="lastNameLabel"
                                                                placeholder="Last Name" aria-label="last name"
                                                                aria-describedby="basic-addon2" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3"><label for="EmailLabel">Email <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group"><span class="input-group-text"
                                                                                       id="basic-addon3"><span
                                                                    class="fas fa-envelope"></span></span> <input
                                                                type="text" class="form-control" id="EmailLabel"
                                                                placeholder="Can we get your email?" aria-label="email"
                                                                aria-describedby="basic-addon3" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3"><label for="portfolioLabel">Portfolio <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group"><span class="input-group-text"
                                                                                       id="basic-addon4"><span
                                                                    class="fas fa-link"></span></span> <input
                                                                type="text" class="form-control" id="portfolioLabel"
                                                                placeholder="Linkedin" aria-label="portfolio"
                                                                aria-describedby="basic-addon4" required=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3"><label for="phonenumberLabel">Phone Number <span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group"><span class="input-group-text"
                                                                                       id="basic-addon5"><span
                                                                    class="fas fa-phone-square-alt"></span></span>
                                                            <input type="text" class="form-control"
                                                                   id="phonenumberLabel" placeholder="Phone Number"
                                                                   aria-label="Search" aria-describedby="basic-addon5"
                                                                   required=""></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="mb-3"><label for="formFile" class="form-label">Choose
                                                            File <span class="text-danger">*</span></label> <input
                                                            class="form-control" type="file" id="formFile"></div>
                                                </div>
                                                <div class="col col-12 mt-4">
                                                    <div><label class="form-label text-muted" for="phonenumberLabel">Few
                                                            words... <span class="text-danger">*</span></label>
                                                        <textarea class="form-control"
                                                                  placeholder="How'd you hear about Themesberg?"
                                                                  id="message-2" rows="8" required=""></textarea></div>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-secondary mt-4"><span
                                                                class="me-2"><span
                                                                    class="fas fa-paper-plane"></span></span> Submit
                                                            Application
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4"></div>
            </div>
        </div>
    </section>



    <div class="container">
        <h1 class="my-3 text-center">Объявления</h1>
        <h2>{{ $bb->title }}</h2>
        <h4>{{ $bb->rubric->title }}</h4>
        <h4>{{ $bb->location->title }}</h4>
        <p>Автор: {{  $bb->user->name }}</p>
        <p><?= nl2br($bb->content) ?> </p>
        @foreach($bb->BbParameters as $BbParameter)

            {{$BbParameter->parameters->name}}:{{$BbParameter->value}}
        @endforeach
        @foreach($bb->userfile as $image)
            <img src="{{ Storage::url($image->resize(640, 320)) }}" alt="Иллюстрация">
        @endforeach

        <p>{{ $bb->bbprice->price}} {{ $bb->bbprice->pricetype->type}}</p>


        <p><a href="/">На перечень объявлений</a></p>
    </div>

@endsection('main')
