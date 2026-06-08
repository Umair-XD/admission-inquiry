<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NFC Institute Updated</title>

<!-- BOOTSTRAP -->
<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" >
<!--style sheet-->
<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
<!-- FONT AWESOME -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="bg-light text-white d-flex flex-column min-vh-100">

@include('frontend.includes.header')
 <!-- Page Content Yahan Ayega -->
    <main class="flex-fill">
        @yield('content')
@include('frontend.includes.footer')

<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/js/custom.js') }}"></script>

@if(session('open_auth_modal'))
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var authModal = new bootstrap.Modal(document.getElementById('authModal'));
        authModal.show();
    });
</script>
@endif

<script>
    document.querySelector('input[name="cnic"]').addEventListener('input', function (e) {
        let value = e.target.value.replace(/\D/g, ''); // only digits

        if (value.length > 5) {
            value = value.slice(0,5) + '-' + value.slice(5);
        }
        if (value.length > 13) {
            value = value.slice(0,13) + '-' + value.slice(13,14);
        }

        e.target.value = value;
    });

    document.querySelector('input[name="mobile"]').addEventListener('input', function (e) {
        e.target.value = e.target.value.replace(/\D/g, '');
    });

    document.querySelector('form').addEventListener('submit', function (e) {
        let pass = document.querySelector('input[name="password"]').value;
        let confirm = document.querySelector('input[name="password_confirmation"]').value;

        if (pass !== confirm) {
            e.preventDefault();
            alert("Passwords do not match!");
        }
    });
</script>


</body>
</html>
