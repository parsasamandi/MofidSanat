<?php

namespace App\Http\Controllers;
use App\DataTables\PhoneNumberDataTable;
use App\Providers\SuccessMessages;
use App\Models\PhoneNumber;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PhoneNumberController extends Controller
{
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
    public function store(Request $request,SuccessMessages $message) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '٤', '۵', '٥', '٦', '۶', '۷', '۸', '۹'];
        $english = [ 0 ,  1 ,  2 ,  3 ,  4 ,  4 ,  5 ,  5 ,  6 ,  6 ,  7 ,  8 ,  9 ];

        $validation = Validator::make($request->all(), [
            'number' => 'required|int|digits:11',
            'productSelect' => 'required'
        ]);

        $error_array = array();
        $success_output = '';
        if ($validation->fails()) {
            foreach($validation->messages()->getMessages() as $field_name => $messages) {
                $error_array[] = $messages;
            }  
        }
        else {
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
        }
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        return json_encode($output);
    }

    public function addPhoneNumber($request) {
        // Update
        $phoneNumbr = PhoneNumber::find($request->get('id'));
        // Insert
        if(!$phoneNumber) {
            $phoneNumber = new PhoneNumber();
        }
        $phoneNumber->number = $this->convertToEnglish($request->get('number'));
        $phoneNumber->product_id = $request->get('productSelect');

        $phoneNumber->save();
    }

    // Convertion
    function convertToEnglish($number) {
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
    public function edit(Request $request) {
        $phoneNumber = PhoneNumber::find($request->get('id'));
        return json_encode($phoneNumber->toArray());
    }

    // Delete
    public function delete(Request $request, $id) {
        $phoneNumber = PhoneNumber::find($id);
        if($phoneNumber) {
            $phoneNumber->delete();
        } else {
            return response()->json([], 400);
        }
        return response()->json([], 200);

    }
}
