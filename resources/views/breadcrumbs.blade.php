@if (Request::routeIs('home')==false)
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title">@yield('title')</h1>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12">
                <ul class="breadcrumb-nav">

                        @foreach($breadcrumbs as $key=>$breadcrumb)
                    <li>
                        @if  ($key!=(count($breadcrumbs)-1))
                            <a href="{{route('rubric',$breadcrumb->id)}}">{{$breadcrumb->title}}</a>
                        @else
                            {{$breadcrumb->title}}
                        @endif
                    </li>
                        @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
@endif
