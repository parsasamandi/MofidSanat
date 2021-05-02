<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use App\Models\Team;
use App\Models\Setting;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index() {
        $names = [
            'header_image',
            'header',
            'sub_header',
            'header_button',
            'about_us_headerText',
            'about_us_image',
            'about_us_imageSize',
            'about_us_header',
            'about_us_text',
            'about_us_header2',
            'about_us_text2',
            'about_us_header3',
            'about_us_text3',
            'why_us_text',
            'why_us_image',
            'why_us_imageSize',
            'service_header',
            'service_text',
            'service_header2',
            'service_text2',
            'service_header3',
            'service_text3',
            'service_header4',
            'service_text4',
            'service_header5',
            'service_text5',
            'service_header6',
            'service_text6',
            'address',
            'email_footer',
            'phone_number'
        ];

        $home_settings = Setting::whereIn('name', $names)->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars["setting_$setting->name"] = $setting->value;
        }

        // Products
        // $vars['products'] = Product::where('status',1)->paginate(6);
        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Team
        $vars['teams'] = Team::select('name','responsibility','linkedin_address','image')->paginate(4);

        return view('home', $vars);
    }


}
