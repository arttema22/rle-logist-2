<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Salary;
use MoonShine\Laravel\Models\MoonshineUser;

class SalaryPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Salary $item): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return true;
    }

    public function update(MoonshineUser $user, Salary $item): bool
    {
        return $item->profit_id == 0;
    }

    public function delete(MoonshineUser $user, Salary $item): bool
    {
        return $item->profit_id == 0;
    }

    public function restore(MoonshineUser $user, Salary $item): bool
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Salary $item): bool
    {
        return true;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return true;
    }
}
