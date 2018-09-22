<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\File;

class CropController extends Controller
{
    //

    public function postUpload()
    {
    	$form_data = Input::all();

    	$validator = Validator::make($form_data, Image::$rules, Image::$messages);

        if ($validator->fails()) {

            return Response::json([
                'status' => 'error',
                'message' => $validator->messages()->first(),
            ], 200);

        }

        $photo = $form_data['img'];

        $original_name = $photo->getClientOriginalName();
        $extension = $photo->getClientOriginalExtension();

        $original_name_without_ext = substr($original_name, 0, strlen($original_name) - 4);

        $filename = $this->sanitize($original_name_without_ext);
        $allowed_filename = $this->createUniqueFilename( $filename, $form_data['uploadFolder'], $extension );

        $filename_ext = $allowed_filename . '.' . $extension;

        $manager = new ImageManager();
        $image = $manager->make( $photo )->encode($extension)->save(env('UPLOAD_PATH') . "/{$form_data['uploadFolder']}/" . $filename_ext );

        if( !$image) {

            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);

        }

        Image::create([
        	'original_name' => $original_name,
        	'filename' => $allowed_filename
        ]);

        return Response::json([
            'status'    => 'success',
            'url'       => env('URL') . '/images/uploads/' . "/{$form_data['uploadFolder']}/" . $filename_ext,
            'width'     => $image->width(),
            'height'    => $image->height()
        ], 200);
    }

    public function postCrop()
    {
    	$form_data = Input::all();
        $image_url = $form_data['imgUrl'];

        // resized sizes
        $imgW = $form_data['imgW'];
        $imgH = $form_data['imgH'];
        // offsets
        $imgY1 = $form_data['imgY1'];
        $imgX1 = $form_data['imgX1'];
        // crop box
        $cropW = $form_data['width'];
        $cropH = $form_data['height'];
        // rotation angle
        $angle = $form_data['rotation'];

        $filename_array = explode('/', $image_url);
        $filename = $filename_array[sizeof($filename_array)-1];

        $manager = new ImageManager();
        $image = $manager->make( $image_url );
        $image->resize($imgW, $imgH)
            ->rotate(-$angle)
            ->crop($cropW, $cropH, $imgX1, $imgY1)
            ->save(env('UPLOAD_PATH') . "/{$form_data['uploadFolder']}/cropped/cropped-"  . $filename);


        if( !$image) {

            return Response::json([
                'status' => 'error',
                'message' => 'Server error while uploading',
            ], 200);

        }

        $user = Auth::user();

        $user->image = "cropped/cropped-{$filename}";

        $user->save();

        return Response::json([
            'status' => 'success',
            'url' => env('URL') . '/images/uploads/' . "{$form_data['uploadFolder']}/cropped/cropped-" . $filename,
        ], 200);

    }

    private function sanitize($string, $force_lowercase = true, $anal = false)
    {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean ;

        return ($force_lowercase) ?
            (function_exists('mb_strtolower')) ?
                mb_strtolower($clean, 'UTF-8') :
                strtolower($clean) :
            $clean;
    }


    private function createUniqueFilename( $filename, $uploadFolder, $extension )
    {
        $upload_path = env('UPLOAD_PATH');
        $full_image_path = $upload_path . "{$uploadFolder}/" . $filename . '.' . $extension;

        if ( File::exists( $full_image_path ) )
        {
            // Generate token for image
            $image_token = substr(sha1(mt_rand()), 0, 5);
            return $filename . '-' . $image_token;
        }

        return $filename;
    }
}
