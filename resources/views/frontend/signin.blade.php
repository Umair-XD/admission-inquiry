black
@extends('frontend.layouts.app')

@section('content')
  <div class="container position-relative z-1 px-3">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-5">

        <div class="card glass-card shadow-lg rounded-4">
          <div class="card-body text-black p-4 p-sm-5">

            <h3 class="text-center fw-bold mb-4">Sign In</h3>

            <form class="d-grid gap-3">

              <div>
                <label class="form-label fw-semibold">Email address</label>
                <input type="email" class="form-control bg-transparent text-black border-black" placeholder="Enter your email" required>
              </div>

              <div>
                <label class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control bg-transparent text-black border-black" placeholder="Enter your password" required>
              </div>

              <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="remember">
                  <label for="remember" class="form-check-label">Remember me</label>
                </div>
                <a href="#" class="small text-info text-decoration-none">Forgot password?</a>
              </div>

              <button type="submit" class="btn btn-primary fw-semibold py-2">
                Sign In
              </button>

            </form>

            <div class="text-center mt-3">
              <span class="text-black">Don't have an account?</span>
              <a href="#" class="fw-semibold text-info text-decoration-none ms-1">Create one</a>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
  