<?php

use App\Models\BbStatistic;
use App\Models\Location;
use App\Models\Bb;

?>
@section('title', $title)
@extends('layouts.base')
@section('main')

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
                                            <div class="carousel-item @if ($key==0) active @endif ratio ratio-1x1"
                                            >

                                                <img src="{{ Storage::url($image->resize(null, 800, function ($constraint) { $constraint->aspectRatio();})) }}" class="" alt="..." style="position: absolute; top: 50%;left: 50%; margin-right: -50%;transform: translate(-50%, -50%);{{$image->resizeClass()}}">
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

                                    @if (count($bb->userfile)>1)
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
                                    @endif
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
                        @if ($bb->content)
                        <div class="single-block description">
                            <h3>Описание</h3>
                            {!!  $bb->content!!}
                        </div>
                        @endif
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
                        @if (count($bb->BbParameters)>0)
                        <div class="single-block comments">
                            <h3>Характеристики</h3>
                            <!-- Start Single Comment -->

                                <div class="row">

                                    @foreach($bb->BbParameters as $parameter)

                                            <div class="col-6 d-flex bd-highlight">
                                                <div class="p-2 bd-highlight">{{$parameter->parameters->name}}:</div>
                                                <div class="ms-auto p-2 bd-highlight">{{$parameter->value}} {{$parameter->parameters->measure}}</div>
                                            </div>
                                    @endforeach

                                </div>
                            <!-- End Single Comment -->
                        </div>
                        @endif
                        <!-- End Single Block -->
                        @php

                            //$location = App\Models\Location::where('id',$bb->location_id)->first();
                            $bbs_near=App\Models\Bb::where('rubric_id', $bb->rubric_id)->whereNot('id', $bb->id)->get();
                            $lat = $bb->location->lat;
                            $lng = $bb->location->lng;
                            $bbs_near = $bbs_near->sortBy(function($value, $key) use ($lat,$lng){
                                $theta = $lng - $value->location->lng;
                                $distance = (sin(deg2rad($lat)) * sin(deg2rad($value->location->lat))) + (cos(deg2rad($lat)) * cos(deg2rad($value->location->lat)) * cos(deg2rad($theta)));
                                $distance = acos($distance);
                                $distance = rad2deg($distance);
                                $distance = $distance * 60 * 1.1515 * 1.609344;
                                return $distance;

                            });

                        @endphp
                        @if (count($bbs_near)>0)
                            <div class="single-block comment-form">

                                <h3>{{$bb->rubric->title}} рядом</h3>
                                <form action="#" method="POST">
                                    <div class="row">

                                        @foreach($bbs_near->random(count ($bbs_near)>3? 3: count ($bbs_near)) as $bb_widget)
                                            @include('bb.minicard')
                                        @endforeach
                                    </div>
                                </form>
                            </div>
                        @endif
                        <!-- Start Single Block -->
                        @php

                            $location = Location::where('id',$bb->location_id)->first();
                            $bbs_location=$location->bbs->whereNotIn('id', $bb->id);

                        @endphp
                        @if (count($bbs_location)>0)
                       <div class="single-block comment-form">

                            <h3>Еще техника в {{$location->title_r}}</h3>
                            <form action="#" method="POST">
                                <div class="row">

                                    @foreach($bbs_location->random(count ($bbs_location)>3? 3: count ($bbs_location)) as $bb_widget)
                                        @include('bb.minicard')
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    @endif



                        <!-- End Single Block -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">
                            <!-- Start Single Block -->
                            @if ($bb->organization_id)
                            <div class="single-block author">
                                <h3>Организация</h3>
                                <div class="content">
                                    <img src="{{Storage::url($bb->user->organization->logo)}}" alt="{{$bb->user->organization->title}}">
                                    <h4>{{$bb->user->organization->title}}</h4>
                                    <span>{{$bb->user->organization->location->title}}@if ($bb->user->organization->address), {{$bb->user->organization->address}} @endif</span>
                                    <a href="javascript:void(0)" class="see-all">Все объявления организации</a>
                                </div>
                            </div>


                            <div class="single-block ">
                               {{-- <h3>Location</h3>--}}
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
                            @endif
                            <div class="single-block">
                            @include('widgets.banner')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>




@endsection('main')
