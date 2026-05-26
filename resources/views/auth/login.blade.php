@extends('layouts.app')

@section('title', 'Login - KBuzz')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4">
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm w-full max-w-md p-8">
        
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <a href="{{ route('landing') }}" class="flex items-center gap-2">
                <img src="{{ asset('img/Logo.png') }}" alt="Logo" class="h-10 w-auto">
                <span class="text-xl font-bold">KBuzz</span>
            </a>
        </div>

        <!-- Tab -->
        <div class="flex rounded-full border border-slate-200 p-1 mb-6" id="auth-tabs">
            <button onclick="switchTab('login')" id="tab-login"
                class="flex-1 py-2 rounded-full text-sm font-semibold transition bg-primary text-white">
                Sign In
            </button>
            <button onclick="switchTab('register')" id="tab-register"
                class="flex-1 py-2 rounded-full text-sm font-semibold transition text-slate-500">
                Sign Up
            </button>
        </div>

        <!-- Form Login -->
        <div id="form-login">
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" class="rounded">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">
                        Lupa password?
                    </a>
                    @endif
                </div>
                <button type="submit"
                    class="w-full bg-primary text-white py-2 rounded-xl font-semibold hover:opacity-90 transition">
                    Sign In
                </button>
            </form>
        </div>

        <!-- Form Register -->
        <div id="form-register" class="hidden">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required
                        class="w-full border border-slate-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
                <button type="submit"
                    class="w-full bg-primary text-white py-2 rounded-xl font-semibold hover:opacity-90 transition">
                    Sign Up
                </button>
            </form>
        </div>

    </div>
</div>

<script>
    function switchTab(tab) {
        const formLogin = document.getElementById('form-login');
        const formRegister = document.getElementById('form-register');
        const tabLogin = document.getElementById('tab-login');
        const tabRegister = document.getElementById('tab-register');

        if (tab === 'login') {
            formLogin.classList.remove('hidden');
            formRegister.classList.add('hidden');
            tabLogin.classList.add('bg-primary', 'text-white');
            tabLogin.classList.remove('text-slate-500');
            tabRegister.classList.remove('bg-primary', 'text-white');
            tabRegister.classList.add('text-slate-500');
        } else {
            formRegister.classList.remove('hidden');
            formLogin.classList.add('hidden');
            tabRegister.classList.add('bg-primary', 'text-white');
            tabRegister.classList.remove('text-slate-500');
            tabLogin.classList.remove('bg-primary', 'text-white');
            tabLogin.classList.add('text-slate-500');
        }
    }

    // Auto switch ke register kalau ada error register
    @if($errors->has('name') || $errors->has('password_confirmation'))
        switchTab('register');
    @endif
</script>
@endsection