<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login :: NFC Institute</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome/css/all.min.css') }}">
    <style>
        body { background: #f0f2f5; }
        .card  { border: none; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    {{-- Top bar matching the admin navbar --}}
    <nav class="navbar bg-body-tertiary shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img src="{{ asset('logo.png') }}" alt="NFC" style="width:36px;height:36px;object-fit:contain;">
                <span class="fw-semibold d-none d-sm-inline">NFC Admin</span>
            </a>
        </div>
    </nav>

    {{-- Centered login card --}}
    <main class="flex-grow-1 d-flex align-items-center justify-content-center p-3">
        <div class="card" style="width:100%;max-width:420px;">
            <div class="card-body p-4">

                {{-- Logo + heading --}}
                <div class="text-center mb-4">
                    <img src="{{ asset('logo.png') }}" alt="NFC" class="mb-3"
                         style="width:60px;height:60px;object-fit:contain;">
                    <h5 class="fw-bold mb-0">Sign in to Admin Panel</h5>
                    <small class="text-muted">NFC Institute of Engineering &amp; Fertilizer Research</small>
                </div>

                {{-- Errors --}}
                @if(session('error'))
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2 small">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger d-flex align-items-center gap-2 py-2 small">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-envelope text-muted" style="font-size:.85rem;"></i>
                            </span>
                            <input type="email" name="email"
                                   class="form-control border-start-0 @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="mail@example.com"
                                   autofocus required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fa-solid fa-lock text-muted" style="font-size:.85rem;"></i>
                            </span>
                            <input type="password" name="password"
                                   class="form-control border-start-0"
                                   placeholder="••••••••"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 fw-semibold">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>Sign In
                    </button>

                </form>

            </div>
        </div>
    </main>

    <footer class="text-center py-2 small text-muted border-top">
        &copy; {{ date('Y') }} NFC Institute of Engineering &amp; Fertilizer Research
    </footer>

    <script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
