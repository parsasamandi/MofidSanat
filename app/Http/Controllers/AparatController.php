<?php

namespace App\Http\Controllers;
use App\DataTables\AparatDataTable;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StoreAparatRequest;
use App\Models\Media;
use Illuminate\Http\Request;

class AparatController extends Controller
{
    // List
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
        // Update
        $aparat = Media::find($request->get('id'));
        if(!$aparat) {
            $aparat = new Media;
        }
        $aparat->media_url = $request->get('aparat_url');
        $aparat->product_id = $request->get('productSelect');
        $aparat->type = 1;

        $aparat->save();
    }

    // Delete
    public function delete(Request $request, $id) {
        $media = Media::find($id);
        if($media) {
            $media->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([],200);
    }

    // Edit
    public function edit(Request $request) {
        $media = Media::find($request->get('id'));
        return json_encode($media);
    }
}
