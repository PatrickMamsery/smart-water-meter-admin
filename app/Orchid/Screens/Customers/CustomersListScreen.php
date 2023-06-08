<?php

namespace App\Orchid\Screens\Customers;

use App\Models\CustomRole;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Customers\CustomersListLayout;

use App\Models\User;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;

class CustomersListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Customers';

    /**
     * Display header description.
     *
     * @var string|null
     */

    public $description = 'List of all customers in the system.';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $role = CustomRole::where('name', 'client')->orWhere('name', 'customer')->first();

        return [
            'customers' => User::with('customerDetail', 'meters')->where('role_id', $role->id)->paginate()
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
            Link::make(__('Add new customer'))
                ->icon('plus')
                ->route('platform.customer.edit', null),
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
            Layout::modal('viewCustomerModal', [
                Layout::rows([
                    Input::make('customer.name')->disabled(),
                ])
            ])->title('Customer Details')->applyButton('Close')->async('asyncGetCustomer'),

            CustomersListLayout::class
        ];
    }

    public function asyncGetCustomer(User $customer): array
    {
        return [
            'customer' => $customer
        ];
    }
}
