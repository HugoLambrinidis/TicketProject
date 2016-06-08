<?php

namespace Controller\Tickets;


use Controller\ControllerInterface;

class TicketCreationController implements  ControllerInterface
{
    private $ticket_entitie;
    private $message_entitie;
    private $status_entitie;

    public function getResponse()
    {

        $this->ticket_entitie = new \Tickets();
        $this->ticket_entitie->setTicketTitre($_POST['ticketTitle']);
        $this->ticket_entitie->setTicketUserId($_SESSION['user']['id']);
        $this->ticket_entitie->setTicketDate(date("Y-m-d H:i:s"));
        $this->ticket_entitie->save();

        $this->message_entitie = new \Messages();
        $this->message_entitie->setMessageDate(date("Y-m-d H:i:s"));
        $this->message_entitie->setMessageText($_POST['ticketMessage']);
        $this->message_entitie->setMessageUserId($_SESSION['user']['id']);
        $this->message_entitie->setMessageTicketId($this->ticket_entitie->getTicketId());
        $this->message_entitie->save();

        $this->status_entitie = new \Status();
        $this->status_entitie->setStatusDate(date("Y-m-d H:i:s"));
        $this->status_entitie->setStatusType('ouvert');
        $this->status_entitie->setStatusTicketId($this->ticket_entitie->getTicketId());
        $this->status_entitie->save();

        return [
            'redirect_to' => 'user'
        ];
    }
}