@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="py-12 px-4 md:px-14">
    <div class="max-w-2xl mx-auto space-y-6">
        
        <!-- Info Profile -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <h2 class="font-bold text-xl mb-4">Informasi Profile</h2>
            <div class="flex items-center gap-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-primary flex items-center justify-center text-white text-2xl font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-bold text-lg">{{ auth()->user()->name }}</p>
                    <p class="text-slate-400 text-sm">{{ auth()->user()->email }}</p>
                </div>
            </div>
        </div>

        <!-- Logout -->
        <div class="bg-white border border-slate-200 rounded-2xl p-6">
            <h2 class="font-bold text-xl mb-4">Keluar Akun</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-5 py-2 rounded-full font-semibold">
                    Logout
                </button>
            </form>
        </div>

    </div>
</div>
@endsection