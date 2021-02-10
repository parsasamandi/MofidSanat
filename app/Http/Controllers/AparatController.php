<?php

namespace App\Http\Controllers;
use App\DataTables\AparatDataTable;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAparatRequest;
use App\Providers\Action;
use App\Models\Media;
use Illuminate\Http\Request;

class AparatController extends Controller
{
    public $media = '\App\Models\Media';
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

        // Insert
        if($request->get('button_action') == 'insert') {
            $this->addAparat($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->addAparat($request);
            $success_output = $message->getUpdate();
        }

        $output = array('success' => $success_output);

        return json_encode($output);

    }

    //  Add Aparat
    public function addAparat(Request $request) {
        Media::updateOrCreate(
            ['id' => $request->get('id')],
            ['media_url' => $request->get('aparat_url'), 'product_id' => $request->get('productSelect'), 'type' => 1]
        );
    }

    // Delete
    public function delete(Action $action, $id) {
        return $action->delete($this->media,$id);
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit($this->media,$request->get('id'));
    }
}
