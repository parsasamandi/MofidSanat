<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Providers\SuccessMessages;
use Illuminate\Http\Request;

class ProductSettingController extends Controller
{
    // Show product setting
    public function index() {
        $names = [
            'header_image',
            'header_text',
            'header_description'
        ];

        $productSettings = Setting::whereIn('name', $names)->get();

        $vars = [];
        foreach($productSettings as $setting) {
            $vars["product_$setting->name"] = $setting->value; 
        }

        return view('setting.productSetting', $vars);
    }

    // Store product setting
    public function store(Request $request) {

        // Header image
        if($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            $file = $header_image->getClientOriginalName();
            $header_image->move(public_path('images'),$file);

            $setting1 = Setting::where('name', 'header_image')->first();
            $setting1->value = $file;
            $setting1->save(); 
        }
        // Header text
        $setting2 = Setting::where('name', 'header_text')->first();
        $setting2->value = $request->get('header_text');
        $setting2->save();

        // Header description
        $setting3 = Setting::where('name', 'header_description')->first();
        $setting3->value = $request->get('header_description');
        $setting3->save();

        return response()->json(['success' => $this->getInsertionMessage()]);
    }
}
