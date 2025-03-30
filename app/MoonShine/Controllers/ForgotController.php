<?php

declare(strict_types=1);

namespace App\MoonShine\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use MoonShine\Laravel\MoonShineUI;
use App\MoonShine\Pages\ForgotPage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use MoonShine\Laravel\MoonShineRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\ResetPasswordFormRequest;
use App\Http\Requests\ForgotPasswordFormRequest;
use MoonShine\Laravel\Http\Controllers\MoonShineController;

final class ForgotController extends MoonShineController
{
    public function form(ForgotPage $page): ForgotPage
    {
        return $page;
    }

    public function reset(ForgotPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            MoonShineUI::toast(__('If the account exists, then the instructions are sent to your email'));
        }

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['alert' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function updatePassword(ResetPasswordFormRequest $request): RedirectResponse
    {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            static function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('alert', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
