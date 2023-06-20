<?php

namespace App\Orchid\Screens\Logs;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use Orchid\Support\Facades\Layout;
use App\Orchid\Layouts\Logs\LogsListLayout;

use Illuminate\Http\Request;

use App\Models\Log as CustomLog;

class LogsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Logs';

    public $description = 'Log of all actions performed';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'logs' => CustomLog::with('actor')->latest('updated_at')->paginate(),
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
            LogsListLayout::class
        ];
    }
}
