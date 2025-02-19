<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\User;
use MoonShine\Support\ListOf;
use Illuminate\Validation\Rule;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use App\MoonShine\Pages\User\UserFormPage;
use App\MoonShine\Pages\User\UserIndexPage;
use App\MoonShine\Pages\User\UserDetailPage;
use MoonShine\Laravel\Resources\ModelResource;

#[Icon('users')]
class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $column = 'name';

    protected bool $columnSelection = true;

    public function getTitle(): string
    {
        return __('moonshine::ui.title.drivers');
    }

    protected function activeActions(): ListOf
    {
        return parent::activeActions()
            ->except(
                Action::MASS_DELETE
            );
    }

    protected function pages(): array
    {
        return [
            UserIndexPage::class,
            UserFormPage::class,
            UserDetailPage::class,
        ];
    }

    protected function rules(mixed $item): array
    {
        return [
            'name' => 'required',
            'email' => [
                'sometimes',
                'bail',
                'required',
                'email',
                Rule::unique('users')->ignoreModel($item),
            ],
            'password' => $item->exists
                ? 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat'
                : 'required|min:6|required_with:password_repeat|same:password_repeat',

        ];
    }
}
