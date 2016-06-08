<?php

namespace Controller\Tickets;

use Controller\ControllerInterface;

class OpenedTicketController implements ControllerInterface
{

    public function getResponse()
    {
        if ($tickets = \TicketsQuery::create()->findByTicketUserId($_SESSION['user']['id'])) {
            if (sizeof($tickets) > 0) {
                $response = [];
                foreach ($tickets as $key => $ticket) {
                    $response[$key]['ticket']['ticketTitle'] = $ticket->getTicketTitre();
                    $response[$key]['ticket']['ticketId'] = $ticket->getTicketId();
                    $response[$key]['ticket']['ticketDate'] = date_format($ticket->getTicketDate(), 'Y-m-d H:i:s');
                    $messages = \MessagesQuery::create()->findByMessageTicketId($ticket->getTicketId());
                    foreach ($messages as $i => $message) {
                        $response[$key]['message'][$i] = [$message->getMessageId()];
                        $response[$key]['message'][$i] = [$message->getMessageText()];
                    }
                    $status = \StatusQuery::create()->findByStatusTicketId($ticket->getTicketId());
                    foreach ($status as $j => $statu) {
                        $response[$key]['statu'][$j]['id'] = $statu->getStatusId();
                        $response[$key]['statu'][$j]['status'] = $statu->getStatusType();
                        if ($response[$key]['statu'][$j]['status'] != "ouvert" ) {
                            unset($response[$key]);
                        }
                    }
                }
                if (sizeof($response) == 0) {
                    $response = ["error" => "no ticket opened yet"];
                }
            } else {
                $response = ["error" => "no ticket opened yet !"];
            }
            return [
                'openedTicket' => $response,
                'view' => 'tickets/openedTicket.twig'
            ];
        } else {
            return [
                'openedTicket' => 'no ticket opened yet',
                'view' => 'tickets/openedTicket.twig'
            ];
        }
    }
}