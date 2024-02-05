<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;

class Uploader extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        return [ "default"=> 'http://example.com/images/image–default-size.png'];
    }
    public function cke(Request $request )
    {
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $path = public_path('media');

            $request->file('upload')->move(public_path('media'), $fileName);
            //$url = asset('media/' . $fileName);
            $url = \CdnService::moveToCdn($path.'/'.$fileName, \Illuminate\Support\Str::random(12).'.'.$extension);
            return ['default' => _CdnImageUrl($url, 600, 600)];
        }
    }
}
