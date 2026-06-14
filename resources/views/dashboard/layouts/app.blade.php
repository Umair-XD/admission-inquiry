<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') :: NFC Institute</title>
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}">
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css">

    <style>
        body { background: #f0f2f5; }

        /* ── CARDS ── */
        .card { border: none; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        .card-header { background: #fff; border-bottom: 1px solid #f0f2f5; font-weight: 600; border-radius: 10px 10px 0 0 !important; }

        /* ── SWEETALERT TOASTS ── */
        .colored-toast.swal2-icon-success { background-color: #28c76f !important; }
        .colored-toast.swal2-icon-error   { background-color: #d34c4d !important; }
        .colored-toast.swal2-icon-warning { background-color: #e68f3c !important; }
        .colored-toast.swal2-icon-info    { background-color: #00bad1 !important; }
        .colored-toast .swal2-title       { color: #fff !important; }
        .colored-toast .swal2-close       { color: #fff !important; }
        .colored-toast .swal2-html-container { color: #fff !important; }
    </style>

    @stack('styles')
</head>

<body>
<div class="d-flex flex-column min-vh-100">

@include('dashboard.includes.header')

<main class="flex-grow-1 p-3 p-md-4">
    @yield('content')
</main>

@include('dashboard.includes.footer')

</div>

<!-- Bootstrap -->
<script src="{{ asset('dashboard/js/bootstrap.bundle.min.js') }}"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Custom -->
<script src="{{ asset('dashboard/js/custom.js') }}"></script>

<script>
// ── Select2 init ──
$(document).ready(function () {
    $('select.select2').select2({ theme: 'bootstrap-5', width: '100%' });
    $(document).on('shown.bs.modal', function (e) {
        $(e.target).find('select.select2').select2({
            theme: 'bootstrap-5', width: '100%', dropdownParent: $(e.target)
        });
    });
});

// ── SweetAlert toast helper ──
function showAlert(message, icon) {
    Swal.mixin({
        toast: true,
        position: 'top-right',
        iconColor: 'white',
        customClass: { popup: 'colored-toast' },
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: function (toast) {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    }).fire({ icon: icon, title: message });
}

// ── Delete confirmation ──
function confirmDelete(formEl, message) {
    Swal.fire({
        title: 'Are you sure?',
        text: message || 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d34c4d',
        cancelButtonColor: '#6c757d',
        confirmButtonText: '<i class="fa-solid fa-trash me-1"></i> Delete',
        cancelButtonText: 'Cancel',
        focusCancel: true,
        reverseButtons: true
    }).then(function (result) {
        if (result.isConfirmed) { formEl.submit(); }
    });
}

// ── Flash session toasts ──
@if(session('success'))
document.addEventListener('DOMContentLoaded', function () {
    showAlert('{{ addslashes(session('success')) }}', 'success');
});
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function () {
    showAlert('{{ addslashes(session('error')) }}', 'error');
});
@endif
</script>

@stack('scripts')
</body>
</html>
