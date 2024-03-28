<?php
use Illuminate\Http\Client\Request;
function timesince($datetime)
{
    $now = new \DateTime();
    $ago = new \DateTime($datetime);
    $diff = $now->diff($ago);
    $interval = $diff->format('%a');
    if ($interval == 0) {
        return 'Сегодня';
    } elseif ($interval == 1) {
        return 'Вчера';
    } elseif ($interval < 365) {
        return $diff->format('%a дней назад');
    } /*elseif ($interval < 30) {
        return $diff->format('%W недель назад');
    }elseif ($interval < 365) {
        return $diff->format('%M месяцев назад');
    }*/  else {
        return $diff->format('%Y лет назад');
    }
}
function url_parameters($request){
    $lkl = $request->toArray();
    if ($request)
    {
        $result ='?';

        foreach ($lkl as $key=>$value) {
            $result.=$key.'='.$value;
        }

    }
    return $result;
}
