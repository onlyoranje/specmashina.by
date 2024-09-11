@if (Request::routeIs('home')==false)
<div class="breadcrumbs">
    <div class="container">
        <div class="row align-items-center">
            {{--<div class="col-lg-6 col-md-6 col-12">
                <div class="breadcrumbs-content">
                    <h1 class="page-title"></h1>
                </div>
            </div>--}}
            <div class="col-12">
                <ul class="breadcrumb-nav">
                    <li>
                        <a href="/">Главная</a>
                    </li>
                @if (isset($breadcrumbs))
                        @foreach($breadcrumbs['list'] as $key=>$breadcrumb)
                            @if (is_object($breadcrumb))
                    <li>
                         <a href="{{route($breadcrumbs['route'],$breadcrumb->id)}}">{{$breadcrumb->title}}</a>
                    </li>
                            @elseif (is_array($breadcrumb))
                           <li>
                         <a href="{{route($breadcrumb['route'])}}">{{$breadcrumb['title']}}</a>
                    </li>
                         @endif
                        @endforeach

                    @endif
                    <li>@yield('title')</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
