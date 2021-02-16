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

        // Insert or update
        $this->addPhoneNumber($request);

        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
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
        // 1. Persian Numeric
        $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');

        return str_replace($persian, $newNumbers, $string);

    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(PhoneNumber::class,$request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(PhoneNumber::class,$id);
    }
}
