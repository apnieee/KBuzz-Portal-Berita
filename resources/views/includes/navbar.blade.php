<!-- Nav -->
<div class="sticky top-0 z-50 bg-white shadow-sm">
  <div class="flex items-center justify-between px-4 lg:px-14 py-3">

    <!-- Kiri -->
    <div class="flex items-center gap-10">

      <!-- Logo -->
      <div class="flex items-center justify-between w-full lg:w-auto">
        <a href="{{ route('landing') }}">
          <div class="flex items-center">
            <img 
              src="{{ asset('img/Logo.png') }}" 
              alt="Logo"
              class="h-12 lg:h-14 w-auto object-contain"
            >

            <!-- Text -->
            <p class="text-xl font-bold">KBuzz</p>
          </div>
        </a>

        <!-- Mobile Button -->
        <button class="lg:hidden text-primary text-2xl focus:outline-none ml-4" id="menu-toggle">
          ☰
        </button>
      </div>

      <!-- Menu -->
      <div id="menu" class="hidden lg:block">
        <ul class="flex items-center gap-3 font-medium text-base">

          <li>
            <a href="{{ route('landing') }}"
              class="{{ request()->is('/') ? 'text-primary' : '' }} hover:text-primary transition">
              Beranda
            </a>
          </li>

          @foreach (\App\Models\NewsCategory::all() as $category)
          <li>
            <a href="{{ route('news.category', $category->slug )}}"
              class="hover:text-primary transition">
              {{ $category->title }}
            </a>
          </li>
          @endforeach

        </ul>
      </div>
    </div>

    <!-- Right -->
    <div class="hidden lg:flex items-center gap-3">

      <!-- Search -->
      <div class="relative">
        <form action="{{ route('news.index') }}" method="GET">
          <input
            name="search"
            type="text"
            placeholder="Cari berita..."
            class="border border-slate-300 rounded-full px-4 py-2 pl-10 text-sm focus:outline-none focus:border-primary"
          >
        </form>

        <span class="absolute inset-y-0 left-3 flex items-center">
          <img src="{{ asset('img/search.png') }}" alt="search" class="w-4">
        </span>
      </div>

      <!-- Login -->
      @auth
          @if(auth()->user()->role === 'admin' || auth()->user()->role === 'author')
              <a href="/admin"
                  class="bg-primary px-5 py-2 rounded-full text-white font-semibold text-sm whitespace-nowrap">
                  Dashboard
              </a>
          @else
              <a href="/profile"
                  class="bg-primary px-5 py-2 rounded-full text-white font-semibold text-sm whitespace-nowrap">
                  {{ auth()->user()->name }}
              </a>
          @endif
      @else
          <a href="/login"
              class="bg-primary px-5 py-2 rounded-full text-white font-semibold text-sm whitespace-nowrap">
              Login
          </a>
      @endauth

    </div>
  </div>
</div>