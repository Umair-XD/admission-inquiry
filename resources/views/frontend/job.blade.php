@extends('frontend.layouts.app')
@section('title', 'Jobs')

@section('content')
<!-- ================= INTRO ================= -->
<section class="py-5 ">
  <div class="container text-center text-black">
    <h3 class="fw-bold">Work With Us</h3>
    <p class="text-black mt-2">
      NFC IEFR offers exciting career opportunities for professionals,
      researchers, and academic staff in a dynamic learning environment.
    </p>
  </div>
</section>

<!-- ================= JOB LISTINGS ================= -->
<section class="pb-5">
  <div class="container">

    <div class="row g-4">

      <!-- Job Card 1 -->
      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold">Assistant Professor (Computer Science)</h5>
            <p class="text-muted mb-2">Department of Computer Science</p>
            <ul class="mb-3">
              <li>PhD / MS in relevant field</li>
              <li>Teaching & research experience preferred</li>
              <li>Strong communication skills</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-primary">Full Time</span>
              <button class="btn btn-outline-primary btn-sm">Apply Now</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Job Card 2 -->
      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold">Lecturer (Electrical Engineering)</h5>
            <p class="text-muted mb-2">Department of Electrical Engineering</p>
            <ul class="mb-3">
              <li>MS in Electrical Engineering</li>
              <li>Fresh candidates can apply</li>
              <li>Strong academic background</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-success">Contract</span>
              <button class="btn btn-outline-success btn-sm">Apply Now</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Job Card 3 -->
      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold">Lab Engineer</h5>
            <p class="text-muted mb-2">Chemical Engineering Department</p>
            <ul class="mb-3">
              <li>BSc / MSc in Chemical Engineering</li>
              <li>Lab handling experience</li>
              <li>Knowledge of safety standards</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-warning text-dark">On Campus</span>
              <button class="btn btn-outline-warning btn-sm">Apply Now</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Job Card 4 -->
      <div class="col-md-6">
        <div class="card h-100 shadow-sm">
          <div class="card-body">
            <h5 class="fw-bold">Office Assistant</h5>
            <p class="text-muted mb-2">Administration Office</p>
            <ul class="mb-3">
              <li>Graduation (any discipline)</li>
              <li>Computer & office skills</li>
              <li>Good communication skills</li>
            </ul>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-info">Support Staff</span>
              <button class="btn btn-outline-info btn-sm">Apply Now</button>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</section>

<!-- ================= CONTACT ================= -->
<section class="bg-light py-4">
  <div class="container text-center text-black">
    <p class="mb-1"><strong>Email:</strong> jobs@iefr.edu.pk</p>
    <p class="mb-0"><strong>Phone:</strong> +92 41 9220355-57</p>
  </div>
</section>
@endsection
