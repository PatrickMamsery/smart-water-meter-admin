<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Orchid\Layouts\News\NewsListLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;

class NewsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'News';
    public $description = "All news";

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'news'=> News::paginate()
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
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.news.edit',null)
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
            NewsListLayout::class
        ];
    }
}
