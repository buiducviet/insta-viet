<?php

namespace App\Models;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Img;

class Files
{

	static function upload($file = false, $dir = '', $filename){
		$result = false;
		try {
			$extension = $file->getClientOriginalExtension();
			$filename .= ".{$extension}";
			$path = "{$dir}/{$filename}";
			if (!is_null(config('filesystems.disks.ftp.host'))) {
				if ($file->storeAs($dir, $filename, 'ftp')) {
	                $result = strlen(config('filesystems.disks.ftp.root'))? "/".config('filesystems.disks.ftp.root')."/{$path}": "/{$path}";
	            }               
			}else{
	            $uploadDir = 'storage/'.$path;
				if (!is_dir($uploadDir)) {
		            mkdir($uploadDir, 0777, true);
		        }
                $file->move($uploadDir, $filename);
                $result = '/storage/'.$path;
			}
		} catch (\Exception $e) {
			
		}

		return $result;
	}

	static function upload_url($url, $dir, $filename){
		try {
			$storage = Storage::disk('ftp');
			$contents = file_get_contents($url);
	        $path = "{$dir}/{$filename}.png";
	        $storage->put($path, $contents);
	        return strlen(config('filesystems.disks.ftp.root'))? "/".config('filesystems.disks.ftp.root')."/{$path}": "/{$path}";
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
}