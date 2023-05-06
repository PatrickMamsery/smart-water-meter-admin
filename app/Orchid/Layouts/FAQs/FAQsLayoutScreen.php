<?php

namespace App\Orchid\Layouts\FAQs;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;

class FAQsLayoutScreen extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'faq';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): array
    {
        return [
            TD::make('question','Question')
            ->render(function($faq){
                return Link::make($faq->question)
                    ->icon('question')
                    ->route('platform.faqs.faq',$faq);
            }),
        ];
    }
}
