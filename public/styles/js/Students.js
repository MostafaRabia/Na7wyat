$(document).ready(function(){
    $('#example').DataTable({
      rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true,
        "lengthChange": false,
        "pageLength": 10,
        columnDefs: [
       		{type: 'num-html', targets: 1}
    	]
    });

    $('.repeat').on('click',function(){
        var element = $(this);
        var count = parseInt($('.count').text());
        $.ajax({
            url: $(this).attr('href'),
            type: 'post',
            data: {_token:$(this).attr('token')},
            error: function(){
                Materialize.toast('فشل..', 2000);
            },
            success: function(){
                element.parent().parent().hide();
                if (isNaN(count)){
                    $('.count').text(1);  
                  }else{
                    $('.count').text(count-1);
                  }
                Materialize.toast('تم بنجاح.', 2000);
            }
        });
        return false;
    });
});