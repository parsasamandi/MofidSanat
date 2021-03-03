<?php

namespace App\Providers;
use File;

class Action {

    /**
     * Edit
     * 
     * @return json_encode
     */
    public function edit($model,$id) {
        try {
            $values = $model::find($id);
            return json_encode($values);
            
        } catch (Throwable $e) {
            return response()->json($e);
        }
    }

    /**
     * Delete
     * 
     * @return json_encode
     */
    public function delete($model,$id) {
        $values = $model::find($id);
        if ($values) {
            $values->delete();
        } else {
            return response()->json([], 404);
        }
        return response()->json([], 200);
    }

    /**
     * Delete With Image
     * 
     * @return json_encode
     */
    public function deleteWithImage($model,$id,$column) {
        try {
            $modelImage = $model::find($id);
            if($modelImage) {
                $imageDelete = public_path("images/$modelImage->$column");
                if($imageDelete) {
                    File::delete($imageDelete); 
                }
                $modelImage->delete();
            }
        } catch(Throwable $e) {
            return response()->json($e);
        }
        return response()->json([],200);
    }

}

?>