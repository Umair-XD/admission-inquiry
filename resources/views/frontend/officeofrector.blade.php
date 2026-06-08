@extends('frontend.layouts.app')

@section('content')

<!-- ================= HERO / DIRECTOR SECTION ================= -->
<section class="hero-rector d-flex align-items-center text-dark">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-md-6"></div>

      <div class="col-md-6 text-end">

        <p class="fs-4 fw-bold text-uppercase">
          Office of Sector
        </p>

        <p class="fs-5 mt-4 fw-semibold" style="line-height:1.6;">
          AS WE EMBRACE THE FUTURE WITH A SHARED VISION, OUR PRIMARY
          FOCUS SHALL REMAIN ON EQUIPPING THE NEXT GENERATION WITH
          WORLD-CLASS KNOWLEDGE
        </p>

        <h5 class="fw-bold mt-4 mb-0">
          Prof. Dr. Najaf Ali Awan
        </h5>

        <p class="mb-0 fw-semibold">
          Director, NFC IEFR
        </p>

      </div>

    </div>
  </div>
</section>



<!-- ================= ABOUT SECTION ================= -->
<section class="py-5 text-dark">
  <div class="container">
    <div class="row align-items-center">
      
      <div class="col-md-6">
        <h2 class="fw-bold">
          About the Office
        </h2>

        <p class="mt-3 fw-semibold">
          The Office of Sector at NFC IEFR plays a vital role in managing
          academic coordination, administrative planning, and institutional
          development to ensure smooth operations across all departments.
        </p>
      </div>

      <div class="col-md-6 text-center">
        <img src="{{ asset('frontend/images/images.jfif') }}"
             class="img-fluid rounded shadow"
             alt="Office Image">
      </div>

    </div>
  </div>
</section>



<!-- ================= RESPONSIBILITIES ================= -->
<section class="bg-light py-5 text-dark">
  <div class="container">

    <h2 class="text-center fw-bold mb-4">
      Our Responsibilities
    </h2>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-dark">
          <div class="card-body text-center">
            <h5 class="fw-bold">
              Academic Coordination
            </h5>
            <p class="fw-semibold">
              Ensuring smooth academic operations and coordination.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-dark">
          <div class="card-body text-center">
            <h5 class="fw-bold">
              Administrative Support
            </h5>
            <p class="fw-semibold">
              Managing administrative policies and office affairs.
            </p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-dark">
          <div class="card-body text-center">
            <h5 class="fw-bold">
              Institutional Planning
            </h5>
            <p class="fw-semibold">
              Planning for growth, development and quality assurance.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>



<!-- ================= CONTACT INFORMATION ================= -->
<section class="py-5 text-dark">
  <div class="container">

    <h2 class="text-center fw-bold mb-4">
      Contact Information
    </h2>

    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow text-center text-dark">
          <div class="card-body">
            <p class="fw-semibold">
              <strong>Phone Number:</strong> +92 41 9220355-57
            </p>
            <p class="fw-semibold">
              <strong>Fax:</strong> +92 41 9220360
            </p>
            <p class="fw-semibold">
              <strong>Email:</strong> info@iefr.edu.pk
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@endsection