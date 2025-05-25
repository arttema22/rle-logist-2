<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Sys\Truck;
use App\Models\User;
use MoonShine\Support\ListOf;
use Illuminate\Validation\Rule;
use MoonShine\Laravel\Enums\Action;
use MoonShine\Support\Attributes\Icon;
use Illuminate\Database\Eloquent\Builder;
use App\MoonShine\Pages\User\UserFormPage;
use App\MoonShine\Pages\User\UserIndexPage;
use MoonShine\Laravel\Resources\ModelResource;

#[Icon('users')]
class UserResource extends ModelResource
{
    protected string $model = User::class;

    // protected array $with = ['profile'];

    // public function query(): Builder
    // {
    // if (Auth::user()->moonshine_user_role_id == 3)
    //     return parent::query()
    //         ->where('driver_id', Auth::user()->id)
    //         ->with('driver');

    //     return parent::query()->with('profile');
    // }

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
            'e1_card' => 'digits:19',
            'password' => $item->exists
                ? 'sometimes|nullable|min:6|required_with:password_repeat|same:password_repeat'
                : 'required|min:6|required_with:password_repeat|same:password_repeat',

        ];
    }

    protected function beforeCreating(mixed $item): mixed
    {
        $item->role_id = 2;
        return $item;
    }

    protected function afterCreated(mixed $item): mixed
    {
        Truck::find($item->truck_id)->update(['is_driver' => 1]);
        return $item;
    }

    protected function beforeUpdating(mixed $item): mixed
    {
        if ($item->truck_id != null)
            Truck::find($item->truck_id)->update(['is_driver' => 0]);
        return $item;
    }

    protected function afterUpdated(mixed $item): mixed
    {
        if ($item->truck_id != null)
            Truck::find($item->truck_id)->update(['is_driver' => 1]);
        return $item;
    }

    protected function beforeDeleting(mixed $item): mixed
    {
        Truck::find($item->truck_id)->update(['is_driver' => 0]);
        return $item;
    }
}
