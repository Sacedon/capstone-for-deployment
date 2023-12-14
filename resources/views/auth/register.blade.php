<x-guest-layout>
    <x-auth-card>
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="grid gap-6">
                <!-- SurName -->
                <div class="space-y-2">
                    <x-form.label for="surname" :value="__('Surname')" />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="surname"
                            class="block w-full"
                            type="text"
                            name="surname"
                            :value="old('surname')"
                            required
                            placeholder="{{ __('Surname') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div class="grid gap-6">
                    <!-- First Name -->
<div class="space-y-2">
    <x-form.label for="first_name" :value="__('First Name')" />

    <x-form.input-with-icon-wrapper>
        <x-slot name="icon">
            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
        </x-slot>

        <x-form.input
            withicon
            id="first_name"
            class="block w-full"
            type="text"
            name="first_name"
            :value="old('first_name')"
            required
            placeholder="{{ __('First Name') }}"
        />
    </x-form.input-with-icon-wrapper>
</div>

                    <div class="grid gap-6">
                        <!-- Middle Name -->
<div class="space-y-2">
    <x-form.label for="middle_name" :value="__('Middle Name')" />

    <x-form.input-with-icon-wrapper>
        <x-slot name="icon">
            <x-heroicon-o-user aria-hidden="true" class="w-5 h-5" />
        </x-slot>

        <x-form.input
            withicon
            id="middle_name"
            class="block w-full"
            type="text"
            name="middle_name"
            :value="old('middle_name')"
            placeholder="{{ __('Middle Name') }}"
        />
    </x-form.input-with-icon-wrapper>
</div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label
                        for="email"
                        :value="__('Email')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="email"
                            class="block w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            placeholder="{{ __('Email') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password"
                        :value="__('Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password"
                            class="block w-full"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="{{ __('Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <!-- Confirm Password -->
                <div class="space-y-2">
                    <x-form.label
                        for="password_confirmation"
                        :value="__('Confirm Password')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-lock-closed aria-hidden="true" class="w-5 h-5" />
                        </x-slot>

                        <x-form.input
                            withicon
                            id="password_confirmation"
                            class="block w-full"
                            type="password"
                            name="password_confirmation"
                            required
                            placeholder="{{ __('Confirm Password') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>

                <div>
                    <x-button class="justify-center w-full gap-2">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Register') }}</span>
                    </x-button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    {{ __('Already registered?') }}
                    <a href="{{ route('login') }}" class="text-blue-500 hover:underline">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
