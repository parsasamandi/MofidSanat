<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\DataTables\ImageDataTable;
use App\DataTables\MediaDataTable;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreImageRequest;
use App\Providers\Action;
use App\Models\Media;
use App\Models\Product;
use Response;

class ImageController extends Controller
{
    // DataTable to blade
    public function list(Request $request) {
        
        $dataTable = new ImageDataTable;

        $vars['imageTable'] = $dataTable->html();

        return view('media.imageList', $vars);
    }

    // Rendering DataTable
    public function imageTable(ImageDataTable $dataTable) {
        return $dataTable->render('media.imageList');
    }

    // Store image
    public function store(StoreImageRequest $request) {

        foreach($request->get('products') as $product) {
            // If there were any picture
            if($request->hasFile('image')) {

                $image = $request->file('image');
                $file = $image->getClientOriginalName();
                $image->move(public_path('images'), $file);

                Media::updateOrCreate(
                    ['id' => $request->get('id')],
                    ['media_url' => $file, 'media_id' => $product, 'media_type' => Product::class, 'type' => Media::IMAGE]
                );
            }
        }

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class, $request->get('id'));
    }
    
    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Media::class, $id, 'media_url');
    }
}
