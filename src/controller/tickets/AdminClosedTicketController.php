<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class AdminClosedTicketController implements ControllerInterface
{
    public function getResponse()
    {
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
            if ($status[sizeof($status) - 1]->getStatusType() != "closed") {
                unset($response['element'][$key]);
            } else {
                if ($ticket->getTicketAdminId() !== null ) {
                    $admin = \UsersQuery::create()->findByUserId($ticket->getTicketAdminId());
                    $response['element'][$key]['admin'] = [
                        'admin_id' => $admin[0]->getPrimaryKey(),
                        'admin_username' => $admin[0]->getUserUsername()
                    ];
                }
            }
        }
        if (sizeof($response['element']) == 0) {
            $response['error'] = 'No Ticket Opened Yet !';
        }
        return ['view' => "tickets/adminClosedTicket.twig",
            'AdminClosedTicket' => $response
        ];
    }

}