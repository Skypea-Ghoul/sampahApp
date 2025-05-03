@props(['title' => ''])

<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  @vite('resources/css/app.css')
  <title>{{ $title }}</title>
</head>
<body class="h-full bg-gray-50 flex items-center justify-center">
  <div class="w-full max-w-md space-y-8">
    {{ $slot }}
  </div>
</body>
</html>
