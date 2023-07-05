<?php

namespace App\Orchid\Layouts\Meter;

use App\Models\MeterReading;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MeterTrendsLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'meter_readings';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            // TD::make('flow_rate', 'Flow Rate (Lts/sec)')
            //     ->sort(TD::FILTER_TEXT)
            //     ->render(function (MeterReading $meterReading) {
            //         return $meterReading->flow_rate;
            //     }),

            TD::make('units', 'Units')
                ->sort(TD::FILTER_NUMERIC)
                ->render(function (MeterReading $meterReading) {
                    return $meterReading->total_volume / config('constants.UNIT_CONVERSION_FACTOR');
                }),

            TD::make('volume', 'Volume (Lts)')
                ->render(function (MeterReading $meterReading) {
                    return number_format($meterReading->total_volume);
                }),

            TD::make('status', 'Status')
                ->render(function (MeterReading $meterReading) {
                    return $meterReading->meter_reading_status;
                }),

            TD::make('date', 'Read Date')
                ->render(function (MeterReading $meterReading) {
                    return $meterReading->meter_reading_date->toFormattedDateString();
                }),
        ];
    }
}
