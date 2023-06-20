<?php

namespace App\Orchid\Screens\Meter;

use Orchid\Screen\Screen;
use App\Models\Meter;
use App\Models\MeterReading;
use App\Orchid\Layouts\Meter\MeterTrendsLayout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;

class MeterTrends extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Meter Trends';

    public $description = 'Trends in meter';

    public $meter;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Meter $meter): array
    {
        $this->exists = $meter->exists;

        if ($this->exists) {
            $this->meter = Meter::find($meter->id);
            $this->name = 'Meter No. '. $meter->meter_number . ' | Trends | Readings';
        }

        return [
            'meter_readings' => MeterReading::where('meter_id', $meter->id)->latest('updated_at')->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            ModalToggle::make('Preview Meter Details')
                ->modal('previewMeterDetailsModal')
                ->icon('eye')
                ->modalTitle('Meter Details')
                ->asyncParameters([
                    'meter' => $this->meter->id,
                ]),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::modal('previewMeterDetailsModal', [
                Layout::rows([
                    Input::make('meter.meter_number')
                        ->disabled()
                        ->title('Meter Number'),

                    Input::make('meter.customer.name')
                        ->disabled()
                        ->title('Customer')
                ])
            ])->async('asyncGetMeterDetails'),

            MeterTrendsLayout::class
        ];
    }

    public function asyncGetMeterDetails(Meter $meter)
    {
        return [
            'meter' => $meter,
        ];
    }
}
