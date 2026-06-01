<?php

namespace App\Observers;

use App\Models\CustomizedCategory;

class CustomizedCategoryObserver
{
    /**
     * Handle the CustomizedCategory "created" event.
     *
     * @param  \App\Models\CustomizedCategory  $customizedCategory
     * @return void
     */
    public function created(CustomizedCategory $customizedCategory)
    {
        //
    }

    /**
     * Handle the CustomizedCategory "updated" event.
     *
     * @param  \App\Models\CustomizedCategory  $customizedCategory
     * @return void
     */
    public function updated(CustomizedCategory $customizedCategory)
    {
        //
    }

    /**
     * Handle the CustomizedCategory "deleted" event.
     *
     * @param  \App\Models\CustomizedCategory  $customizedCategory
     * @return void
     */
    public function deleted(CustomizedCategory $customizedCategory)
    {
        //
    }

    /**
     * Handle the CustomizedCategory "restored" event.
     *
     * @param  \App\Models\CustomizedCategory  $customizedCategory
     * @return void
     */
    public function restored(CustomizedCategory $customizedCategory)
    {
        //
    }

    /**
     * Handle the CustomizedCategory "force deleted" event.
     *
     * @param  \App\Models\CustomizedCategory  $customizedCategory
     * @return void
     */
    public function forceDeleted(CustomizedCategory $customizedCategory)
    {
        //
    }
}
