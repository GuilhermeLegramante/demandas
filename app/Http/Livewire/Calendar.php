<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireCalendar;
use Illuminate\Support\Collection;

class Calendar extends LivewireCalendar
{
    public $pageTitle = 'Demandas';
    public $icon = 'fas fa-list';

    public function event(): Collection
    {
        return new Collection();
    }
}
