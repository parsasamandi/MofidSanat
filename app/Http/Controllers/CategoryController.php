<?php

namespace App\Http\Controllers;

use App\DataTables\CategoryDataTable;
use App\Models\Cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Services\DataTable;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    // DataTable to blade
    public function list(Request $request) {
        $dataTable = new CategoryDataTable;

        $vars['categoryTable'] = $dataTable->html();

        return view('category.catList', $vars);
    }

    // Rendering DataTable
    public function categoryTable(CategoryDataTable $dataTable) {
        return $dataTable->render('category.catList');
    }

    // Store
    public function store(StoreCategoryRequest $request,SuccessMessages $message) {
        // Insert
        if($request->get('button_action') == "insert") {
            $this->addCat($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == "update") {
            $this->addCat($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success'   =>  $success_output);
        return json_encode($output);
    }

    // Store
    public function addCat($request) {
        // Update
        $cat = Cat::find($request->get('id'));
        // Insert
        if(!$cat) {
            $cat = new Cat;
        }
        $cat->name = $request->get('name');
        $cat->status = $request->get('status');

        $cat->save();
    }

    // Edit
    public function edit(Request $request) {
        $category = Cat::find($request->get('id'));
        return json_encode($category);
    }

    // Delete
    public function delete(Request $request, $id) {
        $category = Cat::find($id);
        if ($category) {
            $category->delete();
        } else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }
}
