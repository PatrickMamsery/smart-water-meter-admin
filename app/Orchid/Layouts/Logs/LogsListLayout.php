<?php

namespace App\Orchid\Layouts\Logs;

use App\Models\Log as CustomLog;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class LogsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'logs';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        // action, platform, actor, description
        return [
            TD::make('action', 'Action')
                ->sort()
                ->render(function (CustomLog $log) {
                    // add color to action
                    if ($log->action == 'edit') {
                        return "<span class='text-info'>Edit</span>";
                    } elseif ($log->action == 'delete') {
                        return "<span class='text-danger'>Delete</span>";
                    } elseif ($log->action == 'access') {
                        return "<span class='text-success'>Access</span>";
                    } else {
                        return "<span class='text-dark'>Unknown</span>";
                    }
                }),

            TD::make('platform', 'Platform')
                ->sort()
                ->render(function (CustomLog $log) {
                    return ucfirst($log->platform);
                }),

            TD::make('actor', 'Actor')
                ->sort()
                ->render(function (CustomLog $log) {
                    return ucfirst($log->actor->name);
                }),

            TD::make('description', 'Description')
                ->sort()
                ->render(function (CustomLog $log) {
                    return $log->description;
                }),

            TD::make('created_at', 'Created')
                ->sort()
                ->render(function (CustomLog $log) {
                    return $log->created_at->toFormattedDateString();
                }),
        ];
    }
}
