@extends('frontend.layouts.app')

@section('content')


<div class="container py-4">

<!-- =============================
     TITLE
============================= -->
<h2 class="text-center fw-bold my-4 text-black">Top Highlights</h2>


<!-- =============================
     TOP HIGHLIGHTS ROWS
============================= -->
<div class="row g-3">

    <!-- Card 1 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/remote/img-08.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary">ANNOUNCEMENT</h6>
                <h5 class="fw-semibold">NFC Flood Response & Needs Survey</h5>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/remote/img-19.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary">ACHIEVEMENT</h6>
                <h5 class="fw-semibold">NFC Team Wins World Startup Championship</h5>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/remote/img-15.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary">ANNOUNCEMENT</h6>
                <h5 class="fw-semibold">NFC Ranked #1 in Engineering in Pakistan</h5>
            </div>
        </div>
    </div>

</div>

<!-- Second Row -->
<div class="row g-4 mt-2">

    <!-- Card 4 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/remote/img-13.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary">SCHOLARSHIPS</h6>
                <h5 class="fw-semibold">NFC Scholarship Fund for Female Students</h5>
            </div>
        </div>
    </div>

    <!-- Card 5 -->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/remote/img-19.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary">ACHIEVEMENT</h6>
                <h5 class="fw-semibold">Excellence Award – Prof. Dr. Nazaf Ali Awan</h5>
            </div>
        </div>
    </div>
<!--card 6-->
    <div class="col-md-4">
        <div class="card shadow-sm h-100">
            <img src="{{ asset('images/remote/img-15.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h6 class="fw-bold text-secondary">ANNOUNCEMENT</h6>
                <h5 class="fw-semibold">NFC Ranked #1 in Engineering in Pakistan</h5>
            </div>
        </div>
    </div>
</div>



<!-- =============================
     WHAT'S ON SLIDER
============================= -->
<h2 class="text-center fw-bold my-4 text-black">What's On</h2>

<div class="event-slider d-flex gap-3 overflow-auto pb-2">

    <!-- Event 1 -->
    <div class="card" style="min-width: 320px;">
        <img src="{{ asset('images/remote/img-04.jpg') }}" class="card-img-top" height="200" style="object-fit: cover;">
        <div class="card-body">
            <span class="badge bg-warning text-dark float-end">13 Nov</span>
            <h5>EVENT</h5>
            <p>NFC hosts University Day 2025 interactive sessions.</p>
        </div>
    </div>

    <!-- Event 2 -->
    <div class="card" style="min-width: 320px;">
        <img src="{{ asset('images/remote/img-37.webp') }}" class="card-img-top" height="200" style="object-fit: cover;">
        <div class="card-body">
            <span class="badge bg-warning text-dark float-end">18 Nov</span>
            <h5>EVENT</h5>
            <p>Science Exhibition at NFC IEFR.</p>
        </div>
    </div>

    <!-- Event 3 -->
    <div class="card" style="min-width: 320px;">
        <img src="{{ asset('images/remote/img-16.jpg') }}" class="card-img-top" height="200" style="object-fit: cover;">
        <div class="card-body">
            <span class="badge bg-warning text-dark float-end">19 Nov</span>
            <h5>EVENT</h5>
            <p>Startup Bootcamp – Batch 2025.</p>
        </div>
    </div>
</div>



<!-- =============================
     RECTOR MESSAGE
============================= -->
<h2 class="text-center fw-bold my-4 text-black">Rector's Message</h2>

<div class="row g-4 align-items-center">

    <div class="col-md-4">
        <img src="{{ asset('images/remote/img-40.jpg') }}" class="img-fluid rounded">
    </div>

    <div class="col-md-8">
        <div class="p-4 bg-white shadow-sm rounded">
            <h4>Prof. Dr. Nazaf Ali Awan – Rector NFC IEFR</h4>
            <p class="text-black">
                Welcome to NFC IEFR. Our mission is to educate and produce industry-leading
                professionals who will contribute to Pakistan's development and innovation future.
            </p>
        </div>
    </div>

</div>



<!-- =============================
     SCHOLARSHIPS
============================= -->
<h2 class="text-center fw-bold my-4 text-black">Scholarships</h2>

<div class="row g-4">

    <div class="col-md-6">
        <div class="card shadow-sm">
            <img src="{{ asset('images/remote/img-09.jpg') }}" class="card-img-top" height="250" style="object-fit: cover;">
            <div class="card-body">
                <h4>NFC Merit Scholarships</h4>
                <p>Available for top-performing engineering students.</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm">
            <img src="{{ asset('images/remote/img-11.png') }}" class="card-img-top" height="250" style="object-fit: contain;">
            <div class="card-body">
                <h4>Need-Based Scholarships</h4>
                <p>Financial support for deserving students.</p>
            </div>
        </div>
    </div>

</div>

</div>

@endsection