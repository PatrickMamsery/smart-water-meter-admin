<?php

namespace App\Orchid\Screens\Customers;

use App\Models\CustomerDetail;
use App\Models\CustomRole;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Group;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

use Illuminate\Http\Request;

use App\Models\User;

class CustomerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Customer';

    public $description = 'Create new customer details';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(User $customer): array
    {
        $this->exists = $customer->exists;

        if ($this->exists) {
            $this->description = 'Edit customer details';
        }

        return [
            'customer' => $customer,
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
            Button::make('Create')
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee(!$this->exists),

            Button::make('Update')
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee($this->exists),

            Button::make('Delete')
                ->icon('trash')
                ->method('delete')
                ->canSee($this->exists)
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        /**
         * required: name, email, phone, address
         */
        return [
            Layout::rows([
                Group::make([
                    Input::make('customer.name')
                        ->title('Name')
                        ->placeholder('Name')
                        ->help('Customer name')
                        ->required(),

                    Input::make('customer.email')
                        ->title('Email')
                        ->type('email')
                        ->placeholder('Email')
                        ->help('Customer email')
                        ->required(),
                ]),

                Group::make([
                    Input::make('customer.phone')
                        ->title('Phone')
                        ->placeholder('Phone')
                        ->help('Customer phone')
                        ->required(),

                    Input::make('customer.address')
                        ->title('Address')
                        ->placeholder('Address')
                        ->help('Customer address')
                        ->required(),
                ]),
            ])
        ];
    }

    /**
     * @param Meter $meter
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(User $customer, Request $request)
    {
        $customer->role_id = CustomRole::where('name', 'customer')->orWhere('name', 'client')->first()->id;
        $customer->password = bcrypt($request->get('customer')['name']);
        $customer->fill($request->get('customer'))->save();

        // create customer details
        $customerDetails = new CustomerDetail();
        $customerDetails->customer_id = $customer->id;
        $customerDetails->address = $request->get('customer')['address'];
        $customerDetails->save();

        Alert::info('You have successfully created an customer.');

        return redirect()->route('platform.customers');
    }
}
