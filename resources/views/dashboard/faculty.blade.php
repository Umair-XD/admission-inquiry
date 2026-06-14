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
                        <th class="no-sort">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<div id="editFacultyModalContainer"></div>

{{-- Assign Department Modal --}}
<div class="modal fade" id="assignDeptModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Assign Department</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="assignDeptForm" method="POST">
                @csrf
                <div class="modal-body">
                    <label class="form-label fw-semibold">Department</label>
                    <select name="department_id" id="assignDeptSelect" class="form-select select2">
                        <option value="">— None —</option>
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                        @endforeach
                    </select>
                    <small class="text-muted mt-1 d-block">This staff member will only see inquiries for the selected department.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save
                    </button>
                </div>
            </form>
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
        columnDefs: [{ orderable: false, targets: [-1] }],
        ajax: { url: '{{ route("faculty") }}' },
        columns: [
            { data: 'id',          className: 'text-muted small' },
            { data: 'member' },
            { data: 'contact' },
            { data: 'designation' },
            { data: 'degree',      className: 'small fw-medium' },
            { data: 'experience' },
            { data: 'actions',     className: 'text-nowrap' },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Search faculty...',
            processing: '<div class="text-center py-3"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading...</div>',
            emptyTable: 'No faculty members found'
        }
    });
});

function openFacultyModal(id) {
    $.get('{{ url("admin/faculty") }}/' + id + '/edit', function (html) {
        $('#editFacultyModalContainer').html(html);
        $('#editFacultyModal').modal('show');
    });
}

function openAssignDept(facultyId, currentDeptId) {
    var baseUrl = '{{ url("admin/faculty") }}/' + facultyId + '/assign-department';
    $('#assignDeptForm').attr('action', baseUrl);
    var $select = $('#assignDeptSelect');
    $select.val(currentDeptId || '').trigger('change');
    $('#assignDeptModal').modal('show');
}
</script>
@endpush
