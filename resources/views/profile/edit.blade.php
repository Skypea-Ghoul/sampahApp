{{-- resources/views/profile/edit.blade.php --}}
<x-layout>
    <x-slot:title>Your Profile</x-slot:title>
  
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-xl">
      <h2 class="text-3xl font-bold text-gray-900 mb-6">Update Profile</h2>
  
      @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
      @endif
  
      <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
        @csrf
  
        {{-- Full Name --}}
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
          <input
            type="text"
            name="name"
            id="name"
            value="{{ old('name', $user->name) }}"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-900
                   placeholder-gray-400 focus:border-indigo-500 focus:bg-white focus:outline-none
                   focus:ring-2 focus:ring-indigo-200 transition"
            placeholder="Enter your full name"
          />
          @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
  
        {{-- Email Address --}}
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
          <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email', $user->email) }}"
            class="block w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-900
                   placeholder-gray-400 focus:border-indigo-500 focus:bg-white focus:outline-none
                   focus:ring-2 focus:ring-indigo-200 transition"
            placeholder="you@example.com"
          />
          @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
  
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          {{-- New Password --}}
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
            <input
              type="password"
              name="password"
              id="password"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-900
                     placeholder-gray-400 focus:border-indigo-500 focus:bg-white focus:outline-none
                     focus:ring-2 focus:ring-indigo-200 transition"
              placeholder="Leave blank to keep current"
            />
            @error('password')
              <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
          </div>
  
          {{-- Confirm Password --}}
          <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
              Confirm New Password
            </label>
            <input
              type="password"
              name="password_confirmation"
              id="password_confirmation"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 py-3 px-4 text-gray-900
                     placeholder-gray-400 focus:border-indigo-500 focus:bg-white focus:outline-none
                     focus:ring-2 focus:ring-indigo-200 transition"
              placeholder="Repeat your new password"
            />
          </div>
        </div>
  
        {{-- Submit --}}
        <div class="pt-4">
          <button
            type="submit"
            class="w-full flex justify-center py-3 px-6 bg-indigo-600 text-white text-lg font-medium
                   rounded-lg shadow hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500
                   focus:ring-offset-2 transition"
          >
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </x-layout>
  