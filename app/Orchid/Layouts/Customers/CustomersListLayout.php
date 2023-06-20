<?php

namespace App\Orchid\Layouts\Customers;

use App\Models\User;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CustomersListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'customers';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('name', 'Name')
                ->sort()
                ->render(function ($customer) {
                    return Link::make($customer->name)
                        ->route('platform.customer.details', $customer->id);
                }),

            TD::make('email', 'Email')
                ->sort()
                ->render(function ($customer) {
                    return $customer->email;
                }),

            TD::make('phone', 'Phone')
                ->sort()
                ->render(function ($customer) {
                    return $customer->phone;
                }),

            TD::make('customerDetail.address', 'Address')
                ->sort()
                ->render(function ($customer) {
                    return $customer->customerDetail ? $customer->customerDetail->address : '<div class="text-danger">No address</div>';
                }),

            TD::make('meters', 'Meter Count')
                ->sort()
                ->render(function ($customer) {
                    // return meter count together with an icon
                    return $customer->meters->count() . ' <i class="fa fa-eye"></i>';
                }),

            TD::make('created_at', 'Created')
                ->sort()
                ->filter(TD::FILTER_DATE)
                ->render(function ($customer) {
                    return $customer->created_at->toFormattedDateString();
                }),

            TD::make('actions', 'Actions')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (User $customer) {
                    return DropDown::make()
                        ->icon('options-vertical')
                        ->list([
                            Link::make(__('Edit'))
                                ->route('platform.customer.edit', $customer->id)
                                ->icon('pencil'),
                            ModalToggle::make(__('View'))
                                ->modal('viewCustomerModal')
                                ->method('viewCustomer')
                                ->icon('eye')
                                ->asyncParameters([
                                    'customer' => $customer->id,
                                ]),
                        ]);
                })
        ];
    }
}
