<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('access.users.update', $user) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Edit User</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Role</label>
                        <select name="role" id="editUserRole" class="form-select select2" required>
                            @foreach(\App\Enums\RoleEnum::getLabels() as $value => $label)
                                <option value="{{ $value }}" {{ $user->role === $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3" id="editUserDeptWrap" style="{{ $user->role === 'staff' ? '' : 'display:none;' }}">
                        <label class="form-label fw-semibold small">Assigned Department</label>
                        <select name="department_id" class="form-select select2">
                            <option value="">— None —</option>
                            @foreach($departments as $dept)
                                <option value="{{ $dept->id }}" {{ $user->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Staff will only see inquiries for this department.</small>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">
                            New Password <small class="text-muted fw-normal">(leave blank to keep current)</small>
                        </label>
                        <input type="password" name="password" class="form-control" placeholder="••••••••">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('editUserRole').addEventListener('change', function () {
    document.getElementById('editUserDeptWrap').style.display = this.value === 'staff' ? '' : 'none';
});
</script>
