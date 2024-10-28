@extends('layouts.dashboard')
@section('title',' Удаление параметра')
@section('main')

@php
$title= "Удалить организацию ".$organization->title;
$id = $organization->id;
$route = 'organization_destroy';
$used = App\Models\Bb::Where('organization_id',$organization->id)->pluck('id')->toArray();
$errors_form=[];
        if (count($used)>0) $errors_form[] = "Данная организация используется в ".count($used)." объявлениях  ";
@endphp
@include('layouts.delete_form')
{{--
    <section class="dashboard section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 col-12">
                    <!-- Start Dashboard Sidebar -->
                @include('layouts.dashboard_profile')
                <!-- Start Dashboard Sidebar -->
                </div>
                <div class="col-lg-9 col-md-12 col-12">
                    <div class="main-content">
                        <!-- Start Profile Settings Area -->
                        <div class="dashboard-block mt-0 profile-settings-block">
                            <h3 class="block-title">Удвлить организацию "{{$organization->title}}"</h3>
                            <div class="inner-block">

                                <form class="form-ad" action="{{route('organization_destroy', ['id'=>$organization->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="row">

                                        <div class="col-6">
                                            <div class="form-group button mb-0">
                                                <button type="submit" class="btn">Удалить</button>
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
        </div>
    </section>
--}}



@endsection
