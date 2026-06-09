@extends('dashboard.layouts.app')
@section('title', 'Faculty')
@section('page-title', 'Faculty')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-chalkboard-user me-2 text-primary"></i>Faculty</h4>
        <small class="text-muted">All registered faculty members</small>
    </div>
    <a href="{{ route('facultyform') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add Faculty
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($faculties->isEmpty())
            <p class="text-center text-muted py-5 mb-0">No faculty members yet.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Profile</th>
                        <th>Name</th>
                        <th>Personal Email</th>
                        <th>Official Email</th>
                        <th>Phone</th>
                        <th>Designation</th>
                        <th>Degree</th>
                        <th>Experience</th>
                        <th class="pe-4">Specialization</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faculties as $faculty)
                    <tr>
                        <td class="ps-4">
                            @if($faculty->profile_picture)
                                <img src="{{ asset('faculty_pictures/' . $faculty->profile_picture) }}"
                                     width="38" height="38"
                                     class="rounded-circle object-fit-cover border">
                            @else
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold"
                                     style="width:38px;height:38px;font-size:.85rem;">
                                    {{ strtoupper(substr($faculty->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td class="fw-medium">{{ $faculty->first_name }} {{ $faculty->last_name }}</td>
                        <td class="text-muted small">{{ $faculty->personal_email }}</td>
                        <td class="text-muted small">{{ $faculty->official_email }}</td>
                        <td>{{ $faculty->phone }}</td>
                        <td>
                            <span class="badge bg-primary-subtle text-primary">{{ $faculty->designation }}</span>
                        </td>
                        <td>{{ $faculty->degree }}</td>
                        <td>{{ $faculty->experience }} yrs</td>
                        <td class="pe-4 text-muted small">{{ $faculty->specialization }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
