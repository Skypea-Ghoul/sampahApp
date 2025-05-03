{{-- resources/views/components/layout.blade.php --}}
@props(['title' => 'Laravel App', 'showNav' => true])

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  @vite('resources/css/app.css')
  @stack('styles')
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <style>[x-cloak] { display: none !important; }</style>
  <title>{{ $title }}</title>
</head>
<body class="h-full">
  <div class="min-h-full">
    @if($showNav)
      <x-navbar />
    @endif

    <x-header>{{ $title }}</x-header>

    <main>
      <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>
  @stack('scripts')
</body>
</html>
