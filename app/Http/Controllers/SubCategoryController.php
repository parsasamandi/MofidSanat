<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use App\Providers\SuccessMessages;
use App\DataTables\SubcategoryDataTable;
use App\Http\Requests\StoreSubcategoryRequest;
use App\Providers\Action;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Auth;
use File;


class SubcategoryController extends Controller
{
    // Get category
    public function list(Request $request) {

        $datatable = new SubcategoryDataTable;
        $vars['subCategoryTable'] = $datatable->html();

        // Categories
        $vars['categories'] = Cat::select('name','id')->get();

        return view('category.subCategoryList', $vars);
    }

    // Render Datatable
    public function subCategoryTable(SubcategoryDataTable $datatable) {
        return $datatable->render('category.subCategoryList');
    }

    // Store 
    public function store(StoreSubcategoryRequest $request) {

        // Insert or update
        Subcategory::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'), 'status' => $request->get('status'), 'category_id' => $request->get('category')]
        );

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Subcategory::class,$request->get('id'));
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Subcategory::class,$id);
    }


}
