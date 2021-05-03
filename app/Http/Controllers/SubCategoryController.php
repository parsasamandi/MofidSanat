<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Providers\SuccessMessages;
use App\DataTables\SubCategoryDataTable;
use App\Http\Requests\StoreSubCategoryRequest;
use App\Providers\Action;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
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

    // Storing or updating category
    public function store(StoreSubCategoryRequest $request,SuccessMessages $message) {

        // Insert or update
        Subcategory::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'), 'status' => $request->get('status'), 'category_id' => $request->get('category')]
        );

        return $this->getAction($request->get('button_action'));
    }

    // Edit Sub Catgory Data
    public function edit(Action $action,Request $request) {
        return $action->edit(Subcategory::class,$request->get('id'));
    }

    // Delete Each Category
    public function delete(Action $action,$id) {
        return $action->delete(Subcategory::class,$id);
    }


}
