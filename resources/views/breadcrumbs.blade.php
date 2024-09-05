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
                @if (isset($breadcrumbs))
                        @foreach($breadcrumbs['list'] as $key=>$breadcrumb)
                    <li>
                       {{-- @if  ($key!=(count($breadcrumbs['list'])-1))
                            <a href="{{route($breadcrumbs['route'],$breadcrumb->id)}}">{{$breadcrumb->title}}</a>
                        @else
                            {{$breadcrumb->title}}
                        @endif--}}
                        <a href="{{route($breadcrumbs['route'],$breadcrumb->id)}}">{{$breadcrumb->title}}</a>
                    </li>
                        @endforeach
                    <li>@yield('title')</li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
