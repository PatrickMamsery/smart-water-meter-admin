<?php

namespace App\Orchid\Screens\Meter;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Meter\MeterListLayout;
use App\Models\Meter;

class MeterListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Meters';

    public $description = 'List of all meters registered in the system';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'meters' => Meter::filters()->defaultSort('id')->latest('updated_at')->paginate(),
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
            Link::make('Create new meter')
                ->icon('plus')
                ->route('platform.meter.edit', null),
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
            MeterListLayout::class,
        ];
    }
}
