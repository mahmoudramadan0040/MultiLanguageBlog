<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Setting extends Model implements TranslatableContract
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['title', 'content'];
    protected $fillable = ['id','logo','favicon','facebook','instgram','phone','email','created_at','deleted_at'];
    protected $table = 'settings';

    public static function checkSettings(){
        $setting = self::all();
        if(count($setting)<1){
            $data =[
                'id'=>1,
            ];
            foreach(config("app.languages") as $key => $value){
                $data[$key]['title']=$value;
            }
            Setting::create($data);
            dd($data);
        }
        return self::first();
    }
}
