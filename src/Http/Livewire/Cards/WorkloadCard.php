<?php

namespace VincentBean\HorizonDashboard\Http\Livewire\Cards;

use Illuminate\Contracts\View\View;
use Laravel\Horizon\Contracts\WorkloadRepository;
use Laravel\Horizon\Repositories\RedisJobRepository;
use Livewire\Component;
use VincentBean\HorizonDashboard\Helpers\TimeHelper;

class WorkloadCard extends Component
{
    public function render(WorkloadRepository $workload, TimeHelper $timeHelper): View
    {
        $queues = collect($workload->get())
            ->map(function (array $workload) use ($timeHelper): array {

                $workload['wait'] = $timeHelper->secondsToTime($workload['wait']);

                return $workload;
            })->sortBy('name');

        return view('horizondashboard::livewire.cards.workload-card', ['queues' => $queues]);
    }
}
