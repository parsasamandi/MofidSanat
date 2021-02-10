<?php

namespace App\Http\Controllers;
use App\DataTables\PhoneNumberDataTable;
use App\Providers\SuccessMessages;
use App\Models\PhoneNumber;
use App\Models\Product;
use App\Http\Requests\StorePhoneNumberRequest;
use Illuminate\Support\Facades\Validator;
use App\Providers\Action;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
    public $phoneNumber = 'App\Models\PhoneNumber';
    // get Phone Number
    public function list(Request $request) {
        $dataTable = new PhoneNumberDataTable;

        $vars['phoneNumberTable'] = $dataTable->html();

        $products = Product::select('name','id')->get();

        return view('phoneNumberList', $vars, compact('products'));
    }

    public function PhoneNumberTable(PhoneNumberDataTable $dataTable) {
        return $dataTable->render('phoneNumberList');
    }

    // Store Phone Number
    public function store(StorePhoneNumberRequest $request,SuccessMessages $message) {
        // Insert
        if($request->get('button_action') == "insert") {
            $this->addPhoneNumber($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
            $this->addPhoneNumber($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);
        return json_encode($output);
    }

    public function addPhoneNumber($request) {
        PhoneNumber::updateOrCreate(
            ['id' => $request->get('id')],
            ['number' => $request->get('number'), 'product_id' => $request->get('productSelect')]
        );
    }

    // Convertion
    function convertToEnglish($string) {
        $newNumbers = range(0,9);
        // 1. Persian HTML Decimal
        $persianDecimal = array('&#1776;', '&#1777;', '&#1778;', '&#1779;', '&#1780;', '&#1781;', '&#1782;', '&#1783;', '&#1784;', '&#1785;');
        // 2. Arabic HTML decimal
        $arabicDecimal = array('&#1632;', '&#1633;', '&#1634;', '&#1635;', '&#1636;', '&#1637;', '&#1638;', '&#1639;', '&#1640;', '&#1641;');
        // 3. Arabic Numeric
        $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
        // 4. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        $string = str_replace($persianDecimal, $newNumbers, $string);
        $string = str_replace($arabicDecimal, $newNumbers, $string);
        $string = str_replace($arabic, $newNumbers, $string);
        return str_replace($persian, $newNumbers, $string);

    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit($this->phoneNumber,$request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete($this->phoneNumber,$id);
    }
}
