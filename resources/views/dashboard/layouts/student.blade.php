<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NFC Institute Updated</title>

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}" >
<!--style sheet-->
<link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="bg-light text-white d-flex flex-column min-vh-100">
{{-- @include('dashboard.includes.header') --}}
@yield('content')
@include('dashboard.includes.footer')
<script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/js/custom.js') }}"></script>
</body>
</html>
