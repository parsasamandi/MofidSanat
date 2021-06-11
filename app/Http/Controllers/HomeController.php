<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Team;
use App\Models\Setting;
use App\Models\Service;


class HomeController extends Controller
{
    public function index() {
        // Name
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
            'address',
            'email_footer',
            'phone_number'
        ];

        $home_settings = Setting::whereIn('name', $names)->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars["setting_$setting->name"] = $setting->value;
        }

        // Categories
        $vars['categories'] = Category::select('name','id')->get();
        // Team
        $vars['teams'] = Team::paginate(4);
        // Services 
        $vars['services'] = Service::select('title','description','font_awesome')->get();

        return view('home', $vars);
    }


}
