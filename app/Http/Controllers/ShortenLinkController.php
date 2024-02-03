<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UrlShorten;

class ShortenLinkController extends Controller
{
    //

    public function shorten_url(Request $request){
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

        return view('home', compact('url'));
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
