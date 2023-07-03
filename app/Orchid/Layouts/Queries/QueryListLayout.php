<?php

namespace App\Orchid\Layouts\Queries;

use App\Models\Query;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;

class QueryListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'queries';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('description', 'Content')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Query $query) {
                    return $query->description;
                }),

            TD::make('customer', 'Customer')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Query $query) {
                    return $query->customer->name;
                }),

            TD::make('query_date', 'Date')
                ->sort()
                ->filter(TD::FILTER_DATE)
                ->render(function (Query $query) {
                    return $query->query_date->toFormattedDateString();
                }),

            TD::make('query_status', 'Status')
                ->render(function (Query $query) {
                    // add color to status
                    if ($query->query_status == 'pending') {
                        return "<span class='text-warning'>Pending</span>";
                    } elseif ($query->query_status == 'resolved') {
                        return "<span class='text-success'>Resolved</span>";
                    } elseif ($query->query_status == 'rejected') {
                        return "<span class='text-danger'>Rejected</span>";
                    }
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Query $query) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            // buttons to respond to queries
                            Button::make('Resolve')
                                ->method('resolve')
                                ->icon('pencil')
                                ->parameters([
                                    'id' => $query->id,
                                ])
                                ->canSee($query->query_status == 'pending'),

                            Button::make('Reject')
                                ->method('reject')
                                ->icon('cross')
                                ->parameters([
                                    'id' => $query->id,
                                ])
                                ->canSee($query->query_status == 'pending'),

                            Button::make('Reopen')
                                ->method('reopen')
                                ->icon('reload')
                                ->parameters([
                                    'id' => $query->id,
                                ])
                                ->canSee($query->query_status == 'resolved' || $query->query_status == 'rejected'),
                        ]);
                }),

        ];
    }
}
