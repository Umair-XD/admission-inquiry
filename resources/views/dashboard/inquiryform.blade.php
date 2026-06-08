@extends('dashboard.layouts.app')

@section('content')

@if(session('success'))
<div class="container-fluid mt-3">
    <div class="alert alert-success alert-dismissible fade show">
        <i class="fa-solid fa-circle-check me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif

<div class="container-fluid">
    <div class="row py-4">
        <div class="col-12 d-flex justify-content-between">
            <h3 class="text-primary">
                <i class="fa-solid fa-user"></i> Add Inquiry
            </h3>
            <a href="{{route('admin.dashboard')}}" class="btn btn-outline-primary">Back</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <h5 class="card-header">Add Inquiry</h5>

        <div class="card-body">

            <form class="row g-4 p-4 bg-light" method="POST" action="{{ route('inquiryform.store') }}">
                @csrf

                {{-- NAME --}}
                <div class="col-md-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                {{-- AGE --}}
                <div class="col-md-6">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required>
                </div>

                {{-- PHONE --}}
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" id="phone" name="phone" class="form-control" placeholder="03xx-xxxxxxx">
                </div>

                {{-- CNIC --}}
                <div class="col-md-6">
                    <label>CNIC</label>
                    <input type="text" id="cnic" name="cnic" class="form-control" placeholder="xxxxx-xxxxxxx-x">
                </div>

                {{-- DEPARTMENT --}}
                <div class="col-md-6">
                    <label>Department</label>
                    <select name="department_id" id="department" class="form-select">
                        <option disabled selected>Select Department</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- COURSE --}}
                <div class="col-md-6">
                    <label>Course</label>
                    <select name="course_id" id="course" class="form-select">
                        <option disabled selected>Select Course</option>
                    </select>
                </div>

                {{-- DEGREE --}}
                <div class="col-md-6">
                    <label>Degree</label>
                    <select id="degree" class="form-select">
                        <option disabled selected>Select Degree</option>
                        @foreach($degrees as $degree)
                            <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- DEGREE FIELDS --}}
                <div id="allDegrees">

                    {{-- MATRIC --}}
                    <div class="degree-box d-none" id="degree-1">
                        <label>Matric Marks</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="degrees[1][obtained]" class="form-control" placeholder="Obtained">
                            </div>
                            <div class="col-6">
                                <input type="text" name="degrees[1][total]" class="form-control" placeholder="Total">
                            </div>
                        </div>
                    </div>

                    {{-- INTERMEDIATE --}}
                    <div class="degree-box d-none" id="degree-2">
                        <label>Intermediate - Part 1</label>
                        <input type="text" name="degrees[2][part1_obtained]" class="form-control mb-2" placeholder="Obtained">
                        <input type="text" name="degrees[2][part1_total]" class="form-control mb-3" placeholder="Total">

                        <label>Intermediate - Part 2</label>
                        <input type="text" name="degrees[2][part2_obtained]" class="form-control mb-2" placeholder="Obtained">
                        <input type="text" name="degrees[2][part2_total]" class="form-control" placeholder="Total">
                    </div>

                    {{-- BS --}}
                    <div class="degree-box d-none" id="degree-3">
                        <label>Bachelors Marks</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="degrees[3][obtained]" class="form-control" placeholder="Obtained">
                            </div>
                            <div class="col-6">
                                <input type="text" name="degrees[3][total]" class="form-control" placeholder="Total">
                            </div>
                        </div>
                    </div>

                    {{-- MS --}}
                    <div class="degree-box d-none" id="degree-4">
                        <label>Masters Marks</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="degrees[4][obtained]" class="form-control" placeholder="Obtained">
                            </div>
                            <div class="col-6">
                                <input type="text" name="degrees[4][total]" class="form-control" placeholder="Total">
                            </div>
                        </div>
                    </div>

                </div>

                {{-- ENTRY TEST --}}
                <div class="col-md-6">
                    <label>Entry Test</label>

                    <div class="form-check mb-2">
                        <input type="checkbox" id="entryCheck" class="form-check-input">
                        <label class="form-check-label">Appeared in Entry Test</label>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <input type="number" id="entryObt" name="entry_obtained" class="form-control" disabled>
                        </div>
                        <div class="col-6">
                            <input type="number" id="entryTotal" name="entry_total" class="form-control" disabled>
                        </div>
                    </div>
                </div>

                {{-- SUBMIT --}}
                <div class="col-12 text-center">
                    <button class="btn btn-primary px-5">Submit</button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- ================= SCRIPTS ================= --}}
<script>
document.addEventListener("DOMContentLoaded", function () {

    /* DEGREE SHOW */
    document.getElementById('degree').addEventListener('change', function () {
        let id = this.value;

        document.querySelectorAll('.degree-box').forEach(box => {
            box.classList.add('d-none');
        });

        let selected = document.getElementById('degree-' + id);
        if (selected) selected.classList.remove('d-none');
    });

    /* COURSE LOAD */
    document.getElementById('department').addEventListener('change', function () {

        let id = this.value;
        let course = document.getElementById('course');

        course.innerHTML = `<option>Loading...</option>`;

        fetch("{{ route('courses.by.department', ':id') }}".replace(':id', id))
            .then(res => res.json())
            .then(data => {

                let html = `<option disabled selected>Select Course</option>`;

                if(data.length === 0){
                    html = `<option disabled>No Courses Found</option>`;
                }

                data.forEach(c => {
                    html += `<option value="${c.id}">${c.name}</option>`;
                });

                course.innerHTML = html;
            });
    });

    /* ENTRY TEST */
    document.getElementById('entryCheck').addEventListener('change', function () {
        document.getElementById('entryObt').disabled = !this.checked;
        document.getElementById('entryTotal').disabled = !this.checked;
    });

    /* CNIC FORMAT */
    document.getElementById('cnic').addEventListener('input', function () {
        let raw = this.value.replace(/\D/g,'').slice(0,13);
        let formatted = raw;

        if (raw.length > 5 && raw.length <= 12) {
            formatted = raw.slice(0,5) + '-' + raw.slice(5);
        } else if (raw.length > 12) {
            formatted = raw.slice(0,5) + '-' + raw.slice(5,12) + '-' + raw.slice(12);
        }

        this.value = formatted;
    });

    /* PHONE FORMAT */
    document.getElementById('phone').addEventListener('input', function () {
        let raw = this.value.replace(/\D/g,'').slice(0,11);
        let formatted = raw;

        if (raw.length > 4) {
            formatted = raw.slice(0,4) + '-' + raw.slice(4);
        }

        this.value = formatted;
    });

});
</script>

@endsection
