<div class="modal fade" id="viewUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-primary bg-opacity-10 text-primary d-flex align-items-center justify-content-center fw-bold flex-shrink-0" style="width:40px;height:40px;font-size:.85rem;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h6 class="modal-title fw-semibold mb-0">{{ $user->name }}</h6>
                        <small class="text-muted">{{ $user->email }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <div class="row g-2">
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Role</div>
                            <div class="mt-1">
                                @foreach($user->roles as $role)
                                    @php
                                        $cls = match($role->name) {
                                            'super_admin' => 'bg-danger-subtle text-danger',
                                            'admin'       => 'bg-primary-subtle text-primary',
                                            default       => 'bg-secondary-subtle text-secondary',
                                        };
                                    @endphp
                                    <span class="badge rounded-pill {{ $cls }}">{{ ucwords(str_replace('_', ' ', $role->name)) }}</span>
                                @endforeach
                                @if($user->roles->isEmpty())
                                    <span class="text-muted small">—</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Department</div>
                            <div class="fw-medium small mt-1">{{ $user->department?->name ?? '—' }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Joined</div>
                            <div class="fw-medium small mt-1">{{ $user->created_at->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-light rounded p-2">
                            <div class="text-muted" style="font-size:.7rem;">Last Updated</div>
                            <div class="fw-medium small mt-1">{{ $user->updated_at->format('d M Y') }}</div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
