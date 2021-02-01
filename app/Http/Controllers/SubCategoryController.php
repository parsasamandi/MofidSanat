<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Database\Eloquent\Model;
use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\StoreSubCategoryRequest;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\SubCat;
use App\Models\Product;
use App\Models\home_setting;
use App\Models\Media;
use DataTables;
use Auth;
use File;
use Session;
use DB;

class SubCategoryController extends Controller
{
    // get Category Data
    public function list(Request $request) {
        $datatable = new SubCategoryDataTable;

        $vars['subCategoryTable'] = $datatable->html();

        $cats = Cat::select('name','id')->get();
        return view('category.subCatList', $vars , compact($cats));
    }

    // Render Datatable
    public function subCategoryTable(SubCategoryDataTable $datatable) {
        return $datatable->render('category.subCatList');
    }

    // Storing And Updating Category
    public function store(StoreSubCategoryRequest $request,SuccessMessages $message) {
        // Insert
        if($request->get('button_action') == "insert") {
            $this->addSubCategory($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->addSubCategory($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success'   =>  $success_output);
        return json_encode($output);
    }

    // Add SUb Category
    public function addSubCategory($request) {
        // Update
        $subCat = SubCat::find($request->get('id'));
        // Insert
        if(!$subCat) {
            $subCat = new SubCat();
        }
        $subCat->name = $request->get('name');
        $subCat->status = $request->get('status');
        $subCat->c_id = $request->get('category');

        $subCat->save();
    }

    // Delete Each Category
    public function delete(Request $request,$id) {
        $subCat = SubCat::find($id);
        if($subCat) {
            $subCat->delete();
        } else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    // Edit Sub Catgory Data
    public function edit(Request $request) {
        $subCat = SubCat::find($request->get('id'));
        return json_encode($subCat);
    }


}
