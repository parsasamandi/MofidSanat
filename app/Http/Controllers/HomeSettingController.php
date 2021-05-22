<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreHomeSettingRequest;
use App\Providers\SuccessMessages;
use App\Providers\EnglishConvertion;
use App\Models\Setting;


class HomeSettingController extends Controller
{
    // Show Setting Data
    public function index() {

        $names = [
            'header_image',
            'header',
            'sub_header',
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

        $settings = Setting::whereIn('name', $names)->select('name','value')->get();

        $vars = [];
        foreach($settings as $setting) {
            $vars["$setting->name"] = $setting->value;
        }

        return view('setting.homeSetting', $vars);

    }

    // Store Setting Data
    public function store(StoreHomeSettingRequest $request,EnglishConvertion $englishConvertion,SuccessMessages $message) {
        
        // Header image
        if($request->hasFile('header_image')) {
            $header_image = $request->file('header_image');
            $file = $header_image->getClientOriginalName();
            $header_image->move(public_path('images'), $file);

            $home_setting1 = Setting::where('name', 'header_image')->first();
            $home_setting1->value = $file;
            $home_setting1->save();
        }

        // Main header
        $home_setting2 = Setting::where('name', 'header')->first();
        $home_setting2->value = $request->get('header');
        $home_setting2->save();
        // Sub header
        $home_setting3 = Setting::where('name', 'sub_header')->first();
        $home_setting3->value = $request->get('sub_header');
        $home_setting3->save(); ;
        // About-us image
        if($request->hasFile('about_us_image')) {
            $about_us_image = $request->file('about_us_image');
            $file = $about_us_image->getClientOriginalName();
            $about_us_image->move(public_path('images'),$file);

            $home_setting6 = Setting::where('name','about_us_image')->first();
            $home_setting6->value = $file;
            $home_setting6->save();
        }
        // About-us image Size
        $home_setting7 = Setting::where('name', 'why_us_imageSize')->first();
        $home_setting7->value = $englishConvertion->convert($request->get('why_us_imageSize'));
        $home_setting7->save();
        // About-us header
        $home_setting8 = Setting::where('name', 'about_us_header')->first();
        $home_setting8->value = $request->get('about_us_header');
        $home_setting8->save();
        // About-us text
        $home_setting9 = Setting::where('name', 'about_us_text')->first();
        $home_setting9->value = $request->get('about_us_text');
        $home_setting9->save();
        // About-us header 2
        $home_setting10 = Setting::where('name', 'about_us_header2')->first();
        $home_setting10->value = $request->get('about_us_header2');
        $home_setting10->save();
        // About-us text 2
        $home_setting11 = Setting::where('name', 'about_us_text2')->first();
        $home_setting11->value = $request->get('about_us_text2');
        $home_setting11->save();
        // About Us Header 3
        $home_setting12 = Setting::where('name', 'about_us_header3')->first();
        $home_setting12->value = $request->get('about_us_header3');
        $home_setting12->save();
        // About Us Text 3
        $home_setting13 = Setting::where('name', 'about_us_text3')->first();
        $home_setting13->value = $request->get('about_us_text3');
        $home_setting13->save();
        // Why Us Image
        if($request->hasFile('why_us_image')) {
            $why_us_image = $request->file('why_us_image');
            $file = $why_us_image->getClientOriginalName();
            $why_us_image->move(public_path('images'),$file);

            $home_setting14 = Setting::where('name','why_us_image')->first();
            $home_setting14->value = $file;
            $home_setting14->save();
        }
        // Why Us Image Size
        $home_setting15 = Setting::where('name', 'why_us_imageSize')->first();
        $home_setting15->value = $englishConvertion->convert($request->get('why_us_imageSize'));
        $home_setting15->save();
        // Why Us Text
        $home_setting16 = Setting::where('name', 'why_us_text')->first();
        $home_setting16->value = $request->get('why_us_text');
        $home_setting16->save();
        // Service Header
        $home_setting17 = Setting::where('name', 'service_header')->first();
        $home_setting17->value = $request->get('service_header');
        $home_setting17->save();
        // Service Text
        $home_setting18 = Setting::where('name', 'service_text')->first();
        $home_setting18->value = $request->get('service_text');
        $home_setting18->save();
        // Service Header 2
        $home_setting19 = Setting::where('name', 'service_header2')->first();
        $home_setting19->value = $request->get('service_header2');
        $home_setting19->save();
        // Service Text 2
        $home_setting20 = Setting::where('name', 'service_text2')->first();
        $home_setting20->value = $request->get('service_text2');
        $home_setting20->save();
        // Service Header 3
        $home_setting21 = Setting::where('name', 'service_header3')->first();
        $home_setting21->value = $request->get('service_header3');
        $home_setting21->save();
        // Service Text 3
        $home_setting22 = Setting::where('name', 'service_text3')->first();
        $home_setting22->value = $request->get('service_text3');
        $home_setting22->save();
        // Service Header 4
        $home_setting23 = Setting::where('name', 'service_header4')->first();
        $home_setting23->value = $request->get('service_header4');
        $home_setting23->save();
        // Service Text 4
        $home_setting24 = Setting::where('name', 'service_text4')->first();
        $home_setting24->value = $request->get('service_text4');
        $home_setting24->save();
        // Service Header 5
        $home_setting25 = Setting::where('name', 'service_header5')->first();
        $home_setting25->value = $request->get('service_header5');
        $home_setting25->save();
        // Service Text 5
        $home_setting26 = Setting::where('name', 'service_text5')->first();
        $home_setting26->value = $request->get('service_text5');
        $home_setting26->save();
        // Service Header 6
        $home_setting27 = Setting::where('name', 'service_header6')->first();
        $home_setting27->value = $request->get('service_header6');
        $home_setting27->save();
        // Service Text 6
        $home_setting28 = Setting::where('name', 'service_text6')->first();
        $home_setting28->value = $request->get('service_text6');
        $home_setting28->save();
        // Address
        $home_setting29 = Setting::where('name', 'address')->first();
        $home_setting29->value = $request->get('address');
        $home_setting29->save();
        // Email
        $home_setting30 = Setting::where('name', 'email_footer')->first();
        $home_setting30->value = $request->get('email');
        $home_setting30->save();

        // Phone number
        $home_setting31 = Setting::where('name', 'phone_number')->first();
        $home_setting31->value = $request->get('phone_number');
        $home_setting31->save();

        // About Us Image Size
        // $home_setting32 = Setting::where('name', 'about_us_imageSize')->first();
        // $home_setting32->value = $request->get('about_us_imageSize');
        // $home_setting32->save();

        return response()->json(['message' => $this->getInsertionMessage()]);
    }
}
