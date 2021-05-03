<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\DataTables\AparatDataTable;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreAparatRequest;
use App\Providers\Action;
use App\Models\Media;

class AparatController extends Controller
{
    // DataTable to blade
    public function list() {
        $dataTable = new AparatDataTable;

        $vars['aparatTable'] = $dataTable->html();

        return view('media.aparatList', $vars);
    }

    // Rendering DataTable
    public function aparatTable(AparatDataTable $dataTable) {
        return $dataTable->render('media.aparatList');
    }

    // Insert
    public function store(StoreAparatRequest $request,SuccessMessages $message) {

        foreach($request->get('products') as $product) {
            Media::updateOrCreate(
                ['id' => $request->get('id')],
                ['media_url' => $request->get('aparat_url'), 'product_id' => $product, 'type' => 1]
            );
        }

        return $this->getAction($request->get('button_action'));
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete(Media::class,$id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$request->get('id'));
    }
}
