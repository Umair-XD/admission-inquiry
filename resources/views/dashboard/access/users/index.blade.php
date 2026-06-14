@extends('dashboard.layouts.app')
@section('title', 'Users')
@section('page-title', 'Users')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-users me-2 text-primary"></i>Users</h4>
        <small class="text-muted">Manage system users and their roles</small>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
        <i class="fa-solid fa-plus me-1"></i> Add User
    </button>
</div>

<div class="card">
    <div class="card-body p-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="usersTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th class="no-sort">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

{{-- Modal containers --}}
<div id="viewUserModalContainer"></div>
<div id="editUserModalContainer"></div>

{{-- Add User Modal --}}
<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('access.users.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Add User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Role</label>
                        <select name="role" id="addUserRole"
                                class="form-select select2 @error('role') is-invalid @enderror" required>
                            <option value="" disabled selected>Select role</option>
                            @foreach(\App\Enums\RoleEnum::getLabels() as $value => $label)
                                <option value="{{ $value }}" {{ old('role') === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3" id="addUserDeptWrap" style="display:none;">
                        <label class="form-label fw-semibold small">Assigned Department</label>
                        <select name="department_id" class="form-select select2">
                            <option value="">— None —</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ old('department_id') == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Staff will only see inquiries for this department.</small>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">Password</label>
                        <input type="password" name="password"
                               class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Create User</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#usersTable').DataTable({
        serverSide: true,
        processing: true,
        order: [[0, 'desc']],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        columnDefs: [{ orderable: false, targets: [-1] }],
        ajax: { url: '{{ route("access.users.index") }}' },
        columns: [
            { data: 'id',      className: 'text-muted small' },
            { data: 'user' },
            { data: 'email' },
            { data: 'role' },
            { data: 'created', className: 'small text-muted' },
            { data: 'actions', className: 'text-nowrap no-sort' },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Search users...',
            processing: '<div class="text-center py-3"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading...</div>',
            emptyTable: 'No users found'
        }
    });
});

// Show department field only for staff role (add modal)
document.getElementById('addUserRole').addEventListener('change', function () {
    document.getElementById('addUserDeptWrap').style.display = this.value === 'staff' ? '' : 'none';
});

function openViewUserModal(id) {
    $.get('{{ url("admin/access/users") }}/' + id + '/show', function (html) {
        $('#viewUserModalContainer').html(html);
        $('#viewUserModal').modal('show');
    });
}

function openUserModal(id) {
    $.get('{{ url("admin/access/users") }}/' + id + '/edit', function(html) {
        $('#editUserModalContainer').html(html);
        $('#editUserModal').modal('show');
    }).fail(function() {
        alert('Could not load user. Please try again.');
    });
}
</script>
@endpush
