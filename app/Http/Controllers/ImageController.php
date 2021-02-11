<?php

namespace App\Http\Controllers;
use App\DataTables\ImageDataTable;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreImageRequest;
use Illuminate\Http\Request;
use App\DataTables\MediaDataTable;
use App\Providers\Action;
use App\Models\Product;
use Response;


class ImageController extends Controller
{
    // DataTable To Blade
    public function list(Request $request) {
        $dataTable = new ImageDataTable;

        $vars['imageTable'] = $dataTable->html();

        return view('media.imageList', $vars);
    }

    // Rendering DataTable
    public function imageTable(ImageDataTable $dataTable) {
        return $dataTable->render('media.imageList');
    }

    // Store
    public function store(StoreImageRequest $request,SuccessMessages $message) {

        // Insert
        if($request->get('button_action') == 'insert') {
            $this->addImage($request);
            $success_output = $message->getInsert();
        }
        // Update
        else if($request->get('button_action') == 'update') {
            $this->addImage($request);
            $success_output = $message->getUpdate();
        }
        
        $output = array(
            'success' => $success_output
        );

        return json_encode($output);
    }

    // Add Image
    public function addImage($request) {
        // If there were any picture
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file = $image->getClientOriginalName();
            $image->move(public_path('images'), $file);
        }
        Media::updateOrCreate(
            ['id' => $request->get('id')],
            ['media_url' => $file, 'product_id' => $request->get('productSelect'), 'type' => 0]
        );
    }

    // Edit
    public function delete(Request $request, $id) {
        return $action->deleteWithImage(Media::class,$id,'media_url');
    }

    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$requst->get('id'));
    }


}
