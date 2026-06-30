@extends('frontend.layouts.app')
@section('title', 'Alumni')

@section('content')

<!-- Hero Section (Same as before) -->
<section class="py-5 text-center text-white" 
style="background: linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.65)), url('{{ asset('images/remote/img-27.jpg') }}') center/cover;">
  <div class="container">
    <h1 class="fw-bold">NFC (IEFR) Alumni Network</h1>
    <p class="lead mt-3">
      Connecting our proud graduates across the globe and celebrating their achievements.
    </p>
  </div>
</section>

<!-- About Alumni -->
<section class="py-5 text-dark">
  <div class="container">
    <div class="row align-items-center g-4">

      <div class="col-md-6">
        <h2 class="fw-bold mb-3">About Our Alumni</h2>

        <p class="fw-semibold">
          The NFC (IEFR) Alumni Network is a vibrant community of graduates who continue to inspire, lead, and contribute in various fields across Pakistan and worldwide.
        </p>

        <ul class="fw-semibold">
          <li>Career networking & mentorship</li>
          <li>Alumni events & reunions</li>
          <li>Professional development programs</li>
          <li>Student support & guidance</li>
        </ul>
      </div>

      <div class="col-md-6">
        <img src="{{ asset('images/remote/img-24.jpg') }}"
             class="img-fluid rounded shadow"
             alt="Alumni meeting">
      </div>

    </div>
  </div>
</section>

<!-- Alumni Achievements -->
<section class="py-5 bg-light text-dark">
  <div class="container">

    <h2 class="fw-bold text-center mb-4">
      Alumni Achievements
    </h2>

    <div class="row g-4">

      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-sm text-dark">
          <img src="{{ asset('images/remote/img-30.jpg') }}"
               class="card-img-top"
               alt="Entrepreneur">
          <div class="card-body">
            <h5 class="fw-bold">Successful Entrepreneurs</h5>
            <p class="fw-semibold">
              Our alumni are leading startups and innovative businesses.
            </p>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-sm text-dark">
          <img src="{{ asset('images/remote/img-26.jpg') }}"
               class="card-img-top"
               alt="Corporate leaders">
          <div class="card-body">
            <h5 class="fw-bold">Corporate Leaders</h5>
            <p class="fw-semibold">
              Alumni working as CEOs and professionals in firms.
            </p>
          </div>
        </div>
      </div>

      <div class="col-sm-6 col-lg-4">
        <div class="card h-100 shadow-sm text-dark">
          <img src="{{ asset('images/remote/img-29.jpg') }}"
               class="card-img-top"
               alt="Researchers">
          <div class="card-body">
            <h5 class="fw-bold">Researchers & Academics</h5>
            <p class="fw-semibold">
              Alumni contributing to research and education.
            </p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Alumni Gallery -->
<section class="py-5 text-dark">
  <div class="container">
    <h2 class="fw-bold text-center mb-4">
      Alumni Gallery
    </h2>

    <div class="row g-3">
      <div class="col-6 col-md-3">
        <img src="{{ asset('images/remote/img-28.jpg') }}"
             class="img-fluid rounded shadow-sm"
             alt="Event 1">
      </div>
      <div class="col-6 col-md-3">
        <img src="{{ asset('images/remote/img-25.jpg') }}"
             class="img-fluid rounded shadow-sm"
             alt="Event 2">
      </div>
      <div class="col-6 col-md-3">
        <img src="{{ asset('images/remote/img-23.jpg') }}"
             class="img-fluid rounded shadow-sm"
             alt="Event 3">
      </div>
      <div class="col-6 col-md-3">
        <img src="{{ asset('images/remote/img-26.jpg') }}"
             class="img-fluid rounded shadow-sm"
             alt="Event 4">
      </div>
    </div>
  </div>
</section>

<!-- Alumni Testimonials -->
<section class="py-5 bg-light text-dark">
  <div class="container">

    <h2 class="fw-bold text-center mb-4">
      What Our Alumni Say
    </h2>

    <div class="row g-4">

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-dark">
          <div class="card-body">
            <p class="fw-semibold">
              “NFC (IEFR) shaped my career and gave me confidence to succeed professionally.”
            </p>
            <h6 class="fw-bold mb-0">Ali Raza</h6>
            <small class="fw-semibold">Software Engineer</small>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-dark">
          <div class="card-body">
            <p class="fw-semibold">
              “The teachers and campus environment played a huge role in my personal growth.”
            </p>
            <h6 class="fw-bold mb-0">Ayesha Khan</h6>
            <small class="fw-semibold">HR Manager</small>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-dark">
          <div class="card-body">
            <p class="fw-semibold">
              “Being part of NFC alumni network keeps me connected and motivated.”
            </p>
            <h6 class="fw-bold mb-0">Usman Ahmed</h6>
            <small class="fw-semibold">Entrepreneur</small>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection