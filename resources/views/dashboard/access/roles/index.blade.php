@extends('dashboard.layouts.app')
@section('title', 'Roles')
@section('page-title', 'Roles')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-shield-halved me-2 text-primary"></i>Roles</h4>
        <small class="text-muted">Manage roles and their permissions</small>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal">
        <i class="fa-solid fa-plus me-1"></i> Add Role
    </button>
</div>

@if($roles->isEmpty())
    <div class="card">
        <div class="card-body text-center py-5 text-muted">
            <i class="fa-solid fa-shield-halved fa-3x mb-3 opacity-25"></i>
            <p class="mb-0">No roles found.</p>
        </div>
    </div>
@else
<div class="row g-3">
    @foreach($roles as $role)
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between py-3"
                 style="cursor:pointer;"
                 data-bs-toggle="collapse"
                 data-bs-target="#roleBody{{ $role->id }}"
                 aria-expanded="true">
                <div class="d-flex align-items-center gap-2">
                    <span class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center"
                          style="width:36px;height:36px;">
                        <i class="fa-solid fa-shield-halved"></i>
                    </span>
                    <div>
                        <div class="fw-semibold text-dark">{{ ucwords(str_replace('_', ' ', $role->name)) }}</div>
                        <small class="text-muted">{{ $role->users_count }} {{ Str::plural('user', $role->users_count) }} · {{ $role->permissions->count() }} {{ Str::plural('permission', $role->permissions->count()) }}</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <button class="btn btn-sm btn-outline-primary"
                            data-bs-toggle="modal"
                            data-bs-target="#editRoleModal{{ $role->id }}"
                            onclick="event.stopPropagation()">
                        <i class="fa-solid fa-pen me-1"></i> Edit Permissions
                    </button>
                    @if($role->name !== 'super_admin')
                    <form action="{{ route('access.roles.destroy', $role) }}" method="POST"
                          onsubmit="confirmDelete(this, 'Delete role {{ $role->name }}?'); return false;"
                          onclick="event.stopPropagation()">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    @endif
                    <i class="fa-solid fa-chevron-up text-muted collapse-icon" style="transition:transform .2s;font-size:.8rem;"></i>
                </div>
            </div>

            {{-- Permissions chips --}}
            <div class="collapse show" id="roleBody{{ $role->id }}">
                <div class="card-body">
                    @if($role->permissions->isEmpty())
                        <span class="text-muted small">No permissions assigned.</span>
                    @else
                        @foreach($role->permissions as $perm)
                            <span class="badge bg-light text-dark border me-1 mb-1">
                                <i class="fa-solid fa-key me-1 text-primary" style="font-size:.65rem;"></i>
                                {{ $perm->name }}
                            </span>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Role Modal --}}
    <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <form action="{{ route('access.roles.update', $role) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-header">
                        <h6 class="modal-title fw-semibold">
                            Edit ({{ ucwords(str_replace('_', ' ', $role->name)) }})
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" style="max-height:65vh;overflow-y:auto;">

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Role Name</label>
                            <input type="text" name="name" class="form-control"
                                   value="{{ $role->name }}"
                                   {{ $role->name === 'super_admin' ? 'readonly' : '' }}>
                        </div>

                        <label class="form-label fw-semibold">Permissions</label>

                        @foreach($permissions as $group => $perms)
                        <div class="mb-3">
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-primary-subtle text-primary">{{ $group }}</span>
                                <button type="button" class="btn btn-link btn-sm p-0 text-muted text-decoration-none select-all-btn"
                                        data-group="{{ $role->id }}-{{ Str::slug($group) }}">
                                    Select all
                                </button>
                            </div>
                            <div class="row g-2">
                                @foreach($perms as $perm)
                                <div class="col-md-4 col-6">
                                    <div class="form-check">
                                        <input class="form-check-input perm-check-{{ $role->id }}-{{ Str::slug($group) }}"
                                               type="checkbox"
                                               name="permissions[]"
                                               value="{{ $perm->name }}"
                                               id="perm_{{ $role->id }}_{{ $perm->id }}"
                                               {{ $role->permissions->contains('id', $perm->id) ? 'checked' : '' }}>
                                        <label class="form-check-label small" for="perm_{{ $role->id }}_{{ $perm->id }}">
                                            {{ $perm->name }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @endforeach
</div>
@endif

{{-- Add Role Modal --}}
<div class="modal fade" id="addRoleModal" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('access.roles.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h6 class="modal-title fw-semibold">Add Role</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Role Name</label>
                    <input type="text" name="name" class="form-control" placeholder="e.g. editor" required>
                    <small class="text-muted">Use lowercase with underscores, e.g. <code>data_entry</code></small>
                    @error('name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function (el) {
    const target = document.querySelector(el.dataset.bsTarget);
    if (!target) return;

    target.addEventListener('hide.bs.collapse', function () {
        el.querySelector('.collapse-icon').style.transform = 'rotate(180deg)';
    });
    target.addEventListener('show.bs.collapse', function () {
        el.querySelector('.collapse-icon').style.transform = 'rotate(0deg)';
    });
});

document.querySelectorAll('.select-all-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        const group = this.dataset.group;
        const boxes = document.querySelectorAll(`.perm-check-${group}`);
        const allChecked = [...boxes].every(b => b.checked);
        boxes.forEach(b => b.checked = !allChecked);
        this.textContent = allChecked ? 'Select all' : 'Deselect all';
    });
});
</script>
@endpush
