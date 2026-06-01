<?php

namespace App\Observers;

use App\Models\Raise;

class RaiseObserver
{
    /**
     * Handle the Raise "created" event.
     *
     * @param  \App\Models\Raise  $raise
     * @return void
     */
    public function created(Raise $raise)
    {
        //
    }

    /**
     * Handle the Raise "updated" event.
     *
     * @param  \App\Models\Raise  $raise
     * @return void
     */
    public function updated(Raise $raise)
    {
        //
    }

    /**
     * Handle the Raise "deleted" event.
     *
     * @param  \App\Models\Raise  $raise
     * @return void
     */
    public function deleted(Raise $raise)
    {
        //
    }

    /**
     * Handle the Raise "restored" event.
     *
     * @param  \App\Models\Raise  $raise
     * @return void
     */
    public function restored(Raise $raise)
    {
        //
    }

    /**
     * Handle the Raise "force deleted" event.
     *
     * @param  \App\Models\Raise  $raise
     * @return void
     */
    public function forceDeleted(Raise $raise)
    {
        //
    }
}
