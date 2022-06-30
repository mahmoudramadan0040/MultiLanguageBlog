<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\VarDumper\VarDumper;
use \Illuminate\Support\Str;
class DashboardSettingController extends Controller
{
    // update client settings
    public function update(Request $request, Setting $setting)
    {
        // Setting::create($request->all());
        // dd($request->all());
        $data =[
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ];
        foreach(config('app.languages') as $key => $value){
            $data[$key . '*.title']='nullable |string';
            $data[$key . '*.content']='nullable |string';
            $data[$key . '*.address']='nullable |string';

        }
        $validateData = $request->validate($data);
        $setting->update($request->except('image','favicon','_token'));
        
       
        if ($request->file('logo')) {
            $file = $request->file('logo');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = 'images/' . $filename;
            $setting->update(['logo' => $path]);
        }
        if ($request->file('favicon')) {
            $file = $request->file('favicon');
            $filename = Str::uuid() . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $path = '/images/' . $filename;
            $setting->update(['favicon' => $path]);
        }
        return redirect()->route('Dashboard.settings');

    }
    
}