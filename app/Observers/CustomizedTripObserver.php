<?php

namespace App\Observers;

use App\Models\CustomizedTrip;

class CustomizedTripObserver
{
    /**
     * Handle the CustomizedTrip "created" event.
     *
     * @param  \App\Models\CustomizedTrip  $customizedTrip
     * @return void
     */
    public function created(CustomizedTrip $customizedTrip)
    {
        //
    }

    /**
     * Handle the CustomizedTrip "updated" event.
     *
     * @param  \App\Models\CustomizedTrip  $customizedTrip
     * @return void
     */
    public function updated(CustomizedTrip $customizedTrip)
    {
        //
    }

    /**
     * Handle the CustomizedTrip "deleted" event.
     *
     * @param  \App\Models\CustomizedTrip  $customizedTrip
     * @return void
     */
    public function deleted(CustomizedTrip $customizedTrip)
    {
        //
    }

    /**
     * Handle the CustomizedTrip "restored" event.
     *
     * @param  \App\Models\CustomizedTrip  $customizedTrip
     * @return void
     */
    public function restored(CustomizedTrip $customizedTrip)
    {
        //
    }

    /**
     * Handle the CustomizedTrip "force deleted" event.
     *
     * @param  \App\Models\CustomizedTrip  $customizedTrip
     * @return void
     */
    public function forceDeleted(CustomizedTrip $customizedTrip)
    {
        //
    }
}
