<?php

namespace App\Http\Livewire\Traits;

use App\Repositories\UserRepository;

trait WithUserStatus
{
    public $userStatus = [];

    public function setUserStatus()
    {
        $repository = new UserRepository();

        $this->userStatus = $repository->status();
    }
}
