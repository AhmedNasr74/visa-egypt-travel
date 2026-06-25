<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('layouts.site.header')
{{--@dd($social_links)--}}

<body class="bg-gray-100 text-gray-900">


    <!-- Page Wrapper -->
    <div class="page-wrapper">

        <!-- Navbar -->
        @include('layouts.site.navbar')

        <!-- Main Content -->
        <main class="min-h-screen">
            @yield('content')

            @include('site.gallery')
        </main>

        <!-- Footer -->
        @include('layouts.site.footer')

        <!-- Appointment Section -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts (keep your existing scripts as they are) -->
    <script src="{{ asset('assets/site/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/axios.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/jquery.star-rating-svg.js') }}"></script>
    <script src="{{ asset('assets/site/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets/site/js/owl.carousel.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="{{ asset('assets/site/js/aos.js') }}"></script>
    <script src="{{ asset('assets/site/js/main.js') }}?ver=1.0"></script>


    <!-- owl carousel slider -->



    @stack('js')
</body>

</html>
