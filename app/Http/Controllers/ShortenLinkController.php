<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UrlShorten;

class ShortenLinkController extends Controller
{
    //

    function isValidUrl($url) {
        // Use filter_var to check if the given text is a valid URL
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public function shorten_url(Request $request){

        if ($this->isValidUrl($request->main_url)) {
        $baseUrl = url('/');
        $length = 8;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        $new_url = $baseUrl."/".$randomString;
        
        $check = UrlShorten::where('old_url', $request->main_url)->first();

        if($check == null){
            $url = UrlShorten::create([
                'old_url' => $request->main_url,
                'new_url' => $new_url,
            ]);
        }else{
            UrlShorten::where('old_url', $request->main_url)->update([
                'new_url' => $new_url,
            ]);

            $url = UrlShorten::where('old_url', $request->main_url)->first();
        }

        $message = "";
      }else{
        $url = "";
        $message = "The given Url is Not Valid";
      }

      return view('home', compact('url', 'message'));
    }

    public function get_url($no){
        $currentUrl = url()->current();
        
        $data = UrlShorten::where('new_url', $currentUrl)->first();
        
        if($data != null){
            return redirect()->away($data->old_url);
        }else{
             abort(404);
        }
    }
}
