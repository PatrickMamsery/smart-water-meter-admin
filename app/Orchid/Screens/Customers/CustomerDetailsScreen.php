<?php

namespace App\Orchid\Screens\Customers;

use App\Models\CustomerPayment;
use App\Models\Meter;
use App\Models\User;
use App\Models\Payment;
use App\Orchid\Layouts\Customers\CustomerMetersListLayout;
use App\Orchid\Layouts\Customers\CustomerPaymentsListLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class CustomerDetailsScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Customer\'s Details';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Details of this customer.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(User $customer): array
    {
        $this->exists = $customer->exists;

        if ($this->exists) {
            $this->name = $customer->name . '\'s Details';
        }

        return [
            'customer' => $customer,
            'meters' => Meter::where('customer_id', $customer->id)->latest('updated_at')->paginate(),
            'payments' => Payment::whereIn('id', CustomerPayment::where('customer_id', $customer->id)->pluck('id')->toArray())->latest('updated_at')->paginate()
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
            Layout::tabs([
                'Meters' => CustomerMetersListLayout::class,
                'Payments' => CustomerPaymentsListLayout::class,
            ])
        ];
    }
}
