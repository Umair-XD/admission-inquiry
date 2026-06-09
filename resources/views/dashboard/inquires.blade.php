@extends('dashboard.layouts.app')
@section('title', 'Inquiries')
@section('page-title', 'Inquiries')

@section('content')

@php
function statusBadge($status) {
    return match($status) {
        'active'   => 'success',
        'inactive' => 'danger',
        default    => 'warning'
    };
}
function maturityLabel($status) {
    return match($status) {
        'active'   => 'In Process',
        'inactive' => 'Admitted',
        default    => 'Applicant'
    };
}
@endphp

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-file-lines me-2 text-primary"></i>Inquiries</h4>
        <small class="text-muted">Manage all admission inquiries</small>
    </div>
    <a href="{{ route('inquiryform') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus me-1"></i> Add Inquiry
    </a>
</div>

<div class="card">
    <div class="card-body">

        {{-- Tabs --}}
        <ul class="nav nav-tabs mb-3">
            @foreach(['active','inactive','archive'] as $tab)
            <li class="nav-item">
                <button class="nav-link {{ $tab === 'active' ? 'active' : '' }}"
                        data-bs-toggle="tab"
                        data-bs-target="#tab-{{ $tab }}">
                    {{ ucfirst($tab) }}
                    <span class="badge bg-secondary ms-1">{{ $inquiries->where('status', $tab)->count() }}</span>
                </button>
            </li>
            @endforeach
        </ul>

        <div class="tab-content">
            @foreach(['active','inactive','archive'] as $tab)
            <div class="tab-pane fade {{ $tab === 'active' ? 'show active' : '' }}" id="tab-{{ $tab }}">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Age</th>
                                <th>Phone</th>
                                <th>CNIC</th>
                                <th>Matric</th>
                                <th>Inter P1</th>
                                <th>Inter P2</th>
                                <th>BS</th>
                                <th>MS</th>
                                <th>Entry</th>
                                <th>Status</th>
                                <th>Maturity</th>
                                <th>Change</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inquiries->where('status', $tab) as $inquiry)
                            @php
                                $matric = $inquiry->degrees->where('degree_id', 1)->first();
                                $inter  = $inquiry->degrees->where('degree_id', 2)->first();
                                $bs     = $inquiry->degrees->where('degree_id', 3)->first();
                                $ms     = $inquiry->degrees->where('degree_id', 4)->first();
                            @endphp
                            <tr>
                                <td class="fw-medium small">{{ $inquiry->name }}</td>
                                <td class="small">{{ $inquiry->department?->name ?? '—' }}</td>
                                <td class="small">{{ $inquiry->age }}</td>
                                <td class="small">{{ $inquiry->phone }}</td>
                                <td class="small">{{ $inquiry->cnic }}</td>
                                <td class="small">{{ $matric ? $matric->obtained.'/'.$matric->total : '—' }}</td>
                                <td class="small">{{ $inter  ? $inter->part1_obtained.'/'.$inter->part1_total : '—' }}</td>
                                <td class="small">{{ $inter  ? $inter->part2_obtained.'/'.$inter->part2_total : '—' }}</td>
                                <td class="small">{{ $bs     ? $bs->obtained.'/'.$bs->total : '—' }}</td>
                                <td class="small">{{ $ms     ? $ms->obtained.'/'.$ms->total : '—' }}</td>
                                <td class="small">{{ $inquiry->entry_obtained ? $inquiry->entry_obtained.'/'.$inquiry->entry_total : '—' }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-{{ statusBadge($inquiry->status) }}-subtle text-{{ statusBadge($inquiry->status) }}">
                                        {{ ucfirst($inquiry->status) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-info-subtle text-info rounded-pill">
                                        {{ maturityLabel($inquiry->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('inquiry.status.update', $inquiry->id) }}" method="POST">
                                        @csrf @method('PUT')
                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="min-width:100px">
                                            <option value="active"   {{ $inquiry->status === 'active'   ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $inquiry->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="archive"  {{ $inquiry->status === 'archive'  ? 'selected' : '' }}>Archive</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="text-nowrap">
                                    <button class="btn btn-sm btn-outline-primary me-1"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $inquiry->id }}"
                                            title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <form action="{{ route('inquiry.delete', $inquiry->id) }}" method="POST"
                                          style="display:inline"
                                          onsubmit="return confirm('Delete this inquiry?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            {{-- Edit Modal --}}
                            <div class="modal fade" id="editModal{{ $inquiry->id }}" tabindex="-1">
                                <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <form action="{{ route('inquiry.update', $inquiry->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header bg-primary text-white">
                                                <h6 class="modal-title fw-semibold">Edit Inquiry — {{ $inquiry->name }}</h6>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control form-control-sm" value="{{ $inquiry->name }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Age</label>
                                                        <input type="number" name="age" class="form-control form-control-sm" value="{{ $inquiry->age }}">
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="form-label">Phone</label>
                                                        <input type="text" name="phone" class="form-control form-control-sm" value="{{ $inquiry->phone }}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label">CNIC</label>
                                                        <input type="text" name="cnic" class="form-control form-control-sm" value="{{ $inquiry->cnic }}">
                                                    </div>

                                                    <div class="col-12"><hr class="my-1"><small class="text-muted fw-semibold">Academic Records</small></div>

                                                    <div class="col-md-6">
                                                        <label class="form-label small">Matric (Obtained / Total)</label>
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[1][obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $matric?->obtained }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[1][total]" class="form-control form-control-sm" placeholder="Total" value="{{ $matric?->total }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Inter Part 1 (Obtained / Total)</label>
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[2][part1_obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $inter?->part1_obtained }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[2][part1_total]" class="form-control form-control-sm" placeholder="Total" value="{{ $inter?->part1_total }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Inter Part 2 (Obtained / Total)</label>
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[2][part2_obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $inter?->part2_obtained }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[2][part2_total]" class="form-control form-control-sm" placeholder="Total" value="{{ $inter?->part2_total }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">BS (Obtained / Total)</label>
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[3][obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $bs?->obtained }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[3][total]" class="form-control form-control-sm" placeholder="Total" value="{{ $bs?->total }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">MS (Obtained / Total)</label>
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[4][obtained]" class="form-control form-control-sm" placeholder="Obtained" value="{{ $ms?->obtained }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="degrees[4][total]" class="form-control form-control-sm" placeholder="Total" value="{{ $ms?->total }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label small">Entry Test (Obtained / Total)</label>
                                                        <div class="row g-2">
                                                            <div class="col-6">
                                                                <input type="number" name="entry_obtained" class="form-control form-control-sm" placeholder="Obtained" value="{{ $inquiry->entry_obtained }}">
                                                            </div>
                                                            <div class="col-6">
                                                                <input type="number" name="entry_total" class="form-control form-control-sm" placeholder="Total" value="{{ $inquiry->entry_total }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-sm btn-primary">Update Inquiry</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @empty
                            <tr>
                                <td colspan="15" class="text-center text-muted py-4">No {{ $tab }} inquiries.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>

@endsection
