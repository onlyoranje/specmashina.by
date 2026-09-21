<?php

namespace App\Models;
use App\Models\Bb;


// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Maize\Markable\Markable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use Markable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'realname',
        'phone',
        'avatar',
        'password',
        'google_id',
        'is_admin',
        'active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function bbs() {
        return $this->hasMany(Bb::class);
    }
    public function organization(){
        return $this->hasOne(Organization::class);
    }
    public function credit(){
        return $this->hasOne(User_credit::class);
    }
    public function credits_log(){
        return $this->hasMany(Credits_log::class);
    }
    public function notifications(){
        return $this->hasMany(Notification::class);
    }
    public function isAdmin()
    {
        return $this->is_admin === 1;
    }
    public function addCredits($credits=0){
        $user_credits = User_credit::firstOrCreate(['user_id' => $this->id]);
        $new_credits=$user_credits->credits+$credits;
        if ($credits>=0) $action = 'Пополнение ';
        if ($credits<0) $action = 'Списание ';
        Credits_log::create(['user_id'=>$this->id,'credits'=>$credits,'description'=>$action.' '.$credits.' кр.  ']);
        $user_credits->fill(['credits'=>$new_credits]);
        $user_credits->save();

    }
    public function resizeImage($url,$w,$h)
    {
        $filePath = Storage::path('/public/').$url;
        if (!file_exists($filePath)) {
            return 'images/placeholder/no-image.svg';
        }
        $size = getimagesize($filePath);
        $w_orig = $size[0];
        $h_orig = $size[1];
        $pr = $w_orig/$h_orig;
        if (!$w and $h){
            $w = ceil($h*$pr);
        }
        if ($w and !$h){
            $h = ceil($w/$pr);
        }

        if (!file_exists(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$url)){
            if (!extension_loaded('gd')) {
                return $url;
            }
            $save_path= Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0755, true);
            }
            try {
                ImageManager::gd()
                    ->read($filePath)
                    ->cover($w, $h)
                    ->save(Storage::path('/public/').'thumbnails/'.$w.'x'.$h.'/'.$url);
            } catch (\Throwable $e) {
                return $url;
            }
        }
        return 'thumbnails/'.$w.'x'.$h.'/'.$url;
    }
    public function countAlerts(){
        $alerts = BbAdminComments::select('bb_admin_comments.*')->Join('bbs','bbs.id','=','bb_admin_comments.bb_id')->where('bbs.user_id',$this->id)->whereNull('bb_admin_comments.read_at')->count();
        return $alerts;
    }
    public function sendEmail($body,$subject="Уведомление от landi.by",$from=false){
        if (!$from) $from='info@landi.by';
        $to_name = $this->realname;
        $to_email = $this->email;
        $data = array('name'=>$to_name, "body" => $body);
        Mail::send('emails', $data, function($message) use ($to_name, $to_email,$subject,$from) {

            $message->to($to_email, $to_name)->subject($subject);
            $message->from($from,'Landi.by');
        });

    }
}
