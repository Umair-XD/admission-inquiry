
@extends('frontend.layouts.app')

@section('content')
<!-- ================= HERO SECTION ================= -->
<section class="hero-campus text-black py-5">
  <div class="container text-center py-5">
    <h1 class="fw-bold">Campus Life</h1>
    <p class="mt-2">Experience vibrant student life at NFC Institute of Engineering & Fertilizer Research, Faisalabad</p>
  </div>
</section>

<!-- ================= STUDENT ACTIVITIES ================= -->
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold text-center mb-4">Student Activities & Clubs</h3>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-users fa-2x text-primary mb-2"></i>
          <h6 class="fw-bold">Student Societies</h6>
          <p class="small text-black">
            Join various societies and clubs for cultural, technical, and leadership development.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-music fa-2x text-primary mb-2"></i>
          <h6 class="fw-bold">Arts & Cultural Events</h6>
          <p class="small text-black">
            Participate in music, drama, and art competitions organized on campus.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-lightbulb fa-2x text-primary mb-2"></i>
          <h6 class="fw-bold">Innovation & Tech Clubs</h6>
          <p class="small text-black">
            Collaborate in research, robotics, coding, and innovation competitions.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= SPORTS & EVENTS ================= -->
<section class="py-5 bg-white">
  <div class="container">
    <h3 class="fw-bold text-center mb-4">Sports & Events</h3>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-futbol fa-2x text-primary mb-2"></i>
          <h6 class="fw-bold">Sports Activities</h6>
          <p class="small text-black">
            Participate in cricket, football, volleyball, and other sports events.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-calendar-days fa-2x text-primary mb-2"></i>
          <h6 class="fw-bold">Annual Events</h6>
          <p class="small text-black">
            Attend seminars, conferences, and annual campus events celebrating achievements.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card h-100 shadow-sm text-center p-3">
          <i class="fa-solid fa-handshake fa-2x text-primary mb-2"></i>
          <h6 class="fw-bold">Community Engagement</h6>
          <p class="small text-black">
            Engage in community service and outreach programs organized by NFC IEFR.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ================= CAMPUS FACILITIES ================= -->
<section class="py-5">
  <div class="container">
    <h3 class="fw-bold text-center text-black mb-4">Campus Facilities</h3>

    <div class="row g-4 text-center">
      <div class="col-md-3">
        <i class="fa-solid fa-building-columns fa-2x text-primary mb-2"></i>
        <h6 class="fw-bold text-black">Library</h6>
      </div>

      <div class="col-md-3">
        <i class="fa-solid fa-flask fa-2x text-primary mb-2"></i>
        <h6 class="fw-bold text-black">Laboratories</h6>
      </div>

      <div class="col-md-3">
        <i class="fa-solid fa-utensils fa-2x text-primary mb-2"></i>
        <h6 class="fw-bold text-black">Cafeteria</h6>
      </div>

      <div class="col-md-3">
        <i class="fa-solid fa-bus fa-2x text-primary mb-2"></i>
        <h6 class="fw-bold text-black">Transport</h6>
      </div>
    </div>
  </div>
</section>
@endsection
