<?php

namespace App\Orchid\Screens\Bills;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Illuminate\Http\Request;
use App\Orchid\Layouts\Bills\BillListLayout;
use App\Models\Bill;
use Orchid\Support\Facades\Toast;

class BillListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Bills';

    public $description = 'List of all bills in the system, created by customers paying via CASH';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'bills' => Bill::latest('updated_at')->paginate(),
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
            BillListLayout::class,
        ];
    }

    public function setPaid(Request $request): void
    {
        Bill::findOrFail($request->get('id'))->update(['status' => 'paid']);

        $billRefNo = Bill::findOrFail($request->get('id'))->reference_number;

        Toast::info('Bill marked as paid');

        // add logs
        addLog("edit", auth()->user()->name . " marked bill with refNo. #$billRefNo as paid", "dashboard");
    }

    public function setUnpaid(Request $request): void
    {
        Bill::findOrFail($request->get('id'))->update(['status' => 'unpaid']);

        $billRefNo = Bill::findOrFail($request->get('id'))->reference_number;

        Toast::info('Bill marked as unpaid');

        // add logs
        addLog("edit", auth()->user()->name . " marked `$billRefNo`bill as unpaid", "dashboard");
    }
}
