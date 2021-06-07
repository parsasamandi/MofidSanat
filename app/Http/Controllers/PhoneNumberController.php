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

class PhoneNumberController extends Controller
{
    // Get phone number
    public function list(Request $request) {

        $dataTable = new PhoneNumberDataTable;

        $vars['phoneNumberTable'] = $dataTable->html();

        $vars['products'] = Product::select('name','id')->get();

        return view('phoneNumberList', $vars);
    }

    public function PhoneNumberTable(PhoneNumberDataTable $dataTable) {
        return $dataTable->render('phoneNumberList');
    }

    // Store phone number
    public function store(StorePhoneNumberRequest $request,SuccessMessages $message) {

        // Insert or update
        PhoneNumber::updateOrCreate(
            ['id' => $request->get('id')],
            ['number' => $request->get('number'), 'product_id' => $request->get('products')]
        );

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(PhoneNumber::class, $request->get('id'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(PhoneNumber::class, $id);
    }
}
