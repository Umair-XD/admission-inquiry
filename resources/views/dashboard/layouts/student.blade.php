<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NFC Institute — Student</title>

    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">
    @yield('content')
    @include('dashboard.includes.footer')

    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>

    <script>
    $(document).ready(function () {
        $('select.select2').select2({ theme: 'bootstrap-5', width: '100%' });
    });
    </script>
</body>
</html>
