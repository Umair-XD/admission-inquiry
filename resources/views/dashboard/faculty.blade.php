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
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="facultyTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Faculty Member</th>
                        <th>Contact</th>
                        <th>Designation</th>
                        <th>Qualification</th>
                        <th>Experience</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#facultyTable').DataTable({
        serverSide: true,
        processing: true,
        order: [],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        ajax: { url: '{{ route("faculty") }}' },
        columns: [
            { data: 'id',          className: 'text-muted small' },
            { data: 'member' },
            { data: 'contact' },
            { data: 'designation' },
            { data: 'degree',      className: 'small fw-medium' },
            { data: 'experience' },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Search faculty...',
            processing: '<div class="text-center py-3"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading...</div>',
            emptyTable: 'No faculty members found'
        }
    });
});
</script>
@endpush
