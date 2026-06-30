<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'NFC Institute of Engineering & Fertilizer Research')</title>

    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2-bootstrap-5-theme/select2-bootstrap-5-theme.min.css') }}">
    @stack('styles')
</head>

<body class="bg-light d-flex flex-column min-vh-100">

    @include('frontend.includes.header')

    <main class="flex-fill">
        @yield('content')
    </main>

    @include('frontend.includes.footer')

    {{-- Flash toast notifications (not when modal reopens — errors shown inside modal) --}}
    @if(session('success') || (session('error') && !session('open_auth_modal')))
    <div class="position-fixed top-0 end-0 p-3" style="z-index:9999;">
        <div id="flashToast" class="toast align-items-center border-0 text-white
            {{ session('success') ? 'bg-success' : 'bg-danger' }}"
            role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body fw-semibold">
                    <i class="fa-solid {{ session('success') ? 'fa-circle-check' : 'fa-circle-exclamation' }} me-2"></i>
                    {{ session('success') ?? session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
    @endif

    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
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

    {{-- Auto-show flash toast --}}
    @if(session('success') || (session('error') && !session('open_auth_modal')))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var el = document.getElementById('flashToast');
            if (el) {
                var toast = new bootstrap.Toast(el, { delay: 4000 });
                toast.show();
            }
        });
    </script>
    @endif

    @stack('scripts')

    <script>
        (function() {
            function applyCnicFormatter(el) {
                if (!el) return;
                el.addEventListener('input', function(e) {
                    let v = e.target.value.replace(/\D/g, '').slice(0, 13);
                    if (v.length > 12) v = v.slice(0, 5) + '-' + v.slice(5, 12) + '-' + v.slice(12);
                    else if (v.length > 5) v = v.slice(0, 5) + '-' + v.slice(5);
                    e.target.value = v;
                });
            }

            applyCnicFormatter(document.getElementById('modalCnic'));
            applyCnicFormatter(document.getElementById('loginCnic'));

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
