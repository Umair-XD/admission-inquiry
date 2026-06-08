```blade
@extends('dashboard.layouts.app')

@section('content')

<style>
    td i {
        transition: 0.2s;
        cursor: pointer;
    }

    td i:hover {
        transform: scale(1.2);
    }

    .modal .form-control,
    .modal .form-select{
        font-size:14px;
    }
</style>

<div class="container-fluid">

    <div class="row py-4">

        <div class="col-12 d-flex justify-content-between">

            <h3 class="h3 text-primary">
                <i class="fa-solid fa-user"></i> Inquiries
            </h3>

            <a href="{{route('inquiryform')}}"
               class="btn btn-outline-primary">

                Add Inquiry

            </a>

        </div>

    </div>

</div>

<div class="container-fluid">

    <div class="card">

        <h5 class="card-header">
            Inquiry Lists
        </h5>

        <div class="card-body">

            {{-- TABS --}}
            <ul class="nav nav-tabs">

                @foreach(['active','inactive','archive'] as $tab)

                    <li class="nav-item">

                        <button class="nav-link {{ $tab=='active' ? 'active' : '' }}"
                                data-bs-toggle="tab"
                                data-bs-target="#{{$tab}}">

                            {{ ucfirst($tab) }}

                        </button>

                    </li>

                @endforeach

            </ul>

            <div class="tab-content mt-3">

                @php

                function statusBadge($status){
                    return match($status){
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'warning'
                    };
                }

                function maturity($status){
                    return match($status){
                        'active' => 'Process',
                        'inactive' => 'Admitted',
                        default => 'Applicant'
                    };
                }

                @endphp

                @foreach(['active','inactive','archive'] as $tab)

                <div class="tab-pane fade {{ $tab=='active' ? 'show active' : '' }}"
                     id="{{$tab}}">

                    <table class="table table-striped datatable">

                        <thead>

                        <tr>

                            <th>Name</th>
                            <th>Department</th>
                            <th>Age</th>
                            <th>Phone</th>
                            <th>CNIC</th>

                            <th>Matric</th>
                            <th>Inter Part1</th>
                            <th>Inter Part2</th>
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

                        @foreach ($inquiries->where('status',$tab) as $inquiry)

                        @php
                            $matric = $inquiry->degrees->where('degree_id',1)->first();
                            $inter  = $inquiry->degrees->where('degree_id',2)->first();
                            $bs     = $inquiry->degrees->where('degree_id',3)->first();
                            $ms     = $inquiry->degrees->where('degree_id',4)->first();
                        @endphp

                        <tr>

                            <td style="font-size:12px;">{{ $inquiry->name }}</td>

                            <td style="font-size:12px;">
                                {{ $inquiry->department?->name ?? 'N/A' }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $inquiry->age }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $inquiry->phone }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $inquiry->cnic }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $matric ? $matric->obtained.' / '.$matric->total : '-' }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $inter ? $inter->part1_obtained.' / '.$inter->part1_total : '-' }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $inter ? $inter->part2_obtained.' / '.$inter->part2_total : '-' }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $bs ? $bs->obtained.' / '.$bs->total : '-' }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $ms ? $ms->obtained.' / '.$ms->total : '-' }}
                            </td>

                            <td style="font-size:12px;">
                                {{ $inquiry->entry_obtained ? $inquiry->entry_obtained.'/'.$inquiry->entry_total : '-' }}
                            </td>

                            <td>

                                <span class="badge bg-{{ statusBadge($inquiry->status) }}">

                                    {{ ucfirst($inquiry->status) }}

                                </span>

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ maturity($inquiry->status) }}

                                </span>

                            </td>

                            {{-- CHANGE STATUS --}}
                            <td>

                                <form action="{{ route('inquiry.status.update',$inquiry->id) }}"
                                      method="POST">

                                    @csrf
                                    @method('PUT')

                                    <select name="status"
                                            class="form-select form-select-sm"
                                            onchange="this.form.submit()">

                                        <option value="active"
                                            {{ $inquiry->status=='active'?'selected':'' }}>
                                            Active
                                        </option>

                                        <option value="inactive"
                                            {{ $inquiry->status=='inactive'?'selected':'' }}>
                                            Inactive
                                        </option>

                                        <option value="archive"
                                            {{ $inquiry->status=='archive'?'selected':'' }}>
                                            Archive
                                        </option>

                                    </select>

                                </form>

                            </td>

                            {{-- ACTION --}}
                            <td class="text-nowrap">

                                {{-- EDIT --}}
                                <a href="javascript:void(0)"
                                   class="text-primary me-2"
                                   title="Edit"
                                   data-bs-toggle="modal"
                                   data-bs-target="#editInquiryModal{{ $inquiry->id }}">

                                    <i class="bi bi-pencil-square fs-5"></i>

                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('inquiry.delete', $inquiry->id) }}"
                                      method="POST"
                                      style="display:inline-block;"
                                      onsubmit="return confirm('Are you sure you want to delete this inquiry?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn p-0 border-0 bg-transparent text-danger">

                                        <i class="bi bi-trash fs-5"></i>

                                    </button>

                                </form>

                            </td>

                        </tr>

                        {{-- EDIT MODAL --}}
                        <div class="modal fade"
                             id="editInquiryModal{{ $inquiry->id }}"
                             tabindex="-1">

                            <div class="modal-dialog modal-xl modal-dialog-centered">

                                <div class="modal-content">

                                    <form action="{{ route('inquiry.update', $inquiry->id) }}"
                                          method="POST">

                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header bg-primary text-white">

                                            <h5 class="modal-title">
                                                Edit Inquiry
                                            </h5>

                                            <button type="button"
                                                    class="btn-close btn-close-white"
                                                    data-bs-dismiss="modal"></button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="row g-3">

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Name
                                                    </label>

                                                    <input type="text"
                                                           name="name"
                                                           class="form-control"
                                                           value="{{ $inquiry->name }}">

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Age
                                                    </label>

                                                    <input type="number"
                                                           name="age"
                                                           class="form-control"
                                                           value="{{ $inquiry->age }}">

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Phone
                                                    </label>

                                                    <input type="text"
                                                           name="phone"
                                                           class="form-control"
                                                           value="{{ $inquiry->phone }}">

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        CNIC
                                                    </label>

                                                    <input type="text"
                                                           name="cnic"
                                                           class="form-control"
                                                           value="{{ $inquiry->cnic }}">

                                                </div>

                                                {{-- MATRIC --}}
                                                <div class="col-md-6">

                                                    <label class="form-label fw-semibold">
                                                        Matric Marks
                                                    </label>

                                                    <div class="row">

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="matric_obtained"
                                                                class="form-control"
                                                                placeholder="Obtained"
                                                                value="{{ $matric?->obtained }}">

                                                        </div>

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="matric_total"
                                                                class="form-control"
                                                                placeholder="Total"
                                                                value="{{ $matric?->total }}">

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- INTER PART 1 --}}
                                                <div class="col-md-6">

                                                    <label class="form-label fw-semibold">
                                                        Inter Part 1
                                                    </label>

                                                    <div class="row">

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="part1_obtained"
                                                                class="form-control"
                                                                placeholder="Obtained"
                                                                value="{{ $inter?->part1_obtained }}">

                                                        </div>

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="part1_total"
                                                                class="form-control"
                                                                placeholder="Total"
                                                                value="{{ $inter?->part1_total }}">

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- INTER PART 2 --}}
                                                <div class="col-md-6">

                                                    <label class="form-label fw-semibold">
                                                        Inter Part 2
                                                    </label>

                                                    <div class="row">

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="part2_obtained"
                                                                class="form-control"
                                                                placeholder="Obtained"
                                                                value="{{ $inter?->part2_obtained }}">

                                                        </div>

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="part2_total"
                                                                class="form-control"
                                                                placeholder="Total"
                                                                value="{{ $inter?->part2_total }}">

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- BS --}}
                                                <div class="col-md-6">

                                                    <label class="form-label fw-semibold">
                                                        BS Marks
                                                    </label>

                                                    <div class="row">

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="bs_obtained"
                                                                class="form-control"
                                                                placeholder="Obtained"
                                                                value="{{ $bs?->obtained }}">

                                                        </div>

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="bs_total"
                                                                class="form-control"
                                                                placeholder="Total"
                                                                value="{{ $bs?->total }}">

                                                        </div>

                                                    </div>

                                                </div>

                                                {{-- MS --}}
                                                <div class="col-md-6">

                                                    <label class="form-label fw-semibold">
                                                        MS Marks
                                                    </label>

                                                    <div class="row">

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="ms_obtained"
                                                                class="form-control"
                                                                placeholder="Obtained"
                                                                value="{{ $ms?->obtained }}">

                                                        </div>

                                                        <div class="col-6">

                                                            <input type="number"
                                                                name="ms_total"
                                                                class="form-control"
                                                                placeholder="Total"
                                                                value="{{ $ms?->total }}">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Entry Obtained
                                                    </label>

                                                    <input type="number"
                                                           name="entry_obtained"
                                                           class="form-control"
                                                           value="{{ $inquiry->entry_obtained }}">

                                                </div>

                                                <div class="col-md-6">

                                                    <label class="form-label">
                                                        Entry Total
                                                    </label>

                                                    <input type="number"
                                                           name="entry_total"
                                                           class="form-control"
                                                           value="{{ $inquiry->entry_total }}">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button type="button"
                                                    class="btn btn-secondary"
                                                    data-bs-dismiss="modal">

                                                Cancel

                                            </button>

                                            <button type="submit"
                                                    class="btn btn-primary">

                                                Update Inquiry

                                            </button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                        @endforeach

                        </tbody>

                    </table>

                </div>

                @endforeach

            </div>

        </div>

    </div>

</div>

@endsection

<script src="js/jquery.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function () {

    $('.datatable').DataTable();

});

</script>
```
