$('#ticketByAdmin table tr').on('click', function() {
    if ($(this).data('id')) {
        $.ajax({
            method: 'post',
            url: 'ticketDetail',
            dataType: 'html',
            data: {
                    ticket_id :$(this).data('id'),
                    last: 'yours'
            },
            success: function(data) {
                $('#YoursTickets').html(data);
            },
            error : function(data) {
                $('#YoursTickets').html(data);
            }
        })
    }
});