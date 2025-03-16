<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Refilling;
use MoonShine\Laravel\Models\MoonshineUser;

class RefillingPolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Refilling $item): bool
    {
        return $item->integration_id == 0;
    }

    public function create(MoonshineUser $user): bool
    {
        return true;
    }

    public function update(MoonshineUser $user, Refilling $item): bool
    {
        return $item->integration_id == 0;
    }

    public function delete(MoonshineUser $user, Refilling $item): bool
    {
        return $item->integration_id == 0;
    }

    public function restore(MoonshineUser $user, Refilling $item): bool
    {
        return true;
    }

    public function forceDelete(MoonshineUser $user, Refilling $item): bool
    {
        return true;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return true;
    }
}
