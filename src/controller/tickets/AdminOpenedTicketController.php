<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class AdminOpenedTicketController implements ControllerInterface
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
            if ($status[sizeof($status) - 1]->getStatusType() != "ouvert") {
                unset($response['element'][$key]);
            }
        }
        if (sizeof($response['element']) == 0) {
            $response['error'] = 'No Ticket Opened Yet !';
        } else {
            $admins = \UsersQuery::create()->findByUserUserType(2);
            foreach ($admins as $key => $admin) {
                $response['admin'][$key] = [
                    'admin_id' => $admin->getPrimaryKey(),
                    'admin_username' => $admin->getUserUsername()
                ];
            }
        }
        return ['view' => "tickets/adminOpenedTicket.twig",
                'AdminOpenedTicket' => $response
        ];
    }
}