<x-layout-auth  :title="$title" >
    <x-slot:title>Login</x-slot:title>
  
    <div class="flex items-center justify-center min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full space-y-8">
        <div class="text-center">
          <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Masuk ke Akun Anda</h2>
        </div>
        <form class="mt-8 space-y-6 bg-white p-8 rounded-lg shadow" action="{{ route('login') }}" method="POST">
          @csrf
  
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
              autocomplete="current-password"
              required
              class="mt-1 appearance-none rounded-md relative block w-full px-3 py-2 border
                     border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none
                     focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
            @error('password')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
  
          {{-- Remember Me --}}
          <div class="flex items-center justify-between">
            <div class="flex items-center">
              <input
                id="remember_me"
                name="remember"
                type="checkbox"
                class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
              />
              <label for="remember_me" class="ml-2 block text-sm text-gray-900">Remember me</label>
            </div>
  
            @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}" class="text-sm text-indigo-600 hover:text-indigo-500">
                Forgot your password?
              </a>
            @endif
          </div>
  
          {{-- Submit --}}
          <div>
            <button
              type="submit"
              class="group relative w-full flex justify-center py-2 px-4 border border-transparent
                     text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700
                     focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
              Sign In
            </button>
          </div>
  
          <p class="mt-2 text-center text-sm text-gray-600">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
              Register
            </a>
          </p>
        </form>
      </div>
    </div>
  
  </x-layout-auth>
  