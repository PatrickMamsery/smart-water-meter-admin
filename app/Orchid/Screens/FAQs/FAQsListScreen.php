<?php

namespace App\Orchid\Screens\FAQs;

use Orchid\Screen\Screen;
use App\Models\Faq;
use App\Orchid\Layouts\FAQs\FAQsLayoutScreen;
use Orchid\Screen\Actions\Link;

class FAQsListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */

    public $name = 'Frequent asked Questions';
    public $description = 'List of all questions';


    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'faq'=>Faq::paginate()

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
            Link::make('Create')
                ->icon('pencil')
                ->route('platform.faqs.faq')
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
            FAQsLayoutScreen::class
        ];
    }
}
