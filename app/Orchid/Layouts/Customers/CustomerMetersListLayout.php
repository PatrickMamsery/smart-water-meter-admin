<?php

namespace App\Orchid\Layouts\Customers;

use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CustomerMetersListLayout extends Table
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
            TD::make('meter_number', 'Meter Number')
                ->sort()
                ->render(function ($meter) {
                    return $meter->meter_number;
                }),

            TD::make('meter_type', 'Meter Type')
                ->sort()
                ->render(function ($meter) {
                    return $meter->meter_type;
                }),

            TD::make('meter_status', 'Meter Status')
                ->sort()
                ->render(function ($meter) {
                    // return meter status and blinking dot depending on the status
                    return $meter->meter_status . ' <span class="badge badge-' . ($meter->meter_status == 'active' ? 'success' : 'danger') . '">dot</span>';
                }),

            TD::make('meter_location', 'Meter Location')
                ->sort()
                ->render(function ($meter) {
                    return $meter->meter_location;
                }),

            TD::make('actions', 'Actions')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function ($meter) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            ModalToggle::make('Edit')
                                ->icon('pencil')
                                ->modal('editMeterModal')
                                ->method('editMeter')
                                ->modalTitle('Edit Meter')
                                ->asyncParameters([
                                    'meter' => $meter->id,
                                ]),

                            ModalToggle::make('View')
                                ->icon('eye')
                                ->modal('viewMeterModal')
                                ->method('viewMeter')
                                ->modalTitle('View Meter')
                                ->asyncParameters([
                                    'meter' => $meter->id,
                                ]),
                        ]);
                }),
        ];
    }
}
