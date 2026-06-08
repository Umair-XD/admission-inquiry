
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

            <form class="d-grid gap-3" method="POST" action="/student/register">
                 @csrf

                <!-- Name -->
                <div>
                    <label class="form-label fw-semibold">Full Name</label>
                    <input type="text" name="name"
                        class="form-control bg-transparent text-black border-black"
                        placeholder="Enter your full name" required>
                </div>

                <!-- CNIC -->

                <div>
                    <label class="form-label fw-semibold">CNIC</label>
                    <input type="text" name="cnic"
                    class="form-control bg-transparent text-black border-black"
                    placeholder="12345-1234567-1"
                    pattern="\d{5}-\d{7}-\d{1}"
                    title="CNIC must be like 12345-1234567-1"
                    required>
                </div>

                <!-- Mobile -->
                <div>
                    <label class="form-label fw-semibold">Mobile No</label>
                    <input type="text" name="mobile"
                    class="form-control bg-transparent text-black border-black"
                    placeholder="03XXXXXXXXX"
                    pattern="03[0-9]{9}"
                    title="Mobile must start with 03 and be 11 digits"
                    required>
                </div>

                <div>
                    <label class="form-label fw-semibold">Age</label>
                    <input type="number" name="age"
                        class="form-control bg-transparent text-black border-black"
                        placeholder="Age" required>
                </div>

                <!-- Address -->
                <div>
                    <label class="form-label fw-semibold">Address</label>
                    <textarea name="address" rows="3"
                            class="form-control bg-transparent text-black border-black"
                            placeholder="Enter your address" required></textarea>
                </div>

                <!-- Password -->
                <div>
                    <label class="form-label fw-semibold">Password</label>
                    <input type="password" name="password"
                    class="form-control bg-transparent text-black border-black"
                    placeholder="Enter password"
                    minlength="8"
                    pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}"
                    title="Must contain at least 8 characters, 1 uppercase, 1 lowercase, 1 number"
                    required>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label class="form-label fw-semibold">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="form-control bg-transparent text-black border-black"
                        placeholder="Confirm password" required>
                </div>

                <button type="submit" class="btn btn-primary fw-semibold py-2">
                    Register
                </button>

            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
@endsection

