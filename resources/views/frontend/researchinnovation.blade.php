@extends('frontend.layouts.app')
@section('title', 'Research & Innovation')

@section('content')

<!-- ================= HERO SECTION ================= -->
<section class="hero-research py-5 bg-light">
  <div class="container text-center py-4">
    <h1 class="fw-bold text-black">Research & Innovation</h1>
    <p class="mt-3 text-black">
      NFC Institute of Engineering & Fertilizer Research, Faisalabad
    </p>
  </div>
</section>

<!-- ================= INTRO ================= -->
<section class="py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10 text-center">
        <h3 class="fw-bold text-black mb-3">
          Advancing Knowledge & Innovation
        </h3>
        <p class="text-black">
          NFC IEFR Faisalabad is committed to high-quality research and innovation
          that contributes to industrial growth, sustainable development, and
          academic excellence. Our faculty and students actively engage in
          research addressing real-world engineering and technological challenges.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ================= RESEARCH AREAS ================= -->
<section class="py-5 bg-white">
  <div class="container">
    <h4 class="fw-bold text-black text-center mb-4">
      Major Research Areas
    </h4>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-industry fa-2x text-primary mb-3"></i>
          <h6 class="fw-bold text-black">
            Chemical & Fertilizer Engineering
          </h6>
          <p class="small text-black">
            Research focused on fertilizer production, process optimization,
            and industrial chemical systems.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-bolt fa-2x text-primary mb-3"></i>
          <h6 class="fw-bold text-black">
            Electrical & Energy Systems
          </h6>
          <p class="small text-black">
            Power systems, renewable energy, smart grids,
            and electrical automation research.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-microchip fa-2x text-primary mb-3"></i>
          <h6 class="fw-bold text-black">
            Computer Science & IT
          </h6>
          <p class="small text-black">
            Artificial Intelligence, data science, software engineering,
            and emerging computing technologies.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- ================= INNOVATION & LABS ================= -->
<section class="py-5">
  <div class="container">
    <div class="row align-items-center">

      <div class="col-md-6 mb-3">
        <h4 class="fw-bold text-black mb-3">
          Innovation & Research Labs
        </h4>
        <p class="text-black">
          NFC IEFR provides modern laboratories and research facilities
          that support innovation, experimentation, and interdisciplinary
          collaboration between students and faculty.
        </p>
        <ul class="small text-black">
          <li>Advanced Engineering Laboratories</li>
          <li>Final Year Project Research Support</li>
          <li>Industry Collaborative Research</li>
        </ul>
      </div>

      <div class="col-md-6 text-center">
        <img src="{{ asset('frontend/images/NFC-Institute-Faisalabad-Admission.jpg') }}"
             class="img-fluid rounded shadow-sm"
             alt="Research Labs">
      </div>

    </div>
  </div>
</section>

<!-- ================= ONGOING PROJECTS ================= -->
<section class="py-5 bg-white">
  <div class="container">

    <h4 class="fw-bold text-black text-center mb-4">
      Ongoing Research Projects
    </h4>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="border rounded p-3 h-100">
          <h6 class="fw-bold text-black">
            Sustainable Fertilizer Technologies
          </h6>
          <p class="small text-black mb-0">
            Research on environmentally friendly fertilizer processes
            and efficient resource utilization.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="border rounded p-3 h-100">
          <h6 class="fw-bold text-black">
            Smart Energy Management
          </h6>
          <p class="small text-black mb-0">
            Intelligent energy monitoring and optimization systems
            for industrial and domestic use.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="border rounded p-3 h-100">
          <h6 class="fw-bold text-black">
            AI-Based Engineering Solutions
          </h6>
          <p class="small text-black mb-0">
            Application of artificial intelligence in engineering
            problem-solving and automation.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

@endsection