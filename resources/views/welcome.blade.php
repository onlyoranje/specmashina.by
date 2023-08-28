@extends('layouts.base')
@section('title', 'Главная')
@section('main')


    <section class="section-header pb-9 pb-lg-10 mb-4 mb-lg-6 bg-primary ">
        <div class="container">@foreach ($rubrics as $rubric)
            <div class="row justify-content-between align-items-center">
                <div class="col-12 mb-4">
                    <div class="card bg-white shadow border-gray-300">
                        <div class="card-body p-4 p-lg-5">
                            <div class="row">
                                <h3 class="mb-3">{{$rubric->title}}</h3>
                                @foreach($rubric->children as $child)
                                <div class="col-2 col-md-4 mb-4 mb-lg-0">

                                    <p class="text-gray mb-4"><a href="{{route('rubric',['rubric'=>$child->id])}}">{{$child->title}}</a></p>

                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            @endforeach
        </div>
    </section>

    <div class="section section-lg py-5">
        <div class="container">
            <div class="row">



            </div>

            @if (count($bbs) > 0)

                <div class="row justify-content-between">
                    <div class="col-12 col-sm-6 col-lg-3 mb-5">
                        <div class="card shadow"><img src="../../assets/img/shop/item-1.png" alt="apple watch">
                            <div class="card-footer bg-gray-200 border-top border-gray-300 p-4"><a href="#" class="h5">Apple
                                    watch</a>
                                <div class="mt-2">$299.00</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-lg-3 mb-5">
                        <div class="card shadow"><img src="../../assets/img/shop/item-1.png" alt="watch large">
                            <div class="card-footer bg-gray-200 border-top border-gray-300 p-4"><a href="#" class="h5">Apple
                                    watch</a>
                                <div class="d-flex mt-2"><span class="badge bg-primary me-2">apple</span> <span
                                        class="badge bg-primary me-2">watch</span> <span
                                        class="badge bg-primary">white</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mt-3"><span
                                        class="h6 mb-0 text-gray">$299.00</span> <a class="btn btn-xs btn-tertiary"
                                                                                    href="#"><span
                                            class="fas fa-cart-plus me-2"></span> Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-lg-4 mb-5">
                        <div class="card shadow"><img src="../../assets/img/shop/item-1.png" alt="black watch">
                            <div class="card-footer border-top border-gray-300 p-4"><a href="#" class="h5">Apple Watch
                                    Series
                                    3</a>
                                <h3 class="h6 fw-light text-gray mt-2">Space Gray Aluminum Case with Black Sport
                                    Band</h3>
                                <div class="d-flex mt-3"><span class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning"></span> <span
                                        class="badge bg-primary ms-2">4.7</span></div>
                                <div class="d-flex justify-content-between align-items-center mt-3"><span
                                        class="h5 mb-0 text-gray">$299.00</span> <a class="btn btn-xs btn-tertiary"
                                                                                    href="#"><span
                                            class="fas fa-cart-plus me-2"></span> Add to cart</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 col-lg-4 mb-5">
                        <div class="card shadow">
                            <div class="card-header bg-gray-200 border-0"><img src="../../assets/img/shop/item-2.png"
                                                                               alt="Beats speakers"></div>
                            <div class="card-body border-top border-gray-300"><a href="#" class="h5">Beats Pill</a>
                                <h3 class="h6 fw-light text-gray mt-2">Black Beats Pill + Portable Speaker</h3>
                                <div class="d-flex mt-3"><span class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning me-1"></span> <span
                                        class="star fas fa-star text-warning"></span> <span
                                        class="badge badge-pill badge-gray ms-2">4.7</span></div>
                            </div>
                            <div class="card-footer bg-gray-200 border-top border-gray-300 p-4">
                                <div class="d-flex align-items-center"><span
                                        class="h5 mb-0 text-gray text-through me-2">$299.00 </span><span
                                        class="h6 mb-0 text-danger">$199.00</span>
                                    <div class="ms-auto">
                                        <button class="btn btn-icon-only btn-tertiary px-1" type="button"
                                                aria-label="add to cart button" title="add to cart button"><span
                                                aria-hidden="true" class="fas fa-cart-plus"></span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-8">
                        <div class="card shadow p-4">
                            <div class="row align-items-center">
                                <aside class="col-md-3"><a href="#"><img src="../../assets/img/shop/item-1.png"
                                                                         alt="premium watch"></a></aside>
                                <div class="col-md-6">
                                    <div class="info-main"><a href="#" class="h5 title">Apple Watch Series 3</a>
                                        <div class="d-flex my-3"><span
                                                class="star fas fa-star text-warning me-1"></span> <span
                                                class="star fas fa-star text-warning me-1"></span> <span
                                                class="star fas fa-star text-warning me-1"></span> <span
                                                class="star fas fa-star text-warning me-1"></span> <span
                                                class="star fas fa-star text-warning"></span> <span
                                                class="badge badge-pill badge-gray ms-2">4.7</span> <span
                                                class="small text-success ms-3"><span
                                                    class="fas fa-shopping-cart me-1"></span>150 orders</span>
                                        </div>
                                        <p>Monitor your health. Track your workouts. Get the motivation you need to
                                            achieve your
                                            fitness goals. And stay connected to the people and information you care
                                            about.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="d-flex align-items-center"><span
                                            class="h5 mb-0 text-gray text-through me-2">$299.00 </span><span
                                            class="h6 mb-0 text-danger">$199.00</span></div>
                                    <span class="text-success small"><span class="fas fa-shipping-fast me-1"></span>Free shipping</span>
                                    <div class="d-grid gap-2 mt-4"><a class="btn btn-tertiary btn-sm"
                                                                      href="#">Details </a><a
                                            href="#" class="btn btn-tertiary btn-sm"><span
                                                class="fa fa-heart me-1"></span>
                                            Wishlist</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>


    <table class="table table-striped">
        <tbody>
        @foreach ($bbs as $bb)
            <tr>
                <td><h3>{{ $bb->title }}</h3></td>
                <td>{{ $bb->price }}</td>
                <td>
                    <a href="/{{ $bb->id }}">Подробнее...11</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @endif
@endsection('main')
