<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\Models\User;
use App\MoonShine\Pages\ProfilePage;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileFormRequest;
use Illuminate\Container\Attributes\CurrentUser;
use Symfony\Component\HttpFoundation\RedirectResponse;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class ProfileController extends MoonShineController
{
    public function index(ProfilePage $page): ProfilePage
    {
        return $page;
    }

    public function update(ProfileFormRequest $request, #[CurrentUser] User $user): RedirectResponse
    {
        $data = $request->only(['email', 'name']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->input('password'));
        }

        $user->update($data);

        return to_route('profile');
    }
}
