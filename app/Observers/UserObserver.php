<?php

namespace App\Observers;

use App\Rating;
use App\User;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->uuid = $this->generateStringUnique();
		$user->commercial_name = $user->name;
    }

    private function generateStringUnique(): string
    {
        $isUnique = false;
        $uuid = str_random(5);
        $allUuid = $this->getAllUuid();

        if ($this->isUnique($allUuid, $uuid)) {
            return $uuid;
        }

        while (!$isUnique) {
            $uuid = str_random(5);
            $isUnique = $this->isUnique($allUuid, $uuid);
        }

        return $uuid;
    }
    
    private function getAllUuid()
    {
        return User::select('uuid')->get();
    }

    private function isUnique($allUuid, $uuid): bool
    {
        return !$allUuid->contains('uuid', $uuid);
    }

    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        $intial_rating = Rating::create([
			'value' => 3,
			'user_id' => $user->id,
		]);
		$user->plans()->attach([1]);
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
