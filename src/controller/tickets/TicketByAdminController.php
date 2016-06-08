<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class TicketByAdminController implements ControllerInterface
{
    public function getResponse()
    {
        // TODO: Implement getResponse() method.
        $tickets = \TicketsQuery::create()->find();
        foreach ( $tickets as $key => $ticket) {
            $response['element'][$key]['ticket'] = [
                'ticket_id' => $ticket->getPrimaryKey(),
                'ticket_date' => $ticket->getTicketDate("Y-m-d H:i:s"),
                'ticket_titre' => $ticket->getTicketTitre()
            ];
            $user = \UsersQuery::create()->findByUserId($ticket->getTicketUserId());
            $response['element'][$key]['user'] = [
                'user_id' => $user[0]->getPrimaryKey(),
                'user_username' => $user[0]->getUserUsername()
            ];
            $status = \StatusQuery::create()->findByStatusTicketId($ticket->getPrimaryKey());
            $response['element'][$key]['current_status'] = $status[sizeof($status) - 1]->getStatusType();
        }
        if (sizeof($response['element']) == 0) {
            $response['error'] = 'No Ticket Opened Yet !';
        }
        return ['view' => "tickets/ticketsByAdmin.twig",
            'ticketByAdmin' => $response
        ];
    }
}

