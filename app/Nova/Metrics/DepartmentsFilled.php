<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use App\Models\Log;

class DepartmentsFilled extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $logs = Log::distinct('hook_id')->filled()->get();

        $data = [];
        foreach ($logs as $log) {
            if (!$log->hook->target->departments) {
                continue;
            }
            foreach ($log->hook->target->departments as $department) {
                $name = $department->name;
                if (!isset($data[$name])) {
                    $data[$name] = 1;
                } else {
                    $data[$name]++;
                }
            }
        }

        return $this->result($data);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'departments-filled';
    }
}
