$('#user_tab li .user_ticket_action').click(function (e) {
    e.preventDefault()
    $(this).tab('show')
});

$('#CreateTicket').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'createTicket',
        dataType: 'HTML',
        success: function(data) {
            $('#newTicket').html(data);
        }
    })
});

$.ajax({
    method: 'post',
    url: 'openedTicket',
    dataType: 'HTML',
    success: function(data) {
        $('#OpenTicket').html(data);
    }
});

$('#closedTicket').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'closedTicket',
        dataType: 'HTML',
        success: function(data) {
            $('#ClosedTicket').html(data);
        },
        error: function(data) {
            $('#ClosedTicket').html(data);
        }
    });
});

$('#ticketInProgress').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'progressTicket',
        dataType: 'html',
        success: function(data) {
            $('#ActiveTicket').html(data);
        },
        error : function(data){

        }
    })
});