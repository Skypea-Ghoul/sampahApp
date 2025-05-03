{{-- resources/views/components/navbar.blade.php --}}
@props([])

<nav class="bg-gray-800" 
     x-data='{
       isOpen: false,
       notifOpen: false,
       fullBins: {!! json_encode($fullBins->toArray()) !!}
     }'
     x-cloak
>
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      {{-- LEFT: Logo & Links --}}
      <div class="flex items-center">
        <img class="h-8 w-8" src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500" alt="Logo">
        <div class="hidden md:flex md:ml-10 md:space-x-4">
          <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link>
          <x-nav-link href="{{ route('sampah.index') }}" :active="request()->routeIs('sampah.index')">Tong Sampah</x-nav-link>
        </div>
      </div>

      {{-- RIGHT: Notifications & Profile --}}
      <div class="hidden md:flex md:items-center md:space-x-4">

        {{-- Notifications --}}
        <div class="relative" x-cloak>
          <button @click="notifOpen = !notifOpen"
                  class="p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
            <span class="sr-only">View notifications</span>
            <!-- Bell icon SVG -->
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14V9a6 6 0 10-12 0v5c0 .386.146.735.385 1.002L5 17h5m5 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span x-show="fullBins.length > 0"
                  class="absolute top-0 right-0 inline-flex items-center justify-center
                         px-1.5 py-0.5 text-xs font-bold text-white bg-red-600 rounded-full"
                  x-text="fullBins.length"></span>
          </button>

          {{-- Notifications Dropdown --}}
          <div x-show="notifOpen" @click.away="notifOpen = false" x-transition
               class="absolute right-0 mt-2 w-64 bg-white rounded-md shadow-lg ring-1 ring-black/5 z-20">
            <div class="px-4 py-2 border-b">
              <h3 class="text-sm font-medium text-gray-900">Sampah Penuh</h3>
            </div>
            <ul class="max-h-60 overflow-auto">
              <template x-if="fullBins.length === 0">
                <li class="px-4 py-2 text-sm text-gray-500">Tidak ada notifikasi</li>
              </template>
              <template x-for="bin in fullBins" :key="bin.id">
                <li class="flex justify-between px-4 py-2 hover:bg-gray-100 cursor-pointer">
                  <span class="text-sm text-gray-700">Bin #<span x-text="bin.id"></span></span>
                  <span class="text-xs text-gray-500"><span x-text="bin.distance"></span> m</span>
                </li>
              </template>
            </ul>
          </div>
        </div>

        {{-- Profile --}}
        <div class="relative" x-data="{ open: false }" x-cloak>
          <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
            <img class="h-8 w-8 rounded-full"
                 src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=gray&color=fff"
                 alt="Avatar">
            <span class="text-gray-300 hover:text-white">{{ Auth::user()->name }}</span>
          </button>
          <div x-show="open" @click.away="open = false" x-transition
               class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black/5 z-20">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
              Your Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                Sign Out
              </button>
            </form>
          </div>
        </div>
      </div>

      {{-- MOBILE HAMBURGER --}}
      <div class="flex md:hidden">
        <button @click="isOpen = !isOpen" class="p-2 text-gray-400 hover:text-white focus:outline-none" x-cloak>
          <svg :class="{ 'hidden': isOpen, 'block': !isOpen }" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg :class="{ 'block': isOpen, 'hidden': !isOpen }" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

  {{-- MOBILE MENU --}}
  <div x-show="isOpen" x-cloak class="md:hidden">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">Home</x-nav-link>
      <x-nav-link href="{{ route('sampah.index') }}" :active="request()->routeIs('sampah.index')">Tong Sampah</x-nav-link>
    </div>
    <div class="border-t border-gray-700 pt-3 pb-3">
      <ul class="space-y-1 px-2">
        <li>
          <button @click="notifOpen = !notifOpen" class="w-full text-left flex justify-between items-center px-3 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <span>Notifikasi (<span x-text="fullBins.length"></span>)</span>
          </button>
        </li>
        <li>
          <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
            Your Profile
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">
              Sign Out
            </button>
          </form>
        </li>
      </ul>
    </div>

    {{-- MOBILE NOTIFICATIONS --}}
    <div x-show="notifOpen" x-cloak class="px-2 pt-2 pb-3 bg-gray-900">
      <h3 class="px-3 text-sm font-medium text-gray-400">Sampah Penuh</h3>
      <ul class="mt-1 space-y-1 max-h-48 overflow-auto">
        <template x-if="fullBins.length === 0">
          <li class="px-3 py-2 text-sm text-gray-500">Tidak ada notifikasi</li>
        </template>
        <template x-for="bin in fullBins" :key="bin.id">
          <li class="flex justify-between px-3 py-2 text-sm text-gray-200 bg-gray-800 hover:bg-gray-700 rounded">
            <span>Bin #<span x-text="bin.id"></span></span>
            <span><span x-text="bin.distance"></span> m</span>
          </li>
        </template>
      </ul>
    </div>
  </div>
</nav>
