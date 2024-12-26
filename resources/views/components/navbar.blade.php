<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <x-nav-link href="/" style="color: red;">Home</x-nav-link>
  <x-nav-link href="/about"   style="color: green;">About</x-nav-link>
  <x-nav-link href="/contact" style="color: blue;">Contact</x-nav-link>

{{$slot}}

</body>
</html>