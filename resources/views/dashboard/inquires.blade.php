@extends('dashboard.layouts.app')
@section('title', 'Inquiries')
@section('page-title', 'Inquiries')

@section('content')

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

        <ul class="nav nav-tabs mb-3" id="inquiryTabs">
            <li class="nav-item">
                <button class="nav-link active" data-tab="active" onclick="switchTab(this, 'active')">
                    Active
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-tab="inactive" onclick="switchTab(this, 'inactive')">
                    Inactive
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-tab="archive" onclick="switchTab(this, 'archive')">
                    Archive
                </button>
            </li>
        </ul>

        <div class="table-responsive">
            <table class="table table-hover align-middle w-100" id="inquiryTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Details</th>
                        <th>Department / Course</th>
                        <th>Age</th>
                        <th>Academic Summary</th>
                        <th>Status</th>
                        <th>Change Status</th>
                        <th class="no-sort">Actions</th>
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>

{{-- Edit Modals — rendered once, filled via JS --}}
<div id="editModalContainer"></div>

@endsection

@push('scripts')
<script>
var inquiryTable;
var currentTab = 'active';

function initTable(status) {
    if (inquiryTable) {
        inquiryTable.destroy();
    }

    inquiryTable = $('#inquiryTable').DataTable({
        serverSide: true,
        processing: true,
        order: [],
        pageLength: 10,
        lengthMenu: [10, 25, 50, 100],
        columnDefs: [{ orderable: false, targets: [5, 6, 7] }],
        ajax: {
            url: '{{ route("inquires") }}',
            data: function (d) {
                d.status = status;
            }
        },
        columns: [
            { data: 'id', className: 'text-muted small' },
            { data: 'details' },
            { data: 'dept_course' },
            { data: 'age', className: 'text-center small' },
            { data: 'academic' },
            { data: 'status' },
            { data: 'change' },
            { data: 'actions', className: 'text-nowrap no-sort' },
        ],
        language: {
            search: '',
            searchPlaceholder: 'Search inquiries...',
            processing: '<div class="text-center py-3"><i class="fa-solid fa-spinner fa-spin me-2"></i>Loading...</div>',
            emptyTable: 'No inquiries found',
            zeroRecords: 'No matching inquiries'
        }
    });
}

function switchTab(el, tab) {
    document.querySelectorAll('#inquiryTabs .nav-link').forEach(b => b.classList.remove('active'));
    el.classList.add('active');
    currentTab = tab;
    initTable(tab);
}

$(document).ready(function () {
    initTable('active');
});

function openEditModal(id) {
    $.get('{{ url("admin/inquiry") }}/' + id + '/edit', function(html) {
        $('#editModalContainer').html(html);
        $('#editInquiryModal').modal('show');
    }).fail(function() {
        alert('Could not load inquiry. Please try again.');
    });
}
</script>
@endpush
