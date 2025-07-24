<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Management System - @yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Main CSS (custom if any) -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('vendor/fontawesome/css/all.min.css') }}" rel="stylesheet">

    @yield('styles')

</head>
<body class="bg-light">

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-sky-700/100 text-white flex flex-col p-4">
            <div class="text-xl font-bold mb-6 px-3 py-2">EMS Application</div>
            @include('layouts.sidebar')
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-auto max-h-screen">
            @yield('content')
        </main>
    </div>


    <!-- Alpine.js already included via app.js -->

    <!-- SweetAlert2 CSS (optional if using custom styles) -->
    <link rel="stylesheet" href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}">

    <!-- SweetAlert2 JS -->
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>


    <!-- Success Message -->
    @if(session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2500
            });
        </script>
    @endif

    <!-- Error Message -->
    @if(session('error'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2500
            });
        </script>
    @endif

    <!-- Info Message -->
    @if(session('info'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: "{{ session('info') }}",
                showConfirmButton: false,
                timer: 2500
            });
        </script>
    @endif

    @yield('scripts')
</body>
</html>
