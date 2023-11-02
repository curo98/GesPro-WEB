<?php

namespace App\Charts;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;


class SupplierRequestChart extends LaravelChart
{
    public function getChartData()
    {
        $supplierRequests = \App\Models\SupplierRequest::all();

        $data = [];
        foreach ($supplierRequests as $supplierRequest) {
            $dayOfWeek = $supplierRequest->created_at->dayOfWeek;
            $data[$dayOfWeek] = $supplierRequests->where('created_at', 'like', $supplierRequest->created_at->format('Y-m-d') . '%')->count();
        }

        return $data;
    }
}
