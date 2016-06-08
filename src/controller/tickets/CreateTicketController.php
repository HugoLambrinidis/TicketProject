<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class CreateTicketController implements ControllerInterface
{
    public function getResponse()
    {
        if ($_SESSION['user']) {
            return [
                'createTicket' => $_SESSION['user'],
                'view' => 'tickets/createTicket.twig'
            ];
        }
    }
}