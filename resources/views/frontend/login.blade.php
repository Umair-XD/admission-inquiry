@extends('frontend.layouts.app')

@section('content')
  <div class="container position-relative z-1 px-3 py-4">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-5">
        <div class="card shadow-lg rounded-4">
          <div class="card-body text-dark p-4 p-sm-5">
            <h3 class="text-center fw-bold mb-2">Welcome Back</h3>
            <p class="text-center text-muted mb-4 small">Login to your student account</p>

            @if(session('error'))
                <div class="alert alert-danger py-2 small">{{ session('error') }}</div>
            @endif

            <form class="d-grid gap-3" method="POST" action="{{ url('/student/login') }}">
                @csrf
                <div>
                    <label class="form-label fw-semibold">CNIC</label>
                    <input type="text" name="cnic"
                           class="form-control @error('cnic') is-invalid @enderror"
                           placeholder="xxxxx-xxxxxxx-x"
                           value="{{ old('cnic') }}" required>
                    @error('cnic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password"
                           class="form-control"
                           placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn btn-success fw-semibold py-2">Login</button>
                <p class="text-center small text-muted mb-0">
                    No account? <a href="{{ route('register') }}" class="text-success fw-semibold">Register here</a>
                </p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
