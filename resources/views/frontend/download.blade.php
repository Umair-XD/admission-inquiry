@extends('frontend.layouts.app')
@section('title', 'Downloads')

@section('content')
<!-- ================= INSTRUCTIONS ================= -->
<section class="py-5">
  <div class="container text-center">
    <h3 class="fw-bold text-black">Available Documents</h3>
    <p class="text-black mt-2">
      Click on the buttons below to download forms, brochures, and other important documents.
    </p>
  </div>
</section>

<!-- ================= DOWNLOAD LIST ================= -->
<section class="pb-5">
  <div class="container">
    <div class="row g-4 justify-content-center">

      <!-- Download Item 1 -->
      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="fw-bold mb-1">Admission Form 2025</h5>
              <p class="mb-0 text-black">PDF Document</p>
            </div>
            <a href="downloads/admission_form_2025.pdf" class="btn btn-primary btn-sm" download>
              Download
            </a>
          </div>
        </div>
      </div>

      <!-- Download Item 2 -->
      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="fw-bold mb-1">Prospectus 2025</h5>
              <p class="mb-0 text-black">PDF Document</p>
            </div>
            <a href="downloads/prospectus_2025.pdf" class="btn btn-success btn-sm" download>
              Download
            </a>
          </div>
        </div>
      </div>

      <!-- Download Item 3 -->
      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="fw-bold mb-1">Fee Structure</h5>
              <p class="mb-0 text-black">PDF Document</p>
            </div>
            <a href="downloads/fee_structure.pdf" class="btn btn-warning btn-sm text-dark" download>
              Download
            </a>
          </div>
        </div>
      </div>

      <!-- Download Item 4 -->
      <div class="col-md-6">
        <div class="card shadow-sm h-100">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div>
              <h5 class="fw-bold mb-1">Academic Calendar 2025</h5>
              <p class="mb-0 text-black">PDF Document</p>
            </div>
            <a href="downloads/academic_calendar_2025.pdf" class="btn btn-info btn-sm text-dark" download>
              Download
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= CONTACT ================= -->
<section class="bg-light py-4 text-center">
  <div class="container text-black">
    <p class="mb-1"><strong>Email:</strong> info@iefr.edu.pk</p>
    <p class="mb-0"><strong>Phone:</strong> +92 41 9220355-57</p>
  </div>
</section>
@endsection
