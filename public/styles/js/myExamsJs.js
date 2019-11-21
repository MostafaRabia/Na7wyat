$(document).ready(function(){
    $('#example').DataTable({
    	rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        "lengthChange": false,
        "pageLength": 10
    });

    $('.button').on('click',function(){
        $.ajax({
            url: $(this).attr('url'),
            type: "post",
        });
    });
});