<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class AddAdminOnTicket implements ControllerInterface
{

    private $status;

    public function getResponse()
    {
        if ( isset($_POST['ticket_id']) && isset($_POST['admin_id'])) {
            $ticket = \TicketsQuery::create()->findByTicketId($_POST['ticket_id'])[0];
            $ticket->setTicketAdminId($_POST['admin_id']);
            $ticket->save();
            $this->status = New \Status();
            $this->status->setStatusDate(date("Y-m-d H:i:s"));
            $this->status->setStatusType('progress');
            $this->status->setStatusTicketId($ticket->getPrimaryKey());
            $this->status->save();
            return 'ok';
        } else {
            return [
                'redirect_to' => 'admin'
            ];
        }
        // TODO: Implement getResponse() method.
    }
}