<?php

namespace App\Orchid\Screens\Customers;

use Orchid\Screen\Screen;

class CustomerEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'CustomerEditScreen';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [];
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
        return [];
    }
}
