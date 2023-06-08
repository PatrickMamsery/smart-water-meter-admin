<?php

namespace App\Orchid\Screens\Customers;

use App\Models\Meter;
use App\Models\User;
use App\Orchid\Layouts\Customers\CustomerMetersListLayout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CustomerMetersListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Customer\'s Meters';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'List of all meters for this customer.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(User $customer): array
    {
        return [
            'meters' => Meter::where('customer_id', $customer->id)->latest('updated_at')->paginate()
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            // Edit meter modal
            Layout::modal('editMeterModal', [
                Layout::rows([
                    Input::make('meter.name')
                        ->title('Name')
                        ->placeholder('Enter meter name')
                        ->required(),

                    Input::make('meter.meter_number')
                        ->title('Meter Number')
                        ->placeholder('Enter meter number')
                        ->required(),

                    Input::make('meter.meter_type')
                        ->title('Meter Type')
                        ->placeholder('Enter meter type')
                        ->required(),

                    Input::make('meter.meter_status')
                        ->title('Meter Status')
                        ->placeholder('Enter meter status')
                        ->required(),

                    Input::make('meter.meter_location')
                        ->title('Meter Location')
                        ->placeholder('Enter meter location')
                        ->required(),
                ])
            ]),

            // view meter modal
            Layout::modal('viewMeterModal', [
                // Layout::rows()
            ]),

            CustomerMetersListLayout::class
        ];
    }
}
