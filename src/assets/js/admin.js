$('#AdminOpenedTicket').on('click', function() {
    $.ajax({
        url: 'adminOpenedTicket',
        method: 'post',
        dataType: "html",
        success: function(data) {
            $('#OpenTicket').html(data);
        },
        error: function(data) {
            $('#OpenTicket').html(data);
        }
    })
});

$.ajax({
    method: 'post',
    url: 'adminProgressTicket',
    dataType: 'HTML',
    success: function(data) {
        $('#ActiveTicket').html(data);
    }
});

$('#adminProgressTicket').on('click', function(){
    $.ajax({
        method: 'post',
        url: 'adminProgressTicket',
        dataType: 'HTML',
        success: function(data) {
            $('#ActiveTicket').html(data);
        }
    });
});

$('#adminClosedTicket').on('click', function() {
    $.ajax({
        method: 'post',
        url: 'adminClosedTicket',
        dataType: 'html',
        success: function(data) {
            $('#CloseTicket').html(data);
        },
        error: function(data) {
            $('#CloseTicket').html(data);
        }
    })
});

$('#ticketByAdmin').on('click', function() {
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