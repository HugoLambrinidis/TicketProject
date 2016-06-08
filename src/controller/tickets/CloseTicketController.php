<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class CloseTicketController implements ControllerInterface
{
    private $status_entitie;

    public function getResponse()
    {
        $this->status_entitie = new \Status();

        if (isset($_POST['ticket_id'])&& isset($_SESSION['user']) ) {
            $this->status_entitie->setStatusType("closed");
            $this->status_entitie->setStatusTicketId($_POST['ticket_id']);
            $this->status_entitie->setStatusDate(date("Y-m-d H:i:s"));
            $this->status_entitie->save();

            return [
                "redirect_to" => "user"
            ];
        }
    }

}