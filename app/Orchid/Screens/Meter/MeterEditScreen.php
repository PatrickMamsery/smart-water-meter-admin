<?php

namespace App\Orchid\Screens\Meter;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\Meter;
use App\Models\User;

class MeterEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Meter';
    public $meter;

    public $description = 'Create new meter details';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Meter $meter): array
    {
        $this->exists = $meter->exists;

        if ($this->exists) {
            $this->description = 'Edit meter details';
        }

        return [
            'meter' => $meter,
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
            Button::make('Create')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('delete')
                ->canSee($this->exists)
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

            Layout::rows([
                Group::make([
                    Input::make('meter.meter_number')
                        ->title('Meter Number')
                        ->type('number')
                        ->required()
                        ->placeholder('Meter Number')
                        ->help('Enter the meter number'),

                    Select::make('meter.meter_type')
                        ->title('Meter Type')
                        ->options([
                            'prepaid' => 'Prepaid',
                            'postpaid' => 'Postpaid',
                        ])
                        ->help('Select the meter type'),

                    Select::make('meter.meter_status')
                        ->title('Meter Status')
                        ->options([
                            'active' => 'Active',
                            'inactive' => 'Inactive',
                        ])
                        ->help('Select the meter status'),
                ]),

                Group::make([
                    Input::make('meter.meter_location')
                        ->title('Meter Location')
                        ->placeholder('Meter Location')
                        ->help('Enter the meter location'),

                    Select::make('meter.customer_id')
                        ->title('Customer')
                        ->fromModel(User::class, 'name')
                        ->help('Select the customer'),
                ]),

            ])
        ];
    }

    public function createOrUpdate(Meter $meter, Request $request)
    {
        $meter->fill($request->get('meter'))->save();

        // add logs
        addLog('edit', "$meter->meter_number created by " . auth()->user()->name, "dashboard");

        Alert::info('You have successfully created meter details.');

        return redirect()->route('platform.meters');
    }
}
