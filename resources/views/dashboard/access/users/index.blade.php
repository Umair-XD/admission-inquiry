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
    <div class="card-body p-0">
        @if($users->isEmpty())
            <p class="text-center text-muted py-5 mb-0">No users found.</p>
        @else
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created</th>
                        <th class="text-end pe-4">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $i + 1 }}</td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0"
                                     style="width:36px;height:36px;font-size:.8rem;">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span class="fw-medium">{{ $user->name }}</span>
                                @if($user->id === auth()->id())
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill small">You</span>
                                @endif
                            </div>
                        </td>
                        <td class="text-muted small">{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge rounded-pill
                                    {{ $role->name === 'super_admin' ? 'bg-danger-subtle text-danger' :
                                       ($role->name === 'admin' ? 'bg-primary-subtle text-primary' : 'bg-secondary-subtle text-secondary') }}">
                                    {{ ucwords(str_replace('_', ' ', $role->name)) }}
                                </span>
                            @endforeach
                            @if($user->roles->isEmpty())
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-outline-primary me-1"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editUserModal{{ $user->id }}">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('access.users.destroy', $user) }}" method="POST"
                                  style="display:inline"
                                  onsubmit="return confirm('Delete {{ $user->name }}?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>

                    {{-- Edit Modal --}}
                    <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1">
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
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Role</label>
                                            <select name="role" class="form-select" required>
                                                @foreach(\App\Enums\RoleEnum::getLabels() as $value => $label)
                                                    <option value="{{ $value }}" {{ $user->role === $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">New Password <small class="text-muted">(leave blank to keep current)</small></label>
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

                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

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
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                            <option value="" disabled selected>Select role</option>
                            @foreach(\App\Enums\RoleEnum::getLabels() as $value => $label)
                                <option value="{{ $value }}" {{ old('role') === $value ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-1">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
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
