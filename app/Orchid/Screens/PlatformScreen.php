<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Layouts\ChartsLayout;
use App\Orchid\Layouts\OverviewMetrics;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

use App\Models\User;
use App\Models\CustomRole;

class PlatformScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Smart Water Meter API Dashboard';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Welcome to Smart Water Meter API Dashboard';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $clients = User::where('role_id', CustomRole::where('name', 'client')->first()->id)->count();
        $revenue = 100000;
        $meters = 10;
        $metrics = 3;

        return [
            'metrics' => [
                ['keyValue' => number_format($clients, 0), 'keyDiff' => 0],
                ['keyValue' => number_format($revenue, 0), 'keyDiff' => 0],
                ['keyValue' => number_format($meters, 0), 'keyDiff' => 0],
                ['keyValue' => number_format($metrics, 0), 'keyDiff' => 0],
            ],
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
            Link::make('Go to Site')
                ->href('https://api.smartwatermeter.patrickmamsery.works')
                ->icon('globe-alt')
                ->target('_blank'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            // ChartsLayout::class
            OverviewMetrics::class,

            Layout::view('home')
        ];
    }
}
