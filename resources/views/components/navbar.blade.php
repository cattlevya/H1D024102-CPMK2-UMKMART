<header class="fixed top-0 w-full z-50 bg-[#fbfbe2]/80 backdrop-blur-2xl">
  <div class="flex justify-between items-center px-6 py-4 w-full max-w-screen-2xl mx-auto">

    {{-- LEFT: Brand + Nav --}}
    <div class="flex items-center gap-8">
      <a href="/" class="text-2xl font-bold tracking-tighter text-brand-indigo font-['Epilogue']">
        UMKMart
      </a>
      <nav class="hidden md:flex items-center gap-6">
        <a href="{{ route('home') }}"
           class="font-['Epilogue'] tracking-tight text-sm
                  {{ request()->routeIs('home') ? 'font-bold text-brand-brown border-b-2 border-brand-brown pb-0.5' : 'text-brand-indigo/60 hover:text-brand-brown transition-colors duration-300' }}">
          Discover
        </a>
        <a href="{{ route('catalog.index', ['category' => 'kuliner']) }}"
           class="font-['Epilogue'] tracking-tight text-sm
                  {{ request()->routeIs('catalog*') && request('category') === 'kuliner' ? 'font-bold text-brand-brown border-b-2 border-brand-brown pb-0.5' : 'text-brand-indigo/60 hover:text-brand-brown transition-colors duration-300' }}">
          Kuliner
        </a>
        <a href="{{ route('catalog.index', ['category' => 'wastra']) }}"
           class="font-['Epilogue'] tracking-tight text-sm
                  {{ request()->routeIs('catalog*') && request('category') === 'wastra' ? 'font-bold text-brand-brown border-b-2 border-brand-brown pb-0.5' : 'text-brand-indigo/60 hover:text-brand-brown transition-colors duration-300' }}">
          Wastra
        </a>
      </nav>
    </div>

    {{-- RIGHT: Search + Actions --}}
    <div class="flex items-center gap-4">

      {{-- Search bar (hidden on mobile) --}}
      <div class="hidden lg:flex items-center bg-surface-container-highest px-4 py-2 rounded-xl">
        <span class="material-symbols-outlined text-outline text-lg">search</span>
        <form action="{{ route('catalog.index') }}" method="GET">
          <input name="q" value="{{ request('q') }}"
                 class="bg-transparent border-none focus:ring-0 text-sm w-56 placeholder:text-outline/60 text-brand-indigo font-['Manrope']"
                 placeholder="Search collections..."/>
        </form>
      </div>

      {{-- Wishlist --}}
      <a href="{{ route('wishlist.index') }}" class="p-2 text-on-surface-variant hover:text-brand-brown transition-all scale-95 active:opacity-80 relative">
        <span class="material-symbols-outlined">favorite</span>
        @auth
          @php
            $wishlistCount = \App\Models\Wishlist::where('user_id', auth()->id())->count();
          @endphp
          @if($wishlistCount > 0)
            <span class="absolute top-1 right-1 w-4 h-4 bg-brand-brown text-white text-[9px] font-bold rounded-full flex items-center justify-center">
              {{ $wishlistCount }}
            </span>
          @endif
        @endauth
      </a>

      {{-- Cart dengan badge --}}
      <a href="{{ route('cart.index') }}" class="p-2 text-on-surface-variant hover:text-brand-brown transition-all scale-95 active:opacity-80 relative">
        <span class="material-symbols-outlined">shopping_bag</span>
        @if(session('cart') && count(session('cart')) > 0)
          <span class="absolute top-1 right-1 w-4 h-4 bg-brand-brown text-white text-[9px] font-bold rounded-full flex items-center justify-center">
            {{ count(session('cart')) }}
          </span>
        @endif
      </a>

      {{-- Auth --}}
      @auth
        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : (auth()->user()->role === 'penjual' ? route('seller.dashboard') : route('profile.edit')) }}"
           class="w-9 h-9 rounded-full bg-brand-indigo text-white text-sm font-bold flex items-center justify-center hover:bg-brand-brown transition-colors">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </a>
      @else
        <a href="{{ route('login') }}"
           class="hidden md:block font-['Epilogue'] text-sm font-bold text-brand-indigo/60 hover:text-brand-brown transition-colors px-3 py-2">
          Masuk
        </a>
        <a href="{{ route('register') }}"
           class="hidden md:flex items-center gap-2 bg-brand-indigo text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-primary-dim transition-all active:scale-95">
          Daftar
        </a>
      @endauth
    </div>
  </div>
</header>
