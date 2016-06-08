$('#openedTicket table tr').on('click', function() {
   if ($(this).data('id')) {
      $.ajax({
         method: 'post',
         url: 'ticketDetail',
         dataType: 'html',
         data: {ticket_id :$(this).data('id')},
         success: function(data) {
            $('#OpenTicket').html(data);
         }
      })
   }
});
