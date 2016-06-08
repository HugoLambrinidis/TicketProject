<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class TicketDetailController implements ControllerInterface
{

    public function getResponse()
    {
        // TODO: Implement getResponse() method.
        if (isset($_SESSION['user'])) {
            $ticket_id = $_POST['ticket_id'];
            $tickets = \TicketsQuery::create()->findByTicketId($ticket_id);
            $ticket = $tickets[0];
            $messages = \MessagesQuery::create()
                ->filterByMessageTicketId($ticket->getPrimaryKey())
                ->orderByMessageDate()
                ->find();
            $status = \StatusQuery::create()
                ->filterByStatusTicketId($ticket->getPrimaryKey())
                ->orderByStatusDate()
                ->find();
            $response = [];
            foreach ($status as $statu) {
                $response['element'][] = [
                    "type" => "status",
                    "date" => $statu->getStatusDate("Y-m-d H:i:s"),
                    "status_id" => $statu->getPrimaryKey(),
                    "status_type" => $statu->getStatusType()
                ];
            }
            var_dump($statu->getStatusDate()->get);
            foreach ($messages as $message) {
                $response['element'][] = [
                    "type" => "message",
                    "date" => $message->getMessageDate("Y-m-d H:i:s"),
                    "message_id" => $message->getPrimaryKey(),
                    "message_text" => $message->getMessageText()
                ];
            }
            usort($response['element'], function($a, $b) {
                return \DateTime::createFromFormat('Y-m-d H:i:s',$a['date'])->getTimestamp() -
                            \DateTime::createFromFormat('Y-m-d H:i:s',$b['date'])->getTimestamp();
            });
            if ($response['element'][0]['type'] == "message") {
                $temp = $response['element'][0];
                $response['element'][0] = $response['element'][1];
                $response['element'][1] = $temp;
            }
            $response['current_status'] = $status[sizeof($status) - 1]->getStatusType();
            $response["ticket"] = [
            "ticket_id" => $ticket->getTicketId(),
            "ticket_titre" => $ticket->getTicketTitre(),
            "ticket_date" => $ticket->getTicketDate("Y-m-d H:i:s")
            ];
            if ( $ticket->getTicketAdminId()!==null) {
                $response["ticket"]["ticket_admin_id"] = $ticket->getTicketAdminId();
                $response['ticket']['ticket_admin_username'] = \UsersQuery::create()->findByUserId($ticket->getTicketAdminId())[0]->getUserUsername();
            }
            $user = \UsersQuery::create()->findByUserId($ticket->getTicketUserId())[0];
            $response['ticket']['user_id'] = $user->getPrimaryKey();
            $response['ticket']['user_username'] = $user->getUserUsername();
            if ($_SESSION['user']['user_type'] == "user") {
                return [
                    "view" => "tickets/ticketDetail.twig",
                    "ticketDetail" => $response
                ];
            } else
                if (isset($_POST['last'])) $response['last'] = $_POST['last'];
                return [
                'view' => 'tickets/adminTicketDetail.twig',
                'ticketDetail' => $response
            ];
        } else {
        return [
        'redirect_to' => "home"
        ];
       }
    }
}