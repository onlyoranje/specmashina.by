
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="99999999999999">
    <div class="toast-header">
        @if (isset($user1->avatar))
            <img src="{{Storage::url($user1->resizeImage($user1->avatar,50, 50))}}" alt="#">
        @else
            {!! Avatar::create($user1->realname)->toSvg() !!}
        @endif
        <strong class="me-auto">{{$user1->realname}}</strong>
        <small class="text-muted">just now</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {!! html_entity_decode($message) !!}
    </div>
</div>
