<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use App\Models\Salary;
use MoonShine\UI\Fields\Date;
use MoonShine\Support\AlpineJs;
use MoonShine\UI\Fields\Number;
use MoonShine\Laravel\Pages\Page;
use MoonShine\UI\Fields\Position;
use MoonShine\UI\Fields\Textarea;
use Illuminate\Support\Facades\Auth;
use MoonShine\Support\Enums\JsEvent;
use MoonShine\Support\Attributes\Icon;
use App\MoonShine\Layouts\DriverLayout;
use MoonShine\UI\Components\Layout\Box;
use ForestLynx\MoonShine\Fields\Decimal;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\ActionButton;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\Laravel\TypeCasts\ModelCaster;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Pages\Crud\CrudPage;
use MoonShine\UI\Components\Table\TableBuilder;

#[Icon('trophy')]
class TestPage extends Page
{
    protected ?string $layout = DriverLayout::class;
    /**
     * @return array<string, string>
     */
    public function getBreadcrumbs(): array
    {
        return [
            '#' => $this->getTitle()
        ];
    }

    public function getTitle(): string
    {
        return __('moonshine::ui.title.salaries');
    }

    public function getSubtitle(): string
    {
        return $this->subtitle ?: 'Подзаголовок';
    }

    protected function getCollection()
    {
        $salaries = Salary::where('driver_id', Auth::user()->id)
            // ->where('profit_id', 0)
            // ->with('driver')
            //->with('log')
            ->orderByDesc('date')
            ->get();

        return $salaries;
    }

    /**
     * @return list<ComponentContract>
     */
    protected function components(): iterable
    {
        return [
            Grid::make([
                Column::make([
                    Box::make([
                        FormBuilder::make()
                            ->name('salary-form')
                            ->fields([
                                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field'),
                                Decimal::make('salary', 'salary')
                                    ->unit('unit', ['руб.'])->unitDefault(0)
                                    ->translatable('moonshine::ui.field'),
                                Textarea::make('comment')->translatable('moonshine::ui.field'),
                            ])
                            ->fill([
                                'date' => now()
                            ])
                            ->cast(new ModelCaster(Salary::class))
                            ->action('#')
                            ->submit(
                                label: 'Click me',
                                attributes: ['class' => 'btn-primary']
                            )
                            ->async(
                                events: [
                                    AlpineJs::event(JsEvent::TABLE_UPDATED, 'salary-table'),
                                    AlpineJs::event(JsEvent::FORM_RESET, 'salary-form'),
                                ]
                            ),
                    ])
                ])->columnSpan(3),
                Column::make([
                    Box::make([
                        TableBuilder::make()
                            ->name('salary-table')
                            ->cast(new ModelCaster(Salary::class))
                            ->items($this->getCollection())
                            ->fields([
                                Position::make(),
                                Date::make('date')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
                                Number::make('salary')->translatable('moonshine::ui.field')->sortable(),
                                Textarea::make('comment')->translatable('moonshine::ui.field'),
                                Date::make('created_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
                                Date::make('updated_at')->format('d.m.Y')->translatable('moonshine::ui.field')->sortable(),
                            ])
                            ->buttons([
                                ActionButton::make('Edit', fn() => route('salary.list')),
                                ActionButton::make('Delete', fn() => route('salary.list')),
                            ])
                            ->withNotFound()
                            ->creatable(
                                button: ActionButton::make('Foo', '#')
                            )
                            // ->paginator(
                            //     (new ModelCaster(Salary::class))
                            //         ->paginatorCast(
                            //             Salary::query()->where('driver_id', Auth::user()->id)->paginate()
                            //         )
                            // )
                            // ->editable()
                            ->columnSelection()
                            ->searchable()
                        //->lazy()
                    ])
                ])->columnSpan(9)
            ]),
        ];
    }

    // public function indexButtons(): ListOf
    // {
    //     return parent::indexButtons()->add(
    //         ActionButton::make(
    //             'To custom page',
    //             url: fn($model) => $this->getPageUrl(
    //                 PostPage::class,
    //                 params: ['resourceItem' => $model->getKey()]
    //             ),
    //         ),
    //     );
    // }
}
