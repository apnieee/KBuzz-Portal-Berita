<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title')</title>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  <link 
  rel="stylesheet" 
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
  <div class="w-full">
    @include('includes.navbar')

    @yield('content')
  </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.mySwiper', {
          slidesPerView: 1.5,
          spaceBetween: 20,
          centeredSlides: true,
          loop: true,
        });
      });
    </script>
</body>

</html>