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

    // Store Product Data
    public function store(Request $request,SuccessMessages $message) {
        // Header Image
        if($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            $file = $header_image->getClientOriginalName();
            $header_image->move(public_path('images'),$file);

            $product_setting1 = ProductSetting::where('name', 'header_image')->first();
            $product_setting1->value = $file;
            $product_setting1->save(); 
        }
        // Header Text
        $product_setting2 = ProductSetting::where('name', 'header_text')->first();
        $product_setting2->value = $request->get('header_text');
        $product_setting2->save();
        // Header Description
        $product_setting3 = ProductSetting::where('name', 'header_desc')->first();
        $product_setting3->value = $request->get('header_desc');
        $product_setting3->save();

        $success_output = '';
        $success_output = $message->getInsert();

        $output = array('success' => $success_output);

        return response()->json($output);
    }
}
