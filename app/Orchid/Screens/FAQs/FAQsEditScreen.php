<?php

namespace App\Orchid\Screens\FAQs;

use Orchid\Screen\Screen;
use App\Models\Faq;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class FAQsEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Question & Answer';
    public $description = 'Add new question with its answer below';
    public $exists= false;

    /**
     * Query data.
     *
     * @return array
     */
    public function query(Faq $faq): array
    {
            $this->exists = $faq->exists;

            if($this->exists) $description='Update question details';
           return [
              'faq'=>$faq
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
                
                Input::make('faq.question')
                    ->title('Question')
                    ->required(),
                
                Quill::make('faq.answer')
                    ->title('Answer')
                    ->required(),

                Select::make('faq.visibility')
                    ->title('Select Visibility')
                    ->options([
                        '1'=> 'Visible',
                        '0'=> 'Hidden'
                    ])
                
            ])
        ];
    }

    public function createOrUpdate(Faq $faq,Request $request)
    {
        // var_dump($request->all()); die;
        $faq->fill($request->get('faq'))->save();

        Alert::info('You have successfully created a question.');

        return redirect()->route('platform.faqs');

    }

    public function delete(Faq $faq)
    {
        $faq->delete();

        Alert::info('You have successfully deleted a question.');

        return redirect()->route('platform.faqs');
    }
}
