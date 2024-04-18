@extends('layouts.dashboard')
@section('title', 'Главная')

@section('main')
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

                        <div class="dashboard-block mt-0 pb-0 all_chats">

                        </div>
                    </div>



                </div>
            </div>
        </div>
        </div>
    </section>

    <script>

        </script>
@php
 use Illuminate\Queue\SerializesModels;
 use Illuminate\Foundation\Events\Dispatchable;
 use Illuminate\Broadcasting\InteractsWithSockets;
 use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
/*
 class MyEvent implements ShouldBroadcast
 {
   use Dispatchable, InteractsWithSockets, SerializesModels;

   public $message;
   public $user;

   public function __construct($message,User $user)
   {
       $this->message = $message;
       $this->user = $user;
   }

   public function broadcastOn()
   {
       return new PrivateChannel('user.'.$this->user->id);
   }

   public function broadcastAs()
   {
       return 'my-event';
   }
 }*/
use App\Events\NewMessageNotification;
use App\Models\Im;
$msg = Im::find(1);
        event(new NewMessageNotification($msg));
@endphp
@endsection

