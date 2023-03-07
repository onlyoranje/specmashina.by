@extends('layouts.dashboard')
@section('title',' Удаление параметра')
@section('main')
    <section class="add-resume section">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-12">
                    <div class="add-resume-inner box">

                        <form class="form-ad" action="{{route('organization_destroy', ['id'=>$organization->id])}}" method="post">
                            @csrf
                            @method('DELETE')


                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-6 col-md-5 col-12">
                                    <div class="button">
                                        <button type="submit" class="btn">Удалить</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
