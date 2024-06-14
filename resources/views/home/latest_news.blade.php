@php(
    $posts=App\Models\Post::where('active','Y')->limit(3)->orderby('created_at','desc')->get()
);
@if (count($posts)>0)
<div class="latest-news-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2 class="wow fadeInUp" data-wow-delay=".4s" style="visibility: visible; animation-delay: 0.4s; animation-name: fadeInUp;">Последние новости</h2>
                    <p class="wow fadeInUp" data-wow-delay=".6s" style="visibility: visible; animation-delay: 0.6s; animation-name: fadeInUp;">There are many variations of passages of Lorem
                        Ipsum available, but the majority have suffered alteration in some form.</p>
                </div>
            </div>
        </div>
        <div class="row">
@foreach ($posts as $post)

            <div class="col-lg-4 col-md-6 col-12">
                <!-- Single News -->
                <div class="single-news wow fadeInUp" data-wow-delay=".3s" style="visibility: visible; animation-delay: 0.3s; animation-name: fadeInUp;">
                    <div class="image">
                        <a href="{{route('post',$post->id)}}">
                            @if (isset($post->image))
                                <img class="thumb" src="{{Storage::url($post->resizeImage($post->image,640,480))}}" alt="{{ $post->title }}">
                            @else
                                <img src="http://placehold.it/640x480&text={{ $post->title }}" alt="{{ $post->title }}">

                            @endif
                        </a>
                    </div>
                    <div class="content-body">
                        <h4 class="title"><a href="{{route('post',$post->id)}}">{{$post->title}}</a></h4>
                        <p>{{$post->preview_text}} </p>
                        <div class="meta-details">
                            <ul>
                                <li><a href="javascript:void(0)">{{date('d.m.Y',strtotime($post->created_at))}}</a></li>
                                <li><a href="javascript:void(0)">{{$post->category}}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Single News -->
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
