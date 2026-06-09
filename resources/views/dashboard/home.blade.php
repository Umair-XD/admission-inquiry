@extends('dashboard.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stats Row --}}
<div class="row g-3 mb-4">

    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-primary bg-opacity-10">
                    <i class="fa-solid fa-file-lines fa-lg text-primary"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $totalInquiries }}</div>
                    <div class="text-muted small">Total Inquiries</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-success bg-opacity-10">
                    <i class="fa-solid fa-building-columns fa-lg text-success"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $totalDepartments }}</div>
                    <div class="text-muted small">Departments</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-warning bg-opacity-10">
                    <i class="fa-solid fa-chalkboard-user fa-lg text-warning"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $totalFaculty }}</div>
                    <div class="text-muted small">Faculty Members</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-6 col-md-3">
        <div class="card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="rounded-3 p-3 bg-danger bg-opacity-10">
                    <i class="fa-solid fa-user-graduate fa-lg text-danger"></i>
                </div>
                <div>
                    <div class="fw-bold fs-4 text-dark">{{ $totalStudents }}</div>
                    <div class="text-muted small">Students</div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Recent Inquiries --}}
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i>Recent Inquiries</span>
        <a href="{{ route('inquires') }}" class="btn btn-sm btn-outline-primary">View All</a>
    </div>
    <div class="card-body p-0">
        @if($recentInquiries->isEmpty())
            <p class="text-center text-muted py-4 mb-0">No inquiries yet.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Name</th>
                        <th>Department</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th class="pe-4">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentInquiries as $inquiry)
                    <tr>
                        <td class="ps-4 fw-medium">{{ $inquiry->name }}</td>
                        <td>{{ $inquiry->department?->name ?? '—' }}</td>
                        <td>{{ $inquiry->phone }}</td>
                        <td>
                            <span class="badge rounded-pill
                                {{ $inquiry->status === 'active' ? 'bg-success-subtle text-success' :
                                   ($inquiry->status === 'inactive' ? 'bg-danger-subtle text-danger' : 'bg-warning-subtle text-warning') }}">
                                {{ ucfirst($inquiry->status) }}
                            </span>
                        </td>
                        <td class="pe-4 text-muted small">{{ $inquiry->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
