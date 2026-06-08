
@extends('frontend.layouts.app')

@section('content')
  <div class="container position-relative z-1 px-3">
    <div class="row justify-content-center">
      <!-- Responsive Columns -->
      <div class="col-12 col-sm-10 col-md-8 col-lg-5">

        <div class="card glass-card shadow-lg rounded-4">
          <div class="card-body text-black p-4 p-sm-5">

            <h3 class="text-center fw-bold mb-2">Welcome</h3>
            <p class="text-center text-black mb-4 small">
              Please login to your account
            </p>

            {{-- <form class="d-grid gap-3">

              <div>
                <label class="form-label fw-semibold  ">CNIC No</label>
                <input type="cnic_no" class="form-control bg-transparent text-black border-black"
                       placeholder ="Enter your CNIC" required>
              </div>

              <div>
                <label class="form-label fw-semibold">Password</label>
                <input type="password" class="form-control bg-transparent text-black border-black"
                       placeholder="Enter your password" required>
              </div>

              <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" id="remember">
                  <label for="remember" class="form-check-label">Remember me</label>
                </div>
                <a href="#" class="small text-info text-decoration-none">
                  Forgot password?
                </a>
              </div>

              <button type="submit" class="btn btn-primary fw-semibold py-2">
                Login
              </button>

            </form> --}}

            <form class="d-grid gap-3" method="POST" action="/student/login">
                @csrf

                <div>
                    <label class="form-label fw-semibold">CNIC No</label>
                    <input type="text" name="cnic"
                        class="form-control bg-transparent text-black border-black"
                        placeholder="Enter your CNIC" required>
                </div>

                <div>
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password"
                        class="form-control bg-transparent text-black border-black"
                        placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary fw-semibold py-2">
                    Login
                </button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

