<?php

namespace App\Http\Controllers;
use App\DataTables\ImageDataTable;
use App\Models\Media;
use Illuminate\Support\Facades\Validator;
use App\Providers\SuccessMessages;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\DataTables\MediaDataTable;
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
    public function store(Request $request,SuccessMessage $message) {

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
        $media = Media::find($request->get('id'));
        if(!$media) {
            $media = new Media;
        }

        // If there were any picture
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $file = $image->getClientOriginalName();
            $image->move(public_path('images'), $file);
            $media->media_url = $file;
        }

        $media->type = 0;
        $media->product_id = $request->get('productSelect');

        $media->save();
    }

    // Edit
    public function delete(Request $request, $id) {
        $media = Media::find($id);
        if($media) {
            $imageLocation = public_path("images/$media->media_url");
            if($imageLocation) {
                File::delete($imageLocation); 
            }
            $media->delete();
        }
        else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    public function edit(Request $request) {
        $media = Media::find($request->get('id'));
        return json_encode($media);
    }


}
