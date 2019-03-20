<?php
namespace App;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Img;
use App\Models\Files;

class Helper{
    
    static function media($path){
        if (is_null($path)) {
            return asset('static/img/no_img.jpg');
        }
        if (strpos($path, '//') > -1) {
            return $path;
        }else{
            return env('FTP_URL').$path;
        }
    }

    static function get_str($string, $find_start, $find_end) {
        $start = $find_start == ''? 0: stripos($string, $find_start);

        if($start === false) return false;

        $length = strlen($find_start);

        $end = stripos(substr($string, $start+$length), $find_end);

        if($end !== false) {
            $rs = substr($string, $start+$length, $end);
        } else {
            $rs = substr($string, $start+$length);
        }

        return $rs ? $rs : false;
    }

    static function numberToString($num){
        $str = $num.'';
        $ex = '';
        if (strlen($str) > 9) {
            $num = $num/1000000000;
            $ex = 'b';
        }elseif(strlen($str) > 6){
            $num = $num/1000000;
            $ex = 'm';
        }elseif (strlen($str) > 3) {
            $num = $num/1000;
            $ex = 'k';
        }
        if (strlen($ex)) {
            $str = number_format($num, 2);
            $str .= $ex;
        }
        return $str;
    }

    static function route_decode($string, $code, $length = 50){
        if (strlen($string) >= $length) {
            $string = substr($string, 0, $length);
        }
        $string = str_slug($string);
        if (strlen($string) == 0) {
            $string = config('config.domain.name');
        }

        $string .= '-p-'.$code;
        return route('post', $string);
    }

    static function caption_decode($string, $length = 100){
        if (strlen($string) >= $length) {
            $string = substr($string, 0, strpos($string, ' ', $length - 1));
        }
        return Helper::content_decode($string);
    }

    static function content_decode($string){
        $pos = 0;
        $position = [];
        while ($pos < strlen($string)) {
            if (strpos($string, '@', $pos) > -1 && strpos($string, '@', $pos) == $pos){
                $position[$pos] = '@';
            }elseif (strpos($string, '#', $pos) > -1 && strpos($string, '#', $pos) == $pos){
                $position[$pos] = '#';
            }
            $pos++;
        }
        if (!empty($position)) {
            $points = array_keys($position);
            rsort($points);
            foreach ($points as $i => $pos) {
                if ($i > 0) {
                    $value = substr($string, $pos, $points[$i-1] - $pos);
                }else{
                    $value = substr($string, $pos);
                }
                $text = trim(preg_replace('~[^\p{M}\w\.]+~u', ' ', $value));
                $tag = Helper::get_str($text, '', ' ');
                if (strlen($tag)) {
                    $link = $position[$pos] == '@'? '<a href="'.route('user', $tag).'">@'.$tag.'</a>': '<a href="'.route('tag', $tag).'">#'.$tag.'</a>';
                    $string = substr_replace($string, $link, $pos, strlen($position[$pos].$tag));
                }
            }
        }
        return $string;
    }

    static function time($time){
        $dt = \Carbon\Carbon::createFromTimestamp($time);
        return $dt->diffForHumans();
    }

    static function upload($file = false, $dir = '', $filename){
        $result = false;
        $extension = $file->getClientOriginalExtension();
        $filename .= ".{$extension}";
        $path = "{$dir}/{$filename}";
        try {
            if (strlen(config('filesystems.disks.ftp.host'))) {
                if ($file->storeAs($dir, $filename, 'ftp')) {
                    $result = strlen(config('filesystems.disks.ftp.root'))? "/".config('filesystems.disks.ftp.root')."/{$path}": "/{$path}";
                }               
            }else{
                $uploadDir = 'storage/'.$dir;
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $file->move($uploadDir, $filename);
                $result = "/{$uploadDir}/".$filename;
            }
        } catch (\Exception $e) {
            
        }

        return $result;
    }

    static function upload_url($url, $dir, $filename){
        try {
            $contents = file_get_contents($url);
            $path = "{$dir}/{$filename}.jpg";
            if (strlen(config('filesystems.disks.ftp.host'))) {
                $storage = Storage::disk('ftp');
                $storage->put($path, $contents);
                return '/'.$path;
            }else{
                $storage = Storage::disk('local');
                $path = 'storage/'.$path;
                $storage->put($path, $contents);
                return '/'.$path;
            }
        } catch (\Exception $e) {
            return false;
        }
    }
    
    static function upload_image($file = false, $dir, $filename){
        $extension = $file->getClientOriginalExtension();
        $allowedExtensions = array('jpeg', 'jpg', 'png', 'bmp', 'gif', 'ico');
        if(in_array($extension, $allowedExtensions)){
            return Files::upload($file, $dir, $filename);
        }else{
            return false;
        }
    }

    static function curl($url, $useProxy = true){
        $ch = @curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Connection: keep-alive";
        $head[] = "Keep-Alive: 300";
        $head[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
        $head[] = "Accept-Language: en-us,en;q=0.5";
        curl_setopt($ch, CURLOPT_USERAGENT, 'User-Agent:Mozilla/5.0 (iPhone; CPU iPhone OS 7_0 like Mac OS X; en-us) AppleWebKit/537.51.1 (KHTML, like Gecko) Version/7.0 Mobile/11A465 Safari/9537.53');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        if($useProxy && strlen(env('PROXY_API'))) {
            $proxy_url = env('PROXY_API');
            if (strlen(env('PROXY_API_KEY'))) {
                $proxy_url .= "&apiKey=".env('PROXY_API_KEY');
            }
            try {
                $json = json_decode(file_get_contents($proxy_url));
                if ($json && isset($json->ip)) {
                    $protocal = isset($json->protocol)? $json->protocol: 'http';
                    curl_setopt($ch, CURLOPT_PROXY, "{$protocal}://{$json->ip}:{$json->port}");
                }
            } catch (\Exception $e) {
                
            }
        }elseif ($useProxy && strlen(env('IG_PROXY'))) {
            curl_setopt($ch, CURLOPT_PROXY, env('IG_PROXY'));
        }
        $page = curl_exec($ch);
        curl_close($ch);
        return $page;
    }
}
