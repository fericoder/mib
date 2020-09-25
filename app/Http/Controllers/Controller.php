<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function folder_exist($folder)
    {
        // Get canonicalized absolute pathname
        $path = realpath($folder);

        // If it exist, check if it's a directory
        if($path !== false AND is_dir($path))
        {
            // Return canonicalized absolute pathname
            return $path;
        }

        // Path/folder does not exist
        return false;
    }




    protected function watermark($file)
    {
        $imageSource = \Auth::user()->shop->watermark;
        $imageSource = ltrim($imageSource, '/');
        $watermark = \Image::make($imageSource);
        $img = \Image::make(ltrim($file, "/"));
        $watermarkSize = $img->width() - 20; //size of the image minus 20 margins
        $watermarkSize = $img->width() / 2; //half of the image size
        $resizePercentage = 70;//70% less then an actual image (play with this value)
        $watermarkSize = round($img->width() * ((100 - $resizePercentage) / 100), 2); //watermark will be $resizePercentage less then the actual width of the image
        $watermark->resize($watermarkSize, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->insert($watermark, 'bottom-right', 10, 10);
        $img->save(ltrim($file, "/"));

    }

    protected function uploadFile($file, $watermark = false, $resize = false)
    {

        $local = array(
            '127.0.0.1',
            'localhost',
            '::1'
        );

        if($this->folder_exist(public_path() . '_html')){
            $folder = public_path();
        }else{
            $folder = public_path();
        }


        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $day = Carbon::now()->day;
        $filePath = "/storage/upload/{$year}/{$month}/{$day}/";
        $fileName = time() . "_" . $file->getClientOriginalName();
        $file->move($folder . $filePath, $fileName);
        $file = "$filePath" . "$fileName";
        $imageMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/svg+xml'];
        $contentType = mime_content_type(ltrim($file, "/"));
        if ($watermark == true && in_array($contentType, $imageMimeTypes)) {
            $this->watermark($file);
        }
        if ($resize == true && in_array($contentType, $imageMimeTypes)) {
            $sizes = ["80" => "80", "400" => "400", "250" => "250", "200" => "175", "200" => "100", "410" => "270", "120" => "50", "16" => "16", "45" => "45", "931" => "800", "930" => "390"];

            return $url['images'] = $this->resize($file, $sizes, $filePath, $fileName);
        } else {
            return $file;
        }
    }


    private function resize($path, $sizes, $filePath, $fileName)
    {
        $local = array(
            '127.0.0.1',
            'localhost',
            '::1'
        );

        if($this->folder_exist(public_path() . '_html')){
            $folder = public_path();
        }else{
            $folder = public_path();
        }
        $images['original'] = $filePath . $fileName;
        foreach ($sizes as $width => $height) {
            $size = $width . ',' . $height;
            $images[$size] = $filePath . "{$size}_" . $fileName;
            \Image::make($folder . $path)->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            })->save($folder . $images[$size]);
        }
        return $images;
    }



    protected function fa2en($string)
    {
        $persian1 = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
        $persian2 = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        $num = range(0, 9);
        $string = str_replace($persian1, $num, $string);
        $string = str_replace(',', '', $string);
        return str_replace($persian2, $num, $string);
    }

}
