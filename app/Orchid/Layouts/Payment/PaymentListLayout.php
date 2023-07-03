<?php

namespace App\Orchid\Layouts\Payment;

use App\Models\Payment;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;

class PaymentListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'payments';

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
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Payment $payment) {
                    return $payment->reference_number;
                }),

            TD::make('title', 'Title')
                ->sort()
                ->cantHide()
                ->filter(TD::FILTER_TEXT)
                ->render(function (Payment $payment) {
                    return $payment->title;
                }),

            // TD::make('customer', 'Customer')
            //     ->sort()
            //     ->render(function (Payment $payment) {
            //         return $payment->customer->name;
            //     }),

            TD::make('amount', 'Amount')
                ->sort()
                ->render(function (Payment $payment) {
                    return number_format($payment->amount);
                }),

            TD::make('payment_method', 'Payment Method')
                ->sort()
                ->render(function (Payment $payment) {
                    return $payment->payment_method;
                }),

            TD::make('updated_at', 'Last edit')
                ->sort()
                ->render(function (Payment $payment) {
                    return $payment->updated_at->diffForHumans();
                }),
        ];
    }
}
