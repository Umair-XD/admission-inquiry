// new DataTable('#example');
$(document).ready(function() {
    var table = $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print',
        ]
        
    });
    $('.dt-buttons').addClass('float-end');
});
