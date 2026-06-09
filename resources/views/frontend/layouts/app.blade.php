<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NFC Institute of Engineering & Fertilizer Research')</title>

    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('frontend.includes.header')

    <main class="flex-fill">
        @yield('content')
    </main>

    @include('frontend.includes.footer')

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

    {{-- Auto-open auth modal after redirect --}}
    @if (session('open_auth_modal'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var authModal = new bootstrap.Modal(document.getElementById('authModal'));
                authModal.show();
                @if (session('open_auth_modal') === 'register')
                    setTimeout(function() {
                        document.querySelector('[data-bs-target="#registerTab"]').click();
                    }, 150);
                @endif
            });
        </script>
    @endif

    <script>
        (function() {
            // CNIC formatter inside modal
            var cnicInput = document.getElementById('modalCnic');
            if (cnicInput) {
                cnicInput.addEventListener('input', function(e) {
                    let value = e.target.value.replace(/\D/g, '').slice(0, 13);
                    if (value.length > 12) value = value.slice(0, 5) + '-' + value.slice(5, 12) + '-' + value
                        .slice(12);
                    else if (value.length > 5) value = value.slice(0, 5) + '-' + value.slice(5);
                    e.target.value = value;
                });
            }

            // Mobile formatter inside modal
            var mobileInput = document.getElementById('modalMobile');
            if (mobileInput) {
                mobileInput.addEventListener('input', function(e) {
                    e.target.value = e.target.value.replace(/\D/g, '').slice(0, 11);
                });
            }
        })();
    </script>

</body>

</html>
