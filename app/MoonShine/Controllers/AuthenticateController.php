<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use Illuminate\Http\Request;
use App\MoonShine\Pages\LoginPage;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\RedirectResponse;
use MoonShine\Laravel\MoonShineRequest;
use Illuminate\Container\Attributes\Auth;
use App\Http\Requests\AuthenticateFormRequest;
use Symfony\Component\HttpFoundation\Response;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class AuthenticateController extends MoonShineController
{
    public function form(LoginPage $page): LoginPage
    {
        return $page;
    }

    public function authenticate(AuthenticateFormRequest $request): RedirectResponse
    {
        if (!auth()->attempt($request->validated())) {
            return back()->withErrors([
                'email' => __('moonshine::auth.failed')
            ]);
        }

        return redirect()->intended(
            route('profile')
        );
    }

    public function logout(#[Auth] Guard $guard, Request $request): RedirectResponse
    {
        $guard->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->intended(
            url()->previous() ?? route('home')
        );
    }
}
