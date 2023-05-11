<?php

namespace App\Orchid\Screens\Payment;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Payment\PaymentListLayout;
use App\Models\Payment;

class PaymentListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Payments';

    public $description = 'List of all payments made in the system';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'payments' => Payment::latest('updated_at')->paginate(),
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
            PaymentListLayout::class,
        ];
    }
}
