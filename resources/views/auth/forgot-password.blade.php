<x-guest-layout>

    <x-primary-button-voltar>
        <i class="bi bi-arrow-left me-3 fw-bold"></i>  {{ __('Voltar') }}
    </x-primary-button-voltar>

    <div class="mb-4 mt-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Esqueceu sua senha? Sem problemas. Apenas informe seu endereço de e-mail que enviaremos um link que conterá sua nova senha.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="/reset-password">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('error')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-primary-button-reset>
                {{ __('Email Password Reset Link') }}
            </x-primary-button-reset>
        </div>
    </form>
</x-guest-layout>
