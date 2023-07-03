<?php

namespace App\Orchid\Screens\Queries;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use App\Orchid\Layouts\Queries\QueryListLayout;
use App\Models\Query;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class QueryListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Queries';

    public $description = 'List of all queries submitted by customers';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'queries' => Query::filters()->defaultSort('id')->latest('updated_at')->paginate(),
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
            QueryListLayout::class,
        ];
    }

    public function resolve(Request $request): void
    {
        Query::findOrFail($request->get('id'))->update(['query_status' => 'resolved']);

        // get query description with ellipsis for trimmed content
        $query = Query::findOrFail($request->get('id'));
        $query_description = strlen($query->description) > 50 ? substr($query->description, 0, 50) . "..." : $query->description;

        Toast::info('Query resolved successfully');

        // add logs
        addLog("edit", auth()->user()->name . " resolved query $query_description", "dashboard");
    }

    public function reject(Request $request): void
    {
        $query = Query::findOrFail($request->get('id'));
        $query_description = strlen($query->description) > 50 ? substr($query->description, 0, 50) . "..." : $query->description;

        Query::findOrFail($request->get('id'))->update(['query_status' => 'rejected']);

        Toast::info('Query rejected successfully');

        // add logs
        addLog("edit", auth()->user()->name . " rejected query $query_description", "dashboard");
    }

    public function reopen(Request $request): void
    {
        Query::findOrFail($request->get('id'))->update(['query_status' => 'pending']);

        Toast::info('Query reopened successfully');
    }
}
