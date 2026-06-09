@extends('frontend.layouts.app')
@section('title', 'Register')

@section('content')
<div class="container py-4 px-3">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-body text-dark p-4 p-sm-5">

                    <h3 class="text-center fw-bold mb-1">Create Account</h3>
                    <p class="text-center text-muted mb-4 small">Register to submit your admission inquiry</p>

                    @if(session('error'))
                        <div class="alert alert-danger py-2 small">{{ session('error') }}</div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger py-2 small">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="d-grid gap-3" method="POST" action="{{ url('/student/register') }}">
                        @csrf

                        <div>
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Enter your full name"
                                   value="{{ old('name') }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label fw-semibold">CNIC</label>
                            <input type="text" name="cnic"
                                   class="form-control @error('cnic') is-invalid @enderror"
                                   placeholder="xxxxx-xxxxxxx-x"
                                   value="{{ old('cnic') }}" required>
                            @error('cnic')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Mobile No</label>
                            <input type="text" name="mobile"
                                   class="form-control @error('mobile') is-invalid @enderror"
                                   placeholder="03XXXXXXXXX"
                                   value="{{ old('mobile') }}" required>
                            @error('mobile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Age</label>
                            <input type="number" name="age"
                                   class="form-control @error('age') is-invalid @enderror"
                                   placeholder="Age" min="1" max="120"
                                   value="{{ old('age') }}" required>
                            @error('age')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" rows="2"
                                      class="form-control @error('address') is-invalid @enderror"
                                      placeholder="Enter your address" required>{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Minimum 8 characters" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div>
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="Repeat password" required>
                        </div>

                        <button type="submit" class="btn btn-success fw-semibold py-2">
                            Create Account
                        </button>

                        <p class="text-center small text-muted mb-0">
                            Already registered?
                            <a href="{{ route('login') }}" class="text-success fw-semibold">Login here</a>
                        </p>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
