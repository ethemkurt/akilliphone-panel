<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index(Request $request ){
        $data = [];
        return view('Home.index', $data);
    }
    public function notlogged(Request $request ){
        $data = [];
        return redirect(route('login'));
    }
    function imageTest(Request $request){
        $image = $request->input('slide', []);
        try{
            if($image['mobileImageFile']){
                $mobileImage = \CdnService::saveToCdn($image['mobileImageFile'], '');
            }
        } catch (\Exception $ex){
            die($ex->getMessage());
        }
        return _ReturnSucces('', '<a href="'._CdnImageUrl($mobileImage).'" target="_blank">'._CdnImageUrl($mobileImage).'</a>' );
    }
}
