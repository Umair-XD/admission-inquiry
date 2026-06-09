@extends('dashboard.layouts.app')
@section('title', 'Students')
@section('page-title', 'Students')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-user-graduate me-2 text-primary"></i>Students</h4>
        <small class="text-muted">Students registered from the frontend portal</small>
    </div>
    <span class="badge bg-primary-subtle text-primary fs-6 px-3 py-2">
        {{ $students->count() }} Total
    </span>
</div>

<div class="card">
    <div class="card-body p-0">
        @if($students->isEmpty())
            <div class="text-center py-5 text-muted">
                <i class="fa-solid fa-user-graduate fa-3x mb-3 opacity-25"></i>
                <p class="mb-0">No students have registered yet.</p>
            </div>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Name</th>
                        <th>CNIC</th>
                        <th>Mobile</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Matric</th>
                        <th>Part 1</th>
                        <th>Part 2</th>
                        <th class="pe-4">Entry Test</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $i => $student)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-success bg-opacity-10 text-success d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                     style="width:36px;height:36px;font-size:.8rem;">
                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                </div>
                                <span class="fw-medium">{{ $student->name }}</span>
                            </div>
                        </td>
                        <td class="small text-muted">{{ $student->cnic }}</td>
                        <td class="small">{{ $student->mobile }}</td>
                        <td class="small">{{ $student->age }}</td>
                        <td class="small text-muted" style="max-width:160px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $student->address }}
                        </td>
                        <td class="small">
                            @if($student->matric_marks)
                                <span class="badge bg-light text-dark border">{{ $student->matric_marks }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="small">
                            @if($student->part1_marks)
                                <span class="badge bg-light text-dark border">{{ $student->part1_marks }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="small">
                            @if($student->part2_marks)
                                <span class="badge bg-light text-dark border">{{ $student->part2_marks }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="pe-4 small">
                            @if($student->entry_test_marks)
                                <span class="badge bg-light text-dark border">{{ $student->entry_test_marks }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
