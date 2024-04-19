
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        @if (isset($user2->avatar))
            <img src="{{Storage::url($user2->resizeImage($user1->avatar,50, 50))}}" alt="#">
        @else
            {!! Avatar::create($user2->realname)->toSvg() !!}
        @endif
        <strong class="me-auto">{{$user2->realname}}</strong>
        <small class="text-muted">just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{$message}}
    </div>
</div>
