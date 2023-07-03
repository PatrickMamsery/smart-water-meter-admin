<?php

namespace App\Orchid\Layouts\Bills;

use App\Models\Bill;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;

class BillListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'bills';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('reference_number', 'Reference #')
                ->sort()
                ->render(function (Bill $bill) {
                    return $bill->reference_number;
                }),

            TD::make('title', 'Title')
                ->sort()
                ->render(function (Bill $bill) {
                    return $bill->title;
                }),

            TD::make('customer', 'Customer')
                ->sort()
                ->render(function (Bill $bill) {
                    return $bill->customer->name;
                }),

            TD::make('amount', 'Amount')
                ->sort()
                ->render(function (Bill $bill) {
                    return number_format($bill->amount);
                }),

            TD::make('bill_status', 'Status')
                ->render(function (Bill $bill) {
                    // add color to status
                    if ($bill->status == 'unpaid') {
                        return "<span class='text-warning'>Unpaid</span>";
                    } elseif ($bill->status == 'paid') {
                        return "<span class='text-success'>Paid</span>";
                    } elseif ($bill->status == 'overdue') {
                        return "<span class='text-danger'>Overdue</span>";
                    }
                }),

            TD::make('created_at', 'Date')
                ->sort()
                ->filter(TD::FILTER_DATE)
                ->render(function (Bill $bill) {
                    return $bill->created_at->toFormattedDateString();
                }),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (Bill $bill) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Button::make(__('Set Paid'))
                                ->icon('check')
                                ->method('setPaid')
                                ->parameters([
                                    'id' => $bill->id,
                                ])
                                ->canSee($bill->status == 'unpaid'),

                            Button::make(__('Set Unpaid'))
                                ->icon('cross')
                                ->method('setUnpaid')
                                ->parameters([
                                    'id' => $bill->id,
                                ])
                                ->canSee($bill->status == 'paid'),
                                // ->rawClick()
                                // ->novalidate(),
                        ]);
                }),
        ];
    }
}
