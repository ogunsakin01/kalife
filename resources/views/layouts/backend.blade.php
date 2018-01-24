<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>@yield('tab-title') | Kalife</title>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="x-ua-compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="yes" name="apple-touch-fullscreen">
    @include('partials.backend.css')
    @yield('css')

    <script type="text/javascript">
      var BaseUrl = "{{url("/")}}";
      var path = "<?php echo e(route('typeaheadJs')); ?>";
      var airline_path = "<?php echo e(route('airlineTypeAheadJs')); ?>";
    </script>
  </head>
  <body>
  <div id="page-container">
    @include('partials.backend.sidebar')
    @include('partials.backend.header')
    @include('partials.backend.r-sidebar')
    <main id="main-container">
      <div class="content">
        <h2 class="content-heading">@yield('title')</h2>

        @yield('content')
      </div>
    </main>
    @include('partials.backend.footer')
  </div>
  @include('partials.backend.javascript')
  @yield('javascript')
  {!! Toastr::message() !!}

  </body>
</html>