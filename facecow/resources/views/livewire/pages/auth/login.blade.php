<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h4 class="text-center text-primary-custom mb-4 font-weight-bold" style="font-weight: 700;">
        {{ __('Login') }}
    </h4>

    <!-- Session Status -->
    @if (session('status'))
        <x-ganado.message style="info">
            {{ session('status') }}
        </x-ganado.message>
    @endif

    <form wire:submit="login">
        <!-- Email Address -->
        <x-ganado.input 
            name="form.email" 
            label="{{ __('Email') }}" 
            type="email" 
            wire:model="form.email"
            placeholder="correo@ejemplo.com"
            required 
            autofocus 
        />

        <!-- Password -->
        <x-ganado.input 
            name="form.password" 
            label="{{ __('Password') }}" 
            type="password" 
            wire:model="form.password"
            placeholder="••••••••"
            required 
        />

        <!-- Remember Me -->
        <div class="form-check mb-3">
            <input wire:model="form.remember" id="remember" type="checkbox" class="form-check-input" name="remember">
            <label for="remember" class="form-check-label text-secondary-custom small">
                {{ __('Remember me') ? 'Recordar mi cuenta' : 'Remember me' }}
            </label>
        </div>

        <div class="d-flex align-items-center justify-content-between mt-4">
            @if (Route::has('password.request'))
                <a class="small text-secondary-custom text-decoration-none" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') ? '¿Olvidaste tu contraseña?' : 'Forgot your password?' }}
                </a>
            @endif

            <x-ganado.button type="submit" style="primary">
                {{ __('Login') }}
            </x-ganado.button>
        </div>
    </form>
</div>
