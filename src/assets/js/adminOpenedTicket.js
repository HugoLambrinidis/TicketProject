$('#admin').on('change', function() {
   $.ajax({
       method: 'post',
       url: 'addAdminToTicket',
       dataType: 'json',
       data: {
           ticket_id: $(this).parent().parent().data('id'),
           admin_id: $(this).val()
       },
       success: function(data) {
           location.reload();
       },
       error: function(data) {
           location.reload();
       }
   })
});

$('#AdminOpenedTicket table tr').on('click', function() {
    if ($(this).data('id')) {
        $.ajax({
            method: 'post',
            url: 'ticketDetail',
            dataType: 'html',
            data: {ticket_id :$(this).data('id'),
                    last_page: "opened"},
            success: function(data) {
                $('#OpenTicket').html(data);
            },
            error : function(data) {
                $('#OpenTicket').html(data);
            }
        })
    }
});