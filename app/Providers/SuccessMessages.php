<?php

namespace App\Providers;


class SuccessMessages {
    /**
     * Success Messages
     * 
     * @return void
    */

    // Insert
    public function getInsert() {
        return '<div class="alert alert-success right-direction">اطلاعات با موفقیت ثبت شد</div>';
    }

    // Update
    public function getUpdate() {
        return '<div class="alert alert-success right-direction">اطلاعات با موفقیت ویرایش شد</div>';
    }
    
}


?>