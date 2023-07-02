<?php

declare(strict_types=1);

namespace App\Orchid\Screens;

use App\Orchid\Layouts\ChartsLayout;
use App\Orchid\Layouts\OverviewMetrics;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Carbon\Carbon;

use App\Models\Payment;
use App\Models\User;
use App\Models\CustomRole;
use App\Orchid\Layouts\Charts\PaymentsChart;

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
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now();
        $dates = [];

        while ($startDate <= $endDate) {
            $formattedDate = $startDate->format('M-Y');
            $dates[] = $formattedDate;

            // sum payments daily and then get them in an array
            $paymentAmount = Payment::whereYear('created_at', $startDate->year)
                ->whereMonth('created_at', $startDate->month)
                ->sum('amount');
            $paymentAmounts[] = $paymentAmount;

            // $incomeAmount = Income::whereYear('created_at', $startDate->year)
            //     ->whereMonth('created_at', $startDate->month)
            //     ->sum('amount');
            // $incomeAmounts[] = $incomeAmount;

            $startDate->addMonth();
        }

        $payments_data = [
            [
                'labels' => $dates,
                'name' => 'Payment',
                'values' => $paymentAmounts
            ]
        ];

        // dd($payments_data);

        $clients = User::where('role_id', CustomRole::where('name', 'client')->first()->id)->count();
        $revenue = Payment::all()->sum('amount');
        $meters = 10;
        $metrics = 3;

        return [
            'metrics' => [
                ['keyValue' => number_format($clients, 0), 'keyDiff' => 0],
                ['keyValue' => number_format($revenue, 0), 'keyDiff' => 0],
                ['keyValue' => number_format($meters, 0), 'keyDiff' => 0],
                ['keyValue' => number_format($metrics, 0), 'keyDiff' => 0],
            ],

            'payments_data' => $payments_data,
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
            // Link::make('Go to Site')
            //     ->href('https://api.smartwatermeter.patrickmamsery.works')
            //     ->icon('globe-alt')
            //     ->target('_blank'),
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

            Layout::columns([
                PaymentsChart::class,
            ]),

            // Layout::view('home')
        ];
    }
}
