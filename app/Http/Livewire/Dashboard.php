<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Repositories\BrandRepository;
use App\Repositories\FarmerRepository;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Dashboard extends Component
{
    public $pageTitle = 'Demandas';
    public $icon = 'fas fa-list';

    public $startDate;
    public $finalDate;


    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
