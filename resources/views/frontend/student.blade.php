@extends('frontend.layouts.app')
@section('title', 'Students')

@section('content')
<!-- ================= INQUIRY INFO ================= -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-8 text-center mb-4">
        <h3 class="fw-bold">Need Help?</h3>
        <p class="text-muted">
          Students can submit their academic, admission, or general inquiries
          through the form below. Our team will respond as soon as possible.
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ================= INQUIRY FORM ================= -->
<section class="pb-5">
  <div class="container">
    <div class="row justify-content-center">

      <div class="col-md-8">
        <div class="card shadow-sm">
          <div class="card-body">

            <h4 class="fw-bold mb-4 text-center">Student Inquiry Form</h4>

            <form>
              <div class="row g-3">

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Student Name</label>
                  <input type="text" class="form-control" placeholder="Enter your name" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Registration No</label>
                  <input type="text" class="form-control" placeholder="e.g. NFC-21-BCS-001">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Email Address</label>
                  <input type="email" class="form-control" placeholder="student@nfc.edu.pk" required>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Phone Number</label>
                  <input type="tel" class="form-control" placeholder="+92 3XX XXXXXXX">
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Department</label>
                  <select class="form-select">
                    <option selected>Select Department</option>
                    <option>Computer Science</option>
                    <option>Electrical Engineering</option>
                    <option>Chemical Engineering</option>
                    <option>Mechanical Engineering</option>
                    <option>Management Sciences</option>
                  </select>
                </div>

                <div class="col-md-6">
                  <label class="form-label fw-semibold">Inquiry Type</label>
                  <select class="form-select">
                    <option selected>Select Inquiry Type</option>
                    <option>Academic</option>
                    <option>Admissions</option>
                    <option>Fees</option>
                    <option>Examinations</option>
                    <option>General</option>
                  </select>
                </div>

                <div class="col-12">
                  <label class="form-label fw-semibold">Your Inquiry</label>
                  <textarea class="form-control" rows="4" placeholder="Write your inquiry here..." required></textarea>
                </div>

                <div class="col-12 text-center mt-3">
                  <button type="submit" class="btn btn-primary px-5">
                    Submit Inquiry
                  </button>
                </div>

              </div>
            </form>

          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= CONTACT INFO ================= -->
<section class="bg-light py-4">
  <div class="container text-center">
    <p class="mb-1"><strong>Email:</strong> info@iefr.edu.pk</p>
    <p class="mb-0"><strong>Phone:</strong> +92 41 9220355-57</p>
  </div>
</section>
@endsection

