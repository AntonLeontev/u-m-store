<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class FileLockController extends Controller
{
    public function licenceFileShow($file)
    {
        /**
         *Make sure the @param $file has a dot
         * Then check if the user has Admin Role. If true serve else
         */
        if (strpos($file, '.') !== false) {

            if (Auth::check()) {
                /** Serve the file for the Admin*/
                if(Auth::user()->role_id === 1  || Auth::user()->role_id === 3 )
                {
                    return $this->returnFile($file);
                }
                return 'Недостаточно прав для просмотра';
            } else {
                /**Logic to check if the request is from file owner**/
                return redirect('404');
            }
        } else {
        //Invalid file name given
            return redirect('404');
        }
    }
    public function returnFile($file)
    {
        //This method will look for the file and get it from drive
        $path = storage_path('app/for_manager/' . $file);
        try {
            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        } catch (FileNotFoundException $exception) {
            abort(404);
        }
    }
}
