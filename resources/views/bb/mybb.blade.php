@extends('layouts.dashboard')

@section('title', 'Главная')

@section('main')
    @include('dashboard_nav')


    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')

                <div class="col-12 col-lg-8">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-grid"><a href="{{route('addForm')}}"
                                                   class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                            class="fas fa-plus"></span></span>Submit New Item</a></div>
                        </div>
                        @if (count($bbs) > 0)
                            @foreach ($bbs as $bb)
                        <div class="col-12 col-md-6 col-lg-12">
                            <div class="card border-gray-300 mb-4">
                                <div class="row g-0 align-items-center">
                                    <div class="col-12 col-lg-6 col-xl-4"><a href="#"><img
                                                src="{{Storage::url($bb->userfile[0]->resize(600, 400))}}" alt="{{ $bb->title }}"
                                                class="card-img p-2 rounded-xl"></a></div>
                                    <div class="col-12 col-lg-6 col-xl-8">
                                        <div class="card-body py-lg-0">
                                            <div class="d-flex g-0 align-items-center mb-2">
                                                <div class="col text-left">
                                                    <ul class="list-group mb-0">
                                                        <li class="list-group-item border-0 small p-0"><span
                                                                class="fas fa-medal text-tertiary me-2"></span>Изменено: {{$bb->created_at->format('d F, Y год. Время: H:i')}}
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col text-right">
                                                    <div class="btn-group">
                                                        <button
                                                            class="btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><span class="icon icon-sm"><span
                                                                    class="fas fa-ellipsis-h icon-secondary"></span> </span><span
                                                                class="sr-only">Toggle Dropdown</span></button>
                                                        <div class="dropdown-menu py-0"><a
                                                                class="dropdown-item rounded-top"
                                                                href="{{route('bb_edit', ['bb'=>$bb->id]) }}"><span
                                                                    class="fas fa-edit me-2"></span>Edit Item</a> <a
                                                                class="dropdown-item"><span
                                                                    class="fas fa-chart-line me-2"></span>Statistics</a>
                                                            <a class="dropdown-item text-danger rounded-bottom"
                                                               href="{{route('bb_delete', ['bb'=>$bb->id]) }}"><span class="fa fa-trash me-2"
                                                                              aria-hidden="true"></span>Disable</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="{{route('bb', ['bb'=>$bb->id]) }}"><h2 class="h5">{{ $bb->title }}</h2></a>
                                            <div class="col d-flex ps-0"><span
                                                    class="text-success font-small me-3"><span
                                                        class="fas fa-check-circle me-2"></span>Active</span> <span
                                                    class="text-muted font-small me-3"><span
                                                        class="fas fa-eye me-2"></span>680</span> <span
                                                    class="text-muted font-small me-3"><span
                                                        class="far fa-heart me-2"></span>10</span> <a
                                                    class="font-small text-dark" href="./messages.html"><span
                                                        class="fas fa-envelope me-2"></span>8</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
            </div>
        </div>
    </div>













@endsection
