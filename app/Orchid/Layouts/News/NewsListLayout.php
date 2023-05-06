<?php

namespace App\Orchid\Layouts\News;

use App\Models\News;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NewsListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'news';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('title','Title')
                ->render(function(News $news){
                    return Link::make($news->title)
                    ->route('platform.news.edit',$news);
                }),
            TD::make('created_at', 'Created'),
        ];
    }
}
