<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Slide extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
    ];

    public function upSertImages($images){
        DB::table('slide_images')->where(['slideId'=>$this->id])->delete();
        foreach($images as $image) {

            try{
                if($image['desktopImageFile']){
                    $image['desktopImage'] = \CdnService::saveToCdn($image['desktopImageFile'], '');
                }
                if($image['desktopImage'] ){
                    if($image['mobileImageFile']){
                        $image['mobileImage'] = \CdnService::saveToCdn($image['mobileImageFile'], '');
                    }
                    $data = [
                        'slideId'=>$this->id,
                        'sortOrder'=>isset($image['sortOrder'])?$image['sortOrder']:1,
                        'desktopImage'=>isset($image['desktopImage'])?$image['desktopImage']:'',
                        'mobileImage'=>isset($image['mobileImage'])?$image['mobileImage']:'',
                        'bgColor'=>isset($image['bgColor'])?$image['bgColor']:'',
                        'title'=>isset($image['title'])?$image['title']:'',
                        'slug'=>isset($image['slug'])?$image['slug']:''
                    ];
                    DB::table('slide_images')->insert($data);
                }
            } catch (\Exception $ex){
                die($ex->getMessage());
            }
        }
    }
}
