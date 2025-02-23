<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    public string $last_name ='';
    public string $first_name ='';
    public string $sec_name ='';
    public string $phone ='';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;

        $this->last_name = Auth::user()->profile->last_name;
        $this->first_name = Auth::user()->profile->first_name;
        $this->sec_name = Auth::user()->profile->sec_name;
        $this->phone = Auth::user()->profile->phone;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $validated_profile = $this->validate([
                'last_name' => ['string', 'max:255'],
                'first_name' => ['string', 'max:255'],
                'sec_name' => ['string', 'max:255'],
                'phone' => ['max:255'],
                ]);

          $user->fill($validated);
          $user->profile->fill($validated_profile);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();
        $user->profile->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profile.profile_information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("profile.update_your_account_profile_information") }}
        </p>
    </header>

    <form wire:submit="updateProfileInformation" class="mt-6 space-y-6">
        <div>
            <x-input-label for="name" :value="__('profile.name')" />
            <x-text-input wire:model="name" id="name" name="name" type="text" class="mt-1 block w-full" required
                autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('profile.email')" />
            <x-text-input wire:model="email" id="email" name="email" type="email" class="mt-1 block w-full" required
                autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !
            auth()->user()->hasVerifiedEmail())
            <div>
                <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                    {{ __('Your email address is unverified.') }}

                    <button wire:click.prevent="sendVerification"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
                @endif
            </div>
            @endif
        </div>

        <div>
            <x-input-label for="last_name" :value="__('profile.last_name')" />
            <x-text-input wire:model="last_name" id="last_name" name="last_name" type="text" class="mt-1 block w-full"
                autofocus autocomplete="last_name" />
            <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
        </div>

        <div>
            <x-input-label for="first_name" :value="__('profile.first_name')" />
            <x-text-input wire:model="first_name" id="first_name" name="first_name" type="text"
                class="mt-1 block w-full" autofocus autocomplete="first_name" />
            <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
        </div>

        <div>
            <x-input-label for="sec_name" :value="__('profile.sec_name')" />
            <x-text-input wire:model="sec_name" id="sec_name" name="sec_name" type="text" class="mt-1 block w-full"
                autofocus autocomplete="sec_name" />
            <x-input-error class="mt-2" :messages="$errors->get('sec_name')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('profile.phone')" />
            <x-text-input wire:model="phone" id="phone" name="phone" type="text" class="mt-1 block w-full" autofocus
                autocomplete="phone" />
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('profile.save') }}</x-primary-button>

            <x-action-message class="me-3" on="profile-updated">
                {{ __('profile.saved') }}
            </x-action-message>
        </div>
    </form>
</section>