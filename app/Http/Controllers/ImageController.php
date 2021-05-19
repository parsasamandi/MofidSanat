<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Media;
use App\Models\Product;
use App\DataTables\ImageDataTable;
use App\DataTables\MediaDataTable;
use App\Providers\SuccessMessages;
use App\Http\Requests\StoreImageRequest;
use App\Providers\Action;
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

    // Store image
    public function store(StoreImageRequest $request,SuccessMessages $message) {

        foreach($request->get('products') as $product) {
            // If there were any picture
            if($request->hasFile('image')) {
                
                $image = $request->file('image');
                $file = $image->getClientOriginalName();
                $image->move(public_path('images'), $file);

                Media::updateOrCreate(
                    ['id' => $request->get('id')],
                    ['media_url' => $file, 'product_id' => $product, 'type' => 0]
                );
            }
        }

        return $this->getAction($request->get('button_action'));
    }

    // Edit
    public function edit(Action $action,Request $request) {
        return $action->edit(Media::class,$requst->get('id'));
    }
    
    // Delete
    public function delete(Action $action, $id) {
        return $action->deleteWithImage(Media::class,$id,'media_url');
    }
}
