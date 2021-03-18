<?php

namespace App\Http\Controllers;
use App\Models\HomeSetting;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHomeSettingRequest;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\Validator;
use App\Providers\EnglishConvertion;


class HomeSettingController extends Controller
{
    // Show Setting Data
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

        $home_settings = homeSetting::whereIn('name', $names)->select('value')->get();

        $vars = [];
        foreach($home_settings as $setting) {
            $vars["setting_$setting->name"] = $setting->value;
        }

        return view('setting.homeSetting',$vars);

    }

    // Store Setting Data
    public function store(StoreHomeSettingRequest $request,EnglishConvertion $englishConvertion,SuccessMessages $message) {
        // Header Image
        if($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            $file = $header_image->getClientOriginalName();
            $header_image->move(public_path('images'),$file);

            $home_setting1 = HomeSetting::where('name', 'header_image')->select('value')->first();
            $home_setting1->value = $file;
            $home_setting1->save();
        }
        // Main Header
        $home_setting2 = HomeSetting::where('name', 'header')->select('value')->first();
        $home_setting2->value = $request->get('header');
        $home_setting2->save();
        // Sub Header
        $home_setting3 = HomeSetting::where('name', 'sub_header')->select('value')->first();
        $home_setting3->value = $request->get('sub_header');
        $home_setting3->save();
        // Header Button
        $home_setting4 = HomeSetting::where('name', 'header_button')->first();
        $home_setting4->value = $request->get('header_button');
        $home_setting4->save();
        // About Us Text
        $home_setting5 = HomeSetting::where('name', 'about_us_headerText')->first();
        $home_setting5->value = $request->get('about_us_headerText');
        $home_setting5->save();
        // About Us Image
        if($request->hasFile('about_us_image')) {
            $about_us_image = $request->file('about_us_image');
            $file = $about_us_image->getClientOriginalName();
            $about_us_image->move(public_path('images'),$file);

            $home_setting6 = HomeSetting::where('name','about_us_image')->first();
            $home_setting6->value = $file;
            $home_setting6->save();
        }
        // About Us Image Size
        $home_setting7 = HomeSetting::where('name', 'about_us_imageSize')->first();
        $home_setting7->value = $englishConvertion->convert($request->get('about_us_imageSize'));
        $home_setting7->save();
        // About Us Header
        $home_setting8 = HomeSetting::where('name', 'about_us_header')->first();
        $home_setting8->value = $request->get('about_us_header');
        $home_setting8->save();
        // About Us Text
        $home_setting9 = HomeSetting::where('name', 'about_us_text')->first();
        $home_setting9->value = $request->get('about_us_text');
        $home_setting9->save();
        // About Us Header 2
        $home_setting10 = HomeSetting::where('name', 'about_us_header2')->first();
        $home_setting10->value = $request->get('about_us_header2');
        $home_setting10->save();
        // About Us Text 2
        $home_setting11 = HomeSetting::where('name', 'about_us_text2')->first();
        $home_setting11->value = $request->get('about_us_text2');
        $home_setting11->save();
        // About Us Header 3
        $home_setting12 = HomeSetting::where('name', 'about_us_header3')->first();
        $home_setting12->value = $request->get('about_us_header3');
        $home_setting12->save();
        // About Us Text 3
        $home_setting13 = HomeSetting::where('name', 'about_us_text3')->first();
        $home_setting13->value = $request->get('about_us_text3');
        $home_setting13->save();
        // Why Us Image
        if($request->hasFile('why_us_image')) {
            $why_us_image = $request->file('why_us_image');
            $file = $why_us_image->getClientOriginalName();
            $why_us_image->move(public_path('images'),$file);

            $home_setting14 = HomeSetting::where('name','why_us_image')->first();
            $home_setting14->value = $file;
            $home_setting14->save();
        }
        // Why Us Image Size
        $home_setting15 = HomeSetting::where('name', 'why_us_imageSize')->first();
        $home_setting15->value = $englishConvertion->convert($request->get('why_us_imageSize'));
        $home_setting15->save();
        // Why Us Text
        $home_setting16 = HomeSetting::where('name', 'why_us_text')->first();
        $home_setting16->value = $request->get('why_us_text');
        $home_setting16->save();
        // Service Header
        $home_setting17 = HomeSetting::where('name', 'service_header')->first();
        $home_setting17->value = $request->get('service_header');
        $home_setting17->save();
        // Service Text
        $home_setting18 = HomeSetting::where('name', 'service_text')->first();
        $home_setting18->value = $request->get('service_text');
        $home_setting18->save();
        // Service Header 2
        $home_setting19 = HomeSetting::where('name', 'service_header2')->first();
        $home_setting19->value = $request->get('service_header2');
        $home_setting19->save();
        // Service Text 2
        $home_setting20 = HomeSetting::where('name', 'service_text2')->first();
        $home_setting20->value = $request->get('service_text2');
        $home_setting20->save();
        // Service Header 3
        $home_setting21 = HomeSetting::where('name', 'service_header3')->first();
        $home_setting21->value = $request->get('service_header3');
        $home_setting21->save();
        // Service Text 3
        $home_setting22 = HomeSetting::where('name', 'service_text3')->first();
        $home_setting22->value = $request->get('service_text3');
        $home_setting22->save();
        // Service Header 4
        $home_setting23 = HomeSetting::where('name', 'service_header4')->first();
        $home_setting23->value = $request->get('service_header4');
        $home_setting23->save();
        // Service Text 4
        $home_setting24 = HomeSetting::where('name', 'service_text4')->first();
        $home_setting24->value = $request->get('service_text4');
        $home_setting24->save();
        // Service Header 5
        $home_setting25 = HomeSetting::where('name', 'service_header5')->first();
        $home_setting25->value = $request->get('service_header5');
        $home_setting25->save();
        // Service Text 5
        $home_setting26 = HomeSetting::where('name', 'service_text5')->first();
        $home_setting26->value = $request->get('service_text5');
        $home_setting26->save();
        // Service Header 6
        $home_setting27 = HomeSetting::where('name', 'service_header6')->first();
        $home_setting27->value = $request->get('service_header6');
        $home_setting27->save();
        // Service Text 6
        $home_setting28 = HomeSetting::where('name', 'service_text6')->first();
        $home_setting28->value = $request->get('service_text6');
        $home_setting28->save();
        // Address
        $home_setting29 = HomeSetting::where('name', 'address')->first();
        $home_setting29->value = $request->get('address');
        $home_setting29->save();
        // Email
        $home_setting30 = HomeSetting::where('name', 'email_footer')->first();
        $home_setting30->value = $request->get('email');
        $home_setting30->save();
        // Phone NUmber
        $home_setting31 = HomeSetting::where('name', 'phone_number')->first();
        $home_setting31->value = $request->get('phone_number');
        $home_setting31->save();

        // About Us Image Size
        $home_setting32 = HomeSetting::where('name', 'about_us_imageSize')->first();
        $home_setting32->value = $request->get('about_us_imageSize');
        $home_setting32->save();

        $success_output = $message->getInsert();
        $output = array('success' => $success_output);

        return response()->json($output);
    }
}
