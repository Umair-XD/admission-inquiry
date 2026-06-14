@extends('dashboard.layouts.app')
@section('title', 'Students')
@section('page-title', 'Students')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-user-graduate me-2 text-primary"></i>Students</h4>
        <small class="text-muted">Students registered from the frontend portal</small>
    </div>
</div>

<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="studentTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student Details</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Academic Record</th>
                        <th>Registered</th>
                        <th class="no-sort">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="editStudentModalContainer"></div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#studentTable').DataTable({
        serverSide: true,
        processing: true,
        order: [[0, 'desc']],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        columnDefs: [{ orderable: false, targets: [-1] }],
        ajax: { url: '{{ route("admin.students") }}' },
        columns: [
            { data: 'id',       className: 'text-muted small' },
            { data: 'details' },
            { data: 'age',      className: 'text-center small' },
            { data: 'address' },
            { data: 'academic' },
            { data: 'created',  className: 'small text-muted' },
            { data: 'actions',  className: 'text-nowrap' },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Search students...',
            processing: '<div class="text-center py-3"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading...</div>',
            emptyTable: 'No students registered yet'
        }
    });
});

function openStudentModal(id) {
    $.get('{{ url("admin/students") }}/' + id + '/edit', function (html) {
        $('#editStudentModalContainer').html(html);
        $('#editStudentModal').modal('show');
    });
}
</script>
@endpush
