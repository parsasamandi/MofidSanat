<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Providers\SuccessMessages;
use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Providers\Action;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\SubCat;
use Auth;
use File;


class SubCategoryController extends Controller
{
    // get Category Data
    public function list(Request $request) {

        $datatable = new SubCategoryDataTable;
        $vars['subCategoryTable'] = $datatable->html();

        // Categories
        $vars['categories'] = Cat::select('name','id')->get();

        return view('category.subCategoryList', $vars);
    }

    // Render Datatable
    public function subCategoryTable(SubCategoryDataTable $datatable) {
        return $datatable->render('category.subCategoryList');
    }

    // Storing And Updating Category
    public function store(StoreSubCategoryRequest $request,SuccessMessages $message) {

        // Insert or update
        $this->addSubCategory($request);

        // Insert
        if($request->get('button_action') == "insert") {
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $success_output = $message->getUpdate();
        }

        $output = array('success'   =>  $success_output);
        return response()->json($output);
    }

    // Add SUb Category
    public function addSubCategory($request) {
        
        SubCat::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'), 'status' => $request->get('status'), 'c_id' => $request->get('category')]
        );
    }

    // Edit Sub Catgory Data
    public function edit(Action $action,Request $request) {
        return $action->edit(SubCat::class,$request->get('id'));
    }

    // Delete Each Category
    public function delete(Action $action,$id) {
        return $action->delete(SubCat::class,$id);
    }


}
