<?php

namespace App\Observers;

use App\Models\Subscribe;

class SubscribeObserver
{
    /**
     * Handle the Subscribe "created" event.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return void
     */
    public function created(Subscribe $subscribe)
    {
        //
    }

    /**
     * Handle the Subscribe "updated" event.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return void
     */
    public function updated(Subscribe $subscribe)
    {
        //
    }

    /**
     * Handle the Subscribe "deleted" event.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return void
     */
    public function deleted(Subscribe $subscribe)
    {
        //
    }

    /**
     * Handle the Subscribe "restored" event.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return void
     */
    public function restored(Subscribe $subscribe)
    {
        //
    }

    /**
     * Handle the Subscribe "force deleted" event.
     *
     * @param  \App\Models\Subscribe  $subscribe
     * @return void
     */
    public function forceDeleted(Subscribe $subscribe)
    {
        //
    }
}
