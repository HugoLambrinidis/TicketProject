<?php

namespace Controller\Messages;

use Controller\ControllerInterface;

class CreateMessageController implements ControllerInterface
{

    private $message_entitie;

    public function getResponse()
    {
        $this->message_entitie = new \Messages();
        if (!isset($_POST['message_text']) || count($_POST["message_text"]) < 2) {
            $response = [ "error" => "Message inexistant ou trop cours"];
        }
        if (isset($_POST['message_text']) && isset($_SESSION['user']) && isset($_POST['message_ticket_id']) ) {
            $this->message_entitie->setMessageTicketId($_POST['message_ticket_id']);
            $this->message_entitie->setMessageUserId($_SESSION['user']['id']);
            $this->message_entitie->setMessageText($_POST['message_text']);
            $this->message_entitie->setMessageDate(date("Y-m-d H:i:s"));
            $this->message_entitie->save();
            $response = ["success" => "message enregistré"];
        }

        return [
            "createMessage" => json_encode($response),
            "view" => "tickets/ticketDetail.twig"
        ];
    }

}