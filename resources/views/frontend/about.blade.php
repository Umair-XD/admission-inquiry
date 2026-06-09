@extends('frontend.layouts.app')
@section('title', 'About Us')
@section('content')
<!-- PAGE CONTENT -->

<div class="container mt-4">

    <!-- SECTION BOXES -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm h-100 p-3">
                <h5 class="text-primary">VISION</h5>
                <p>NFC Institute aims to be a center of excellence providing modern engineering education,
                innovation, and leadership, enabling students to contribute to national development with
                integrity, professionalism, and sustainability.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 p-3">
                <h5 class="text-primary">MISSION</h5>
                <p>Our mission is to deliver high-quality education, foster research culture, encourage
                creativity, and develop industry-ready professionals. We are committed to producing
                responsible engineers who contribute to technological progress and community welfare.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100 p-3">
                <h5 class="text-primary">CORE VALUES</h5>
                <p>We believe in academic excellence, innovation, teamwork, integrity, respect, and
                continuous growth. NFC nurtures an environment where students learn, explore, and build
                strong ethical foundations to shape a better future.</p>
            </div>
        </div>
    </div>

   <!-- HISTORY CARD -->
<div class="card mb-4 shadow-sm border-0">
    <div class="row g-0">
        <div class="col-md-5">
            <img src="{{ asset('images/Nfc-Iefr-1.jpg') }}"class="img-fluid rounded-start"alt="History">

        </div>
        <div class="col-md-7">
            <div class="card-body text-center d-flex flex-column justify-content-center h-100">
                <h5 class="card-title text-primary">HISTORY OF NFC</h5>
                <p class="card-text">
                    NFC Institute was established to promote engineering, industrial research,
                    technical education, and sustainable development across Pakistan.
                    The institute continues to contribute to higher scientific learning…
                </p>
                <a href="#" class="btn btn-sm btn-primary align-self-center">
                    View Details →
                </a>
            </div>
        </div>
    </div>
</div>


    <!-- OTHER CARDS -->
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://picsum.photos/600/300?random=1" class="card-img-top" alt="Programs">
                <div class="card-body">
                    <h5 class="card-title text-primary">OUR PROGRAMS</h5>
                    <p class="card-text">NFC offers top-ranked engineering programs designed to build strong foundations
                    in modern education and industry needs.</p>
                    <a href="#" class="btn btn-sm btn-primary">View Details →</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://picsum.photos/600/300?random=2" class="card-img-top" alt="Campus Life">
                <div class="card-body">
                    <h5 class="card-title text-primary">CAMPUS LIFE</h5>
                    <p class="card-text">A vibrant campus with academic excellence, co-curricular activities,
                    and a supportive learning environment for students.</p>
                    <a href="#" class="btn btn-sm btn-primary">View Details →</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://i.ytimg.com/vi/JKvsZbCizf0/maxresdefault.jpg" class="card-img-top" alt="Research">
                <div class="card-body">
                    <h5 class="card-title text-primary">RESEARCH & INNOVATION</h5>
                    <p class="card-text">NFC IEFR Faisalabad continues to achieve remarkable success through quality education, innovation, and student excellence.</p>
                    <a href="#" class="btn btn-sm btn-primary">View Details →</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100 shadow-sm border-0">
                <img src="https://picsum.photos/600/300?random=4" class="card-img-top" alt="Admissions">
                <div class="card-body">
                    <h5 class="card-title text-primary">ADMISSIONS</h5>
                    <p class="card-text">Join NFC to begin your engineering future with strong academic programs,
                    modern facilities, and industry-ready training.</p>
                    <a href="#" class="btn btn-sm btn-primary">View Details →</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
