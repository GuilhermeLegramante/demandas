<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithDatatable;
use App\Repositories\ClientRepository;
use App\Services\ArrayHandler;
use App\Services\PlanningMonth;
use App\Services\SessionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class PlanningTable extends Component
{
    use WithDatatable, WithPagination;

    public $pageTitle = 'Planejamento';
    public $icon = 'fas fa-calendar-alt';
    public $entity = 'demand';

    public $hasForm = true;

    protected $repositoryClass = 'App\Repositories\DemandRepository';

    public $filterClients = [];
    public $filterClientId;
    public $filterStartDate;
    public $filterFinalDate;

    public $year;
    public $month;
    public $day;

    public $date;

    public function mount()
    {
        SessionService::start();

        $repository = new ClientRepository();
        $this->filterClients = ArrayHandler::jsonDecodeEncode($repository->allSimplified()->sortBy('name'));

        $this->filterClientId = $this->filterClients[0]['id'];

        $date = Carbon::now();
        $this->year = $date->format('Y');
        $this->month = $date->format('m');
        $this->day = $date->format('d');

    }

    public function setClient($clientId)
    {
        $this->filterClientId = $clientId;
    }

    public function updatedDate()
    {
        $str = explode("-", $this->date);

        $this->year = $str[0];
        $this->month = $str[1];
    }

    public function setDate($direction)
    {
        if ($direction == 'asc') {
            if ($this->month == 12) {
                $this->month = 1;
                $this->year++;
            } else {
                $this->month++;
            }
        } else {
            if ($this->month == 1) {
                $this->month = 12;
                $this->year--;
            } else {
                $this->month--;
            }
        }

        $this->day = 1;

        $this->date = $this->year . '-' . $this->shiftZeroOnMonth();
    }

    public function setToday()
    {
        $date = Carbon::now();
        $this->year = $date->format('Y');
        $this->month = $date->format('m');
        $this->day = $date->format('d');
        $this->date = $this->year . '-' . $this->shiftZeroOnMonth();
    }

    private function shiftZeroOnMonth()
    {
        if ($this->month <= 9) {
            $month = sprintf("%02d", $this->month);
        } else {
            $month = $this->month;
        }

        return $month;
    }

    public function render()
    {
        $repository = App::make($this->repositoryClass);

        $data = $repository->all(
            null,
            null,
            $this->filterStartDate,
            $this->filterFinalDate,
            null,
            $this->filterClientId,
            null,
            [],
            $this->sortBy,
            $this->sortDirection,
            100,
        );

        $this->date = $this->year . '-' . $this->shiftZeroOnMonth();

        $planning = new PlanningMonth($this->year, $this->month, $this->day, $data);
        // $planning = new PlanningMonth(2023, 7, 1, $data);

        return view('livewire.planning-table', compact('planning'));
    }
}
