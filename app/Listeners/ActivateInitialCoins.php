<?php

namespace App\Listeners;

use App\Plan;
use App\Rating;
use Illuminate\Auth\Events\Verified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ActivateInitialCoins
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        $user = $event->user;

        // Cuando se verifica el email se crea un rating inicial y se le asigna el plan free

        Rating::create([
            'value' => 3,
            'user_id' => $user->id,
        ]);

        $user->plans()->attach([1]);
    }
}
