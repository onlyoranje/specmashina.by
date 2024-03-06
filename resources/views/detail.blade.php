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
                                <h4>Информация</h4>
                                <ul>
                                    <li><span>Производитель:</span> {{ $bb->vendor->name }}</li>
                                    <li><span>Модель:</span> {{ $bb->title }}</li>


                                </ul>
                            </div>
                            <div class="contact-info">
                                @php
                                    $contacts = $bb->bbcontact;



                                foreach($contacts as $contact)
                                    {
                                       $contact_info[$contact->contactType->code] = $contact->value;
                                    }
//print_r($contact_info);

                                @endphp
                                <ul>
                                    <li>
                                        <a href="tel:+002562352589" class="call">
                                            <i class="lni lni-phone-set"></i>
                                            {{$contact_info['phone']}}
                                            <span>{{$contact_info['user_name']}}</span>
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
                            {!!  $bb->content!!}
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                       {{-- <div class="single-block tags">
                            <h3>Tags</h3>
                            <ul>
                                <li><a href="javascript:void(0)">Bike</a></li>
                                <li><a href="javascript:void(0)">Services</a></li>
                                <li><a href="javascript:void(0)">Brand</a></li>
                                <li><a href="javascript:void(0)">Popular</a></li>
                            </ul>
                        </div>--}}
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comments">
                            <h3>Характеристики</h3>
                            <!-- Start Single Comment -->

                                <div class="row">
                                @if (count($bb->BbParameters)>0)
                                    @foreach($bb->BbParameters as $parameter)

                                            <div class="col-6 d-flex bd-highlight">
                                                <div class="p-2 bd-highlight">{{$parameter->parameters->name}}:</div>
                                                <div class="ms-auto p-2 bd-highlight">{{$parameter->value}} {{$parameter->parameters->measure}}</div>
                                            </div>
                                    @endforeach
                                @endif
                                </div>
                            <!-- End Single Comment -->
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                       <div class="single-block comment-form">
                           @php
                               $location = App\Models\Location::where('id',$bb->location_id)->first();
                               $bbs_location=$location->bbs->whereNotIn('id', $bb->id)->random(3);

                           @endphp
                            <h3>Еще техника в {{$location->title_r}}</h3>
                            <form action="#" method="POST">
                                <div class="row">

                                    @foreach($bbs_location as $bb_widget)
                                        @include('bb.minicard')
                                    @endforeach
                                </div>
                            </form>
                        </div>
                        <!-- End Single Block -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">
                            <!-- Start Single Block -->
                            @if ($bb->user->organization)
                            <div class="single-block author">
                                <h3>Организация</h3>
                                <div class="content">
                                    <img src="{{Storage::url($bb->user->organization->logo)}}" alt="{{$bb->user->organization->title}}">
                                    <h4>{{$bb->user->organization->title}}</h4>
                                    <span>{{$bb->user->organization->location->title}}@if ($bb->user->organization->address), {{$bb->user->organization->address}} @endif</span>
                                    <a href="javascript:void(0)" class="see-all">Все объявления организации</a>
                                </div>
                            </div>
                        @endif
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            {{--<div class="single-block contant-seller comment-form ">
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
                            </div>--}}
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            <div class="single-block ">
                                <h3>Location</h3>
                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas" src="https://maps.google.com/maps?q={{$bb->user->organization->address}},%20{{$bb->user->organization->location->title}}&amp;t=&amp;z=13&amp;ie=UTF8&amp;iwloc=&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><br>
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




@endsection('main')
