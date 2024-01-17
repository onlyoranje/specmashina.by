@extends('layouts.base')
@section('title', 'Главная')
@section('main')

    <section class="section-header bg-primary pb-9 pb-lg-10 text-white">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 text-center"><h1 class="mb-3">Advice and answers from our team</h1>
                    <p class="lead px-lg-5 mb-5">Get account assistance, technical support, or help with any other
                        issues.</p>
                    <form action="#">
                        <div class="form-group bg-white shadow-soft rounded-pill mb-4 px-3 py-2">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="input-group input-group-merge shadow-none">
                                        <div class="input-group-text bg-transparent border-0"><span
                                                class="fas fa-search"></span></div>
                                        <input type="text"
                                               class="form-control border-0 form-control-flush shadow-none pb-2"
                                               placeholder="Search for answers..." required=""></div>
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-block btn-primary rounded-pill">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="pattern bottom"></div>
    </section>


    <div class="section section-lg py-5">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                <div class="col-lg-9 col-md-8 col-12">
                    <div class="row justify-content-center">
                        @if (count($bbs) > 0)
                            @foreach ($bbs as $bb)
                              @include('bb.card')
                            @endforeach
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center mt-4 mt-lg-5">
                                    <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-12">
                    @if(Auth::user())
                    @include('layouts.dashboard_profile')
                    @endif
                </div>


            </div>




        </div>
    </div>



@endsection('main')
