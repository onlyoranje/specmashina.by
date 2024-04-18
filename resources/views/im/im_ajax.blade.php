@if (isset($messages))
    @foreach($messages as $key=>$message)
        <div class="chat-list show" id="{{$key}}">
            <ul class="single-chat-head">
                @foreach($message['message'] as $msg)
                    @if ($msg['user1_id'] ==Auth::id())
                        <li class="right msg" id="msg{{$msg->id}}">
                            @if ($message['user1']->avatar)
                                <img src="{{Storage::url($message['user1']->resizeImage($message['user1']->avatar,150, 150))}}" alt="#">
                    @else
                        {!! Avatar::create($message['user1']->realname)->toSvg() !!}
                    @endif
                    @else
                        <li class="left msg {{$msg->read_at?'':'unrd'}}" id="msg{{$msg->id}}">
                            @if ($message['user2']->avatar)
                                <img src="{{Storage::url($message['user2']->resizeImage($message['user2']->avatar,150, 150))}}" alt="#">
                            @else
                                <img src="{!! Avatar::create($message['user2']->realname)->toGravatar() !!}" alt="#">
                            @endif
                            @endif


                            <p class="text {{$msg->read_at?'':'unread'}}">{!! html_entity_decode($msg->text) !!}
                                <span class="time">{{ \Carbon\Carbon::parse($msg->created_at)->format('H:i:s d.m.Y') }} msg{{$msg->id}}</span>
                            </p>
                        </li>

                        @endforeach
            </ul>
            <div class="reply-block">
                <ul class="add-media-list">
                    <li><a href="javascript:void(0)"><i class="lni lni-link"></i></a></li>
                    <li><a href="javascript:void(0)"><i class="lni lni-image"></i></a></li>
                </ul>
                <input name="reply" id="reply_{{$key}}" type="text" placeholder="...">
                <input type="hidden" id="user2_{{$key}}" value="{{$message['user2']->id}}">
                <button class="reply-btn"><img src={{asset("images/messages/send.svg")}} alt="#" onclick="createMsg('{{$key}}')"></button>
            </div>
        </div>

    @endforeach
@endif
<script>
    $('.username-title').text('{{$message['user2']->realname}}')
</script>
