<?php

namespace App\Orchid\Screens\News;

use App\Models\News;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\NewsTag;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Cropper;
use Orchid\Support\Facades\Alert;

class NewsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Create News';

    public $description = 'Create news';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(News $news): array
    {
        $this->exists = $news->exists;

        if($this->exists) $this->description='Update news ';

        return [
            'news' => $news
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
            Button::make('create')
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
        return [
            Layout::rows([

                Group::make([
                    Input::make('news.title')
                    ->title('Title')
                    ->required()
                    ->placeholder('Enter News Title'),

                Relation::make('user.')
                    ->title('Created by:')
                    ->fromModel(User::class,'email')
                ]),
                

                Cropper::make('news.image_path')
                    ->title('Image upload'),

                

                
                Quill::make('news.content')
                    ->title('Content')
                    ->required()
                    ->placeholder('insert text here ...')
            ])
        ];
    }

    public function createOrUpdate(News $news,Request $request )
    {


       $news->fill($request->get('news'))->save();

        Alert::info('News is created successfully');

        return redirect()->route('platform.news');
    }


    public function delete(News $news)
    {
        $news->delete();

        Alert::info('You have successfully deleted a question.');

        return redirect()->route('platform.news');
    }
}
