<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        return view('admin.settings.edit')->with('settings', $setting);
    }


    public function update(Request $request)
    {

        $this->validate($request, [
            'phone' => 'required',
            'email' => 'required',
            'text' => 'required',
            'image' => 'nullable|image',
            'whats_app' => 'required',
            'instagram' => 'required',
            'you_tube' => 'required',
            'twitter' => 'required',
            'facebook' => 'required',
        ]);

        $setting = Setting::first();
        if (!$setting) {
            $setting = new Setting();

            if ( $request->hasFile('image')  ) {
                $image = $request->image;
                $image_new_name = time() . '.jpg';
                $image->move('uploads/setting', $image_new_name);

                $setting->image = 'uploads/setting/'.$image_new_name;
            }

            $setting->phone = $request->phone;
            $setting->email = $request->email;
            $setting->text = $request->text;
            $setting->whats_app = $request->whats_app;
            $setting->instagram = $request->instagram;
            $setting->you_tube = $request->you_tube;
            $setting->twitter = $request->twitter;
            $setting->facebook = $request->facebook;

            $setting->save();

            flash()->success(trans('admin.editMessageSuccess'));
            return redirect()->back();
        }

        if ( $request->hasFile('image')  ) {
            $image = $request->image;
            $image_new_name = time() . $image->getClientOriginalName();
            $image->move('uploads/setting', $image_new_name);

            $setting->image = 'uploads/setting/'.$image_new_name;
        }

        $setting->phone = $request->phone;
        $setting->email = $request->email;
        $setting->text = $request->text;
        $setting->whats_app = $request->whats_app;
        $setting->instagram = $request->instagram;
        $setting->you_tube = $request->you_tube;
        $setting->twitter = $request->twitter;
        $setting->facebook = $request->facebook;

        $setting->save();

        flash()->success(trans('admin.editMessageSuccess'));
        return redirect()->back();


    }
}
