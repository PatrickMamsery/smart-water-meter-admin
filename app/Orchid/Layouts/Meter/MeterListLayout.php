<?php

namespace App\Orchid\Layouts\Meter;

use App\Models\Meter;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;

class MeterListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'meters';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('number', 'Meter Number')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Meter $meter) {
                    return Link::make($meter->meter_number)
                        ->route('platform.meter.trends', $meter);
                }),

            TD::make('customer', 'Customer')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Meter $meter) {
                    return $meter->customer->name;
                }),

            TD::make('status', 'Status')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Meter $meter) {
                    return $meter->meter_status;
                }),

            TD::make('updated_at', 'Last edit')
                ->sort()
                ->filter(TD::FILTER_DATE)
                ->render(function (Meter $meter) {
                    return $meter->updated_at->diffForHumans();
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Meter $meter) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([

                            Link::make(__('Edit'))
                                ->route('platform.meter.edit', $meter->id)
                                ->icon('pencil'),

                            // Button::make(__('Delete'))
                            //     ->method('remove')
                            //     ->confirm(__('Are you sure you want to delete the meter?'))
                            //     ->parameters([
                            //         'id' => $meter->id,
                            //     ])
                            //     ->icon('trash'),
                        ]);
                }),
        ];
    }
}
