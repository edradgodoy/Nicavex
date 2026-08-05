<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <h4 class="text-center text-primary-custom mb-4 font-weight-bold" style="font-weight: 700;">
        {{ __('Register') }}
    </h4>

    <form wire:submit="register">
        <!-- Name -->
        <x-ganado.input 
            name="name" 
            label="{{ __('Name') ? 'Nombre Completo' : 'Name' }}" 
            type="text" 
            wire:model="name"
            placeholder="Juan Pérez"
            required 
            autofocus 
        />

        <!-- Email Address -->
        <x-ganado.input 
            name="email" 
            label="{{ __('Email') }}" 
            type="email" 
            wire:model="email"
            placeholder="correo@ejemplo.com"
            required 
        />

        <!-- Password -->
        <x-ganado.input 
            name="password" 
            label="{{ __('Password') }}" 
            type="password" 
            wire:model="password"
            placeholder="••••••••"
            required 
        />

        <!-- Confirm Password -->
        <x-ganado.input 
            name="password_confirmation" 
            label="{{ __('Confirm Password') ? 'Confirmar Contraseña' : 'Confirm Password' }}" 
            type="password" 
            wire:model="password_confirmation"
            placeholder="••••••••"
            required 
        />

        <div class="d-flex align-items-center justify-content-between mt-4">
            <a class="small text-secondary-custom text-decoration-none" href="{{ route('login') }}" wire:navigate>
                {{ __('Already registered?') ? '¿Ya estás registrado?' : 'Already registered?' }}
            </a>

            <x-ganado.button type="submit" style="primary">
                {{ __('Register') }}
            </x-ganado.button>
        </div>
    </form>
</div>
