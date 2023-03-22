@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')

    <div class="section section-lg pt-5 pt-md-7 bg-gray-200">
        <div class="container">
            <div class="row pt-5 pt-md-0">
                @include('layouts.dashboard_profile')
                <div class="col-12 col-lg-8">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="d-grid"><a href="{{route('location_dashboard_add')}}"
                                                   class="btn btn-outline-secondary mb-4 py-3"><span class="me-2"><span
                                            class="fas fa-plus"></span></span>Добавить Регион/Город</a></div>
                        </div>

                        @if (count($locations)>0)
                            <?
                            $traverse = function ($locations, $prefix = '-') use (&$traverse) {
                                foreach ($locations as $location) {

                                    echo "
                                    <div>
                                    <a href='".route('location_dashboard_edit' , ['location'=>$location->id]) ."'>".PHP_EOL.$prefix.' '.$location->title."</a>
</div>
<div class=\"btn-group\"><button class=\"btn btn-link text-dark dropdown-toggle dropdown-toggle-split m-0 p-0\" data-bs-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\"><span class=\"icon icon-sm\"><span class=\"fas fa-ellipsis-h icon-secondary\"></span> </span><span class=\"sr-only\">Toggle Dropdown</span></button><div class=\"dropdown-menu py-0\"><a class=\"dropdown-item text-success rounded-top\" href=\"#\"><span class=\"fas fa-plus me-2\" aria-hidden=\"true\"></span> Publish</a> <a class=\"dropdown-item\" href=\"./edit-item.html\"><span class=\"fas fa-edit me-2\"></span>Edit Item</a> <a class=\"dropdown-item rounded-bottom\"><span class=\"fas fa-chart-line me-2\"></span>Statistics</a></div></div>
<a href='".route('location_dashboard_edit' , ['location'=>$location->id]) ."'>Редактировать </a>
<a href='".route('location_dashboard_delete', ['location'=>$location->id])."'>Удалить</a><br>";


                                    $traverse($location->children, $prefix.'-');
                                }
                            };

                            $traverse($locations);
                            ?>
                  @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
