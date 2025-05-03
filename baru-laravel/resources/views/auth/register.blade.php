<x-layout-auth :title="$title">
    <x-slot:title>Register</x-slot:title>
  
    <div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
        <div class="text-center">
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Buat Akun Baru</h2>
        </div>
        <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" action="{{ route('register') }}" method="POST">
          @csrf
  
          {{-- Name --}}
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
            <input
              id="name"
              name="name"
              type="text"
              autocomplete="name"
              required
              value="{{ old('name') }}"
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border
                     border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none
                     focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            @error('name')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
  
          {{-- Email --}}
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
            <input
              id="email"
              name="email"
              type="email"
              autocomplete="email"
              required
              value="{{ old('email') }}"
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border
                     border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none
                     focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            @error('email')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
  
          {{-- Password --}}
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input
              id="password"
              name="password"
              type="password"
              autocomplete="new-password"
              required
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border
                     border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none
                     focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            @error('password')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
  
          {{-- Confirm Password --}}
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
              Confirm Password
            </label>
            <input
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              autocomplete="new-password"
              required
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border
                     border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none
                     focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
          </div>
  
          {{-- Submit --}}
          <div>
            <button
              type="submit"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent
                     text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                     focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Register
            </button>
          </div>
  
          <p class="mt-2 text-center text-sm text-gray-600">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
              Login
            </a>
          </p>
        </form>
      </div>
    </div>
  
  </x-layout-auth>
  