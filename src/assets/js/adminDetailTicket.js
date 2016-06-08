$('#backToOpenedTicket').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'adminOpenedTicket',
        dataType: 'HTML',
        success: function(data) {
            $('#OpenTicket').html(data);
        }
    })
});

$('#backToClosedTicket').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'adminClosedTicket',
        dataType: 'HTML',
        success: function(data) {
            $('#CloseTicket').html(data);
        }
    })
});

$('#refreshTicketDetail').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'ticketDetail',
        dataType: 'html',
        data: {ticket_id :$(this).data('id')},
        success: function(data) {
            $('#refreshTicketDetail').parents("div[role='tabpanel']").html(data);
        }
    })
});

$('#newMessageForm').on('submit', function() {
    $.ajax({
        method: "post",
        url : "addMessage",
        dataType: 'json',
        data: $(this).serialize(),
        success: function(data) {
            $('#OpenTicket').html(data);
        },
        error: function() {
            $('#messageModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('#refreshTicketDetail').trigger('click');
        }
    });
    return false;
});
$('#confirmClosingTicket').on('click', function(){
    $.ajax({
        method: 'post',
        url: 'closeTicket',
        dataType: 'html',
        data: {ticket_id: $(this).data('id')},
        success: function(data) {
            $('#closeTicketModal').modal('hide');
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
            $('#backToOpenedTicket').trigger('click');
        }
    })
});

$('#backToProgressTicket').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'adminProgressTicket',
        dataType: 'html',
        success: function(data) {
            $('#ActiveTicket').html(data);
        },
        error : function(data){
            $('#ActiveTicket').html(data);
        }
    })
});

$('#backToTicketByAdmin').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'ticketsByAdmin',
        dataType: 'html',
        data: {last: 'yours'},
        success: function(data) {
            $('#YoursTickets').html(data);
        },
        error: function(data) {
            $('#YoursTickets').html(data);
        }
    })
});