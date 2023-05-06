<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Metric;


class OverviewMetrics extends Metric
{
    /**
     * Get the labels available for the metric.
     *
     * @return array
     */
    protected $labels = [
        'Clients',
        'Revenue',
        'Meters',
        'Metrics'
    ];

    /**
     * The name of the key to fetch it from the query.
     *
     * @var string
     */
    protected $target = 'metrics';
}
