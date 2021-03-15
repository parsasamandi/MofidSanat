<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PhoneNumberDataTable;
use App\Providers\SuccessMessages;
use App\Models\PhoneNumber;
use App\Models\Product;
use App\Http\Requests\StorePhoneNumberRequest;
use Illuminate\Support\Facades\Validator;
use App\Providers\Action;
use App\Providers\EnglishConvertion;

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

        // English convertion
        $englishConvertion = new EnglishConvertion();

        PhoneNumber::updateOrCreate(
            ['id' => $request->get('id')],
            ['number' => $englishConvertion->convert($request->get('number')), 'product_id' => $request->get('products')]
        );
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
