<?php
namespace App;


use Illuminate\Database\Eloquent\Model;

class Base64ToJpeg extends Model
{
    //
    public static function base64_to_jpeg($base64_string, $output_file) {
        $ifp = fopen($output_file, "wb");

        $data = explode(',', $base64_string);

        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);

        return $output_file;
    }
}



