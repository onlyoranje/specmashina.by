<?php
use Illuminate\Http\Client\Request;
function timesince($datetime)
{
    $targetTime = strtotime($datetime);
    $currentTime = strtotime("now");
    $interval =  $currentTime-$targetTime;
    switch ($interval){
        //секунды
        case($interval<60 and substr($interval,-1)==1 and $interval!==11):return $interval." секунду назад";
        case($interval<60 and substr($interval,-1)<4 and substr($interval,-1)>1):return $interval." секунды назад";
        case($interval<60): return $interval." секунд назад";
        // минуты
        case($interval<60*60 and substr(floor($interval/60),-1)==1 and floor($interval/60)!==11):return floor($interval/60)." минуту назад";
        case($interval<60*60 and substr(floor($interval/60),-1)<4 and substr($interval/60,-1)>1):return floor($interval/60)." минуты назад";
        case($interval<60*60 and $interval>59): return floor($interval/60)." минут назад";
        //часы
        case($interval<60*60*24 and substr(floor($interval/(60*60)),-1)==1 and floor($interval/(60*60))!==11):return floor($interval/(60*60))." час назад";
        case($interval<60*60*24 and substr(floor($interval/(60*60)),-1)<4 and substr(floor($interval/(60*60)),-1)>1):return floor($interval/(60*60))." часа назад";
        case($interval<60*60*24 and $interval>=60*60): return floor($interval/(60*60))." часов назад";
        // дни
        case($interval<60*60*24*30 and substr(floor($interval/(60*60*24)),-1)==1 and floor($interval/(60*60*24))!==11):return floor($interval/(60*60*24))." день назад";
        case($interval<60*60*24*30 and substr(floor($interval/(60*60*24)),-1)<4 and substr(floor($interval/(60*60*24)),-1)>1):return floor($interval/(60*60*24))." дня назад";
        case($interval<60*60*24*30 and $interval>=60*60*24): return floor($interval/(60*60*24))." дней назад";
        //Месяцы
        case($interval<60*60*24*30*12 and substr(floor($interval/(60*60*24*30)),-1)==1 and floor($interval/(60*60*24*30))!==11):return floor($interval/(60*60*24*30))." месяц назад";
        case($interval<60*60*24*30*12 and substr(floor($interval/(60*60*24*30)),-1)<4 and substr(floor($interval/(60*60*24*30)),-1)>1):return floor($interval/(60*60*24*30))." месяца назад";
        case($interval<60*60*24*30*12 and $interval>=60*60*24*30): return floor($interval/(60*60*24*30))." месяцев назад";
        //годы
        case(substr(floor($interval/(60*60*24*30*12)),-1)==1 and floor($interval/(60*60*24*30*12))!==11):return floor($interval/(60*60*24*30*12))." год назад";
        case(substr(floor($interval/(60*60*24*30*12)),-1)<4 and substr(floor($interval/(60*60*24*30*12)),-1)>1):return floor($interval/(60*60*24*30*12))." года назад";
        case($interval>=60*60*24*30*12): return floor($interval/(60*60*24*30*12))." лет назад";
        //default: return $interval." секунд назад";




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
function FakeImage($width=640,$height=480,$blur=0,$grayscale=0,$title='Аренда и продажа техники в Беларуси',$img='image.jpg'){
 $image = '<img src="/storage/test/'.$img.'" alt="'.$title.'" style="filter: blur('.$blur.'px)  grayscale('.$grayscale.'%); -o-object-fit:cover; object-fit:cover;">';
 return $image;
}
function get_dir_files( $dir, $recursive = true, $include_folders = false ){
    if( ! is_dir($dir) )
        return array();

    $files = array();

    $dir = rtrim( $dir, '/\\' ); // удалим слэш на конце

    foreach( glob( "$dir/{,.}[!.,!..]*", GLOB_BRACE ) as $file ){

        if( is_dir( $file ) ){
            if( $include_folders )
                $files[] = $file;
            if( $recursive )
                $files = array_merge( $files, call_user_func( __FUNCTION__, $file, $recursive, $include_folders ) );
        }
        else
            $files[] = $file;
    }

    return $files;
}
