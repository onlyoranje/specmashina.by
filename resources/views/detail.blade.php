<?php

use App\Models\BbStatistic;
use App\Models\Location;
use App\Models\Bb;use Kudashevs\ShareButtons\ShareButtons;

?>
@section('title', $title)
@section('description', $title.". ".$bb->user->organization->title.". ".$bb->bbprice->price." ".$bb->bbprice->pricetype->type)
@extends('layouts.base')
@section('main')

    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row">
                    <div class="col-12"> <h1 class="title title_card mb-3">{{ $title }}</h1></div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div id="carouselExampleIndicators" class="carousel  /*carousel-dark*/ slide "  data-bs-interval="false">

                                    <div class="carousel-inner main-img" {{--style="height: 480px"--}}>
                                        @foreach($bb->userfile as $key=>$image)
                                            <div class="carousel-item @if ($key==0) active @endif ratio ratio-16x9"
                                            >

                                                <img src="{{ Storage::url($image->resize(null, 800, function ($constraint) { $constraint->aspectRatio();})) }}" class="" alt="{{ $title }}" style="object-fit: contain" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
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

                                    @if (count($bb->userfile)>0)
                                        <div class="images mt-3">
                                            @foreach($bb->userfile as $key=>$image)
                                                <img  src="{{ Storage::url($image->resize(64, 64, function ($constraint) { $constraint->aspectRatio();})) }}" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" id="carousel-thumb-{{$key}}"
                                                      @if ($key==0)
                                                      aria-current="true" class=" carousel-thumbs"
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


                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-images">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">{{ $title }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body row justify-content-center" id="full_gallery">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            @if ($bb->status_bb->status == 'M')
                            <div class="row mb-3">
                                <div class="col-6">
                                    Объявление <mark>на модерации</mark>
                                </div>
                            <div class="col-6 d-grid gap-2 d-md-block">
                                @if (Auth::user()->isAdmin())

                                        <a href="{{route('approve', $bb->id)}}" class="btn btn-primary btn-sm" type="button">Принять</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal">
                                        Отклонить
                                    </button>

                                    <div class="modal fade" id="approveModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form class="default-form-style" method="POST" enctype="multipart/form-data" action="{{route('reject', $bb->id)}}">
                                                @csrf
                                                @method('PATCH')
                                            <div class="">

                                                    <h5 class="modal-title" id="staticBackdropLabel">Причины отклонения</h5>


                                                <div class="row">

                                                @foreach($reasons as $reason)
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="{{$reason->id}}" name="reasons[]" id="flexCheck{{$reason->id}}">
                                                            <label class="form-check-label" for="flexCheck{{$reason->id}}">
                                                                {{$reason->reason}}
                                                            </label>
                                                        </div>

                                                    </div>
                                                    @endforeach
                                                    <div class="col-12">
                                                        <div class="form-group mt-30">

                                                            <textarea name="comment" placeholder="Комментарий"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="">
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                                    <button class="btn btn-danger btn-sm" type="submit">Отклонить</button>
                                                </div>

                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                        {{--<a href="{{route('reject', $bb->id)}}" class="btn btn-danger btn-sm" type="button">Отклонить</a>--}}


                                @endif
                            </div>
                            </div>

                                @elseif ($bb->status_bb->status == 'N')
                                <span>Объявление <mark class="mark-N">не прошло модерацию</mark></span>
                            @endif


                            <p class="location"><i class="fa-solid fa-eye"></i><a id="bb_id">{{$bb->count_views('text')}} </a></p>
                            <p class="location"><i class="fa-solid fa-location-dot"></i><a href="{{route('location',$bb->location->id)}}">{{$bb->location->title}}, {{$bb->location->parent->title}}</a></p>
                                <p  class="location"><a><i class="fa-solid fa-calendar-days"></i>{{$bb->time_update()}}</a></p>
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
                                        <a href="tel:{{$contact_info['phone']}}" class="call">
                                            <i class="lni lni-phone-set"></i>
                                            {{$contact_info['phone']}}
                                            <span>{{$contact_info['user_name']}}</span>
                                        </a>
                                    </li>

                                    {{$bb->like('mail')}}
                                </ul>
                            </div>
                            <div class="social-share">
                                <h4>Отправить ссылку</h4>

                                {!!
                                (new Kudashevs\ShareButtons\ShareButtons)->page(URL::current(), $title, [
                                    'block_prefix' => '<ul>',
                                    'block_suffix' => '</ul>',
                                    'element_prefix' => '<li>',
                                    'element_suffix' => '</li>',

                                    'title' => $title,
                                    'rel' => 'nofollow noopener noreferrer',
                                ])
                                    ->copylink()
                                    ->telegram()
                                    ->vkontakte()
                                    ->whatsapp()

                                    ->facebook()

                                    ->render()!!}
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
                            {!!  nl2br(e($bb->content))!!}
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
                                                <div class="p-2 bd-highlight">{{$parameter->parameters->name}}{{ $parameter->parameters->measure ? ", ".$parameter->parameters->measure:""}}:</div>
                                                <div class="ms-auto p-2 bd-highlight">{{$parameter->value}}</div>
                                            </div>
                                    @endforeach

                                </div>
                            <!-- End Single Comment -->
                        </div>
                        @endif
                        <!-- End Single Block -->
                        @php


                            $bbs_near=App\Models\Bb::select('bbs.*')->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->where('rubric_id', $bb->rubric_id)->whereNot('bbs.id', $bb->id)->get();
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


                            $bbs_location= App\Models\Bb::select('bbs.*')->whereNot('bbs.id', $bb->id)->join('status_bbs','bbs.status_bb_id','=','status_bbs.id')->where('status_bbs.active','Y')->where('location_id',$bb->location_id)->orderBy('bbs.created_at','desc')->limit(3)->get();


                        @endphp


                        @if (isset($bbs_location) and count($bbs_location)>0)
                       <div class="single-block comment-form">

                            <h3>Еще техника в {{$bb->location->title_r}}</h3>
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

                                    <a href="{{route('organization',$bb->organization_id)}}">
                                        <div class="company-image">
                                            @if ($bb->user->organization->logo)
                                                <img src="{{Storage::url($bb->user->organization->logo)}}" alt="{{$bb->user->organization->title}}">
                                            @else
                                                {!! Avatar::create($bb->user->organization->title)->toSvg() !!}
                                            @endif
                                        </div>
<div style="
    margin-left: 64px;
">
    <h4>{{$bb->user->organization->title}}</h4>
                                    <span>{{$bb->user->organization->location->title}}@if ($bb->user->organization->address), {{$bb->user->organization->address}} @endif</span>
                                    <a href="{{route('organization',$bb->organization_id)}}" class="see-all">Все объявления организации</a>
</div>

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
<script>
    window.addEventListener("load", function(){

        var myModalEl = document.getElementById('staticBackdrop')
        myModalEl.addEventListener('show.bs.modal', function (event) {
            var images = '@foreach($bb->userfile as $key=>$image)<div class="col-12"><img src="{{ Storage::url($image->url) }}" class="img-fluid modal-image" alt="{{ $title }}" ></div>@endforeach';

            $('#full_gallery').html(images);

        })
    })
</script>



@endsection('main')
