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
use App\Providers\Action;
use App\Http\Requests\StoreCategoryRequest;

class CategoryController extends Controller
{
    // DataTable to blade
    public function list(Request $request) {
        $dataTable = new CategoryDataTable;

        $vars['categoryTable'] = $dataTable->html();

        return view('category.categoryList', $vars);
    }

    // Rendering DataTable
    public function categoryTable(CategoryDataTable $dataTable) {
        return $dataTable->render('category.categoryList');
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
        Cat::updateOrCreate(
            ['id' => $request->get('id')],
            ['name' => $request->get('name'), 'status' => $request->get('status')]
        );
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Category::class,$request->get('id'));
    }

    // Delete
    public function delete(Action $action,$id) {
        return $action->delete(Category::class,$id);
    }
}
