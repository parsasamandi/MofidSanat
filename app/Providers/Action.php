<?php

namespace App\Providers;

class Action {
    /**
     * All Actions
     * 
     * Delete & Edit
     * 
     * @return void
     */

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
        try {
            $model::find($id)->delete();
            return response()->json([],200);
        } catch (Throwable $e) {
            return response()->json($e);
        }

    }

}

?>