<?php

namespace App\Http\Controllers;
use App\Models\ProductSetting;
use App\Providers\SuccessMessages;
use Illuminate\Http\Request;

class ProductSettingController extends Controller
{
    // Show Product Data
    public function index() {
        $names = [
            'header_image',
            'header_text',
            'header_desc'
        ];

        $product_settings = ProductSetting::whereIn('name', $names)->get();

        $vars = [];
        foreach($product_settings as $setting) {
            $vars["product_$setting->name"] = $setting->value; 
        }

        return view('/setting/productSetting',$vars);
    }

    // Store product data
    public function store(Request $request,SuccessMessages $message) {

        // Header image
        if($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            $file = $header_image->getClientOriginalName();
            $header_image->move(public_path('images'),$file);

            $setting1 = ProductSetting::where('name', 'header_image')->first();
            $setting1->value = $file;
            $setting1->save(); 
        }
        // Header text
        $setting2 = ProductSetting::where('name', 'header_text')->first();
        $setting2->value = $request->get('header_text');
        $setting2->save();

        // Header description
        $setting3 = ProductSetting::where('name', 'header_desc')->first();
        $setting3->value = $request->get('header_desc');
        $setting3->save();

        return response()->json(['success' => $this->getInsertionMessage()]);
    }
}
