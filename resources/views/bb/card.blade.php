<div class="col-12">
    <div class="card shadow p-4">
        <div class="row align-items-center">
            <aside class="col-md-3"><a href="#">
                    @if (count($bb->userfile)> 0)
                    <a href="#"></a><img src="{{Storage::url($bb->userfile[0]->resize(320, 320))}}" alt="{{ $bb->title }}"></a>
                @else
                    <a href="#"><img   src="http://placehold.it/300x300&text={{ $bb->title }}" alt="{{ $bb->title }}"></a>
                @endif
            </aside>
            <div class="col-md-6">
                <div class="info-main"><a href="#" class="h5 title">{{$bb->all_rubrics[0]->title}} {{ $bb->vendor->name }} {{ $bb->title }}</a>
                    <div class="d-flex my-3"><span class="star fas fa-star text-warning me-1"></span> <span class="star fas fa-star text-warning me-1"></span> <span class="star fas fa-star text-warning me-1"></span> <span class="star fas fa-star text-warning me-1"></span> <span class="star fas fa-star text-warning"></span> <span class="badge badge-pill badge-gray ms-2">4.7</span> <span class="small text-success ms-3"><span class="fas fa-shopping-cart me-1"></span>150 orders</span>
                    </div>
                    <p>Monitor your health. Track your workouts. Get the motivation you need to
                        achieve your
                        fitness goals. And stay connected to the people and information you care
                        about.</p>
                </div>
            </div>
            <div class="col-12 col-md-3">
                <div class="d-flex align-items-center"><span class="h5 mb-0 text-gray  me-2">{{$bb->bbprice->price}} </span><span class="h6 mb-0 text-danger">{{$bb->bbprice->pricetype->type}}</span></div>
                <span class="text-success small"><span class="fas fa-shipping-fast me-1"></span>Free shipping</span>
                <div class="d-grid gap-2 mt-4"><a class="btn btn-tertiary btn-sm" href="{{route('bb',['bb'=>$bb->id])}}">Подробно</a><a href="#" class="btn btn-tertiary btn-sm"><span class="fa fa-heart me-1"></span>
                        Wishlist</a></div>
            </div>
        </div>
    </div>
</div>
