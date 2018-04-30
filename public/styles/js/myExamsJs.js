$(document).ready(function(){
    $('#example').DataTable({
    	rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        "lengthChange": false,
        "pageLength": 10
    });
});