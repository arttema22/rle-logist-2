<?php

declare(strict_types=1);

namespace App\MoonShine\Pages\User;

use App\Models\Profile;
use Throwable;
use App\Models\User;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Template;
use MoonShine\UI\Components\Collapse;
use MoonShine\UI\Components\Components;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\PasswordRepeat;
use MoonShine\UI\Components\Layout\Flex;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use App\MoonShine\Resources\ProfileResource;
use MoonShine\Contracts\UI\ComponentContract;

class UserFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                Flex::make([
                    Text::make('name')->translatable('moonshine::ui.field')->required(),
                    Email::make('email')->translatable('moonshine::ui.field')->required(),
                    Text::make('e1_card')->translatable('moonshine::ui.field'),
                ]),
                Collapse::make(__('moonshine::ui.resource.change_password'), [
                    Password::make(__('moonshine::ui.resource.password'), 'password')
                        ->customAttributes(['autocomplete' => 'new-password'])
                        ->eye(),

                    PasswordRepeat::make(__('moonshine::ui.resource.repeat_password'), 'password_repeat')
                        ->customAttributes(['autocomplete' => 'confirm-password'])
                        ->eye(),
                ])->icon('lock-closed'),

                Template::make('Test')
                    ->changeFill(fn(User $data) => $data->profile)
                    ->changePreview(fn($data) => $data?->id ?? '-')
                    ->fields(app(ProfileResource::class)->getFormFields())
                    ->changeRender(function (?Profile $data, Template $field) {
                        $fields = $field->getPreparedFields();
                        $fields->fill($data?->toArray() ?? []);

                        return Components::make($fields);
                    })
                    ->onAfterApply(function (User $item, array $value) {
                        $item->profile()->updateOrCreate([
                            // 'id' => $value['id']
                        ], $value);
                        return $item;
                    }),
            ]),
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
