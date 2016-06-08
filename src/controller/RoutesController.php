<?php

namespace Controller;

use Controller\Messages\CreateMessageController;
use Controller\Tickets\AddAdminOnTicket;
use Controller\Tickets\AdminClosedTicketController;
use Controller\Tickets\AdminOpenedTicketController;
use Controller\Tickets\AdminProgressController;
use Controller\Tickets\ClosedTicketController;
use Controller\Tickets\CloseTicketController;
use Controller\Tickets\CreateTicketController;
use Controller\Tickets\OpenedTicketController;
use Controller\Tickets\ProgressTicketController;
use Controller\Tickets\TicketByAdminController;
use Controller\Tickets\TicketCreationController;
use Controller\Tickets\TicketDetailController;
use Controller\Users\AdminController;
use Controller\Users\InscriptionController;
use Controller\Users\LoginController;
use Controller\Users\LogoutController;
use Controller\Users\UserController;

class RoutesController
{
    public function getController($routes)
    {
        switch ($routes) {
            case '/user':
                $controller = new UserController();
                return ['controller' => $controller->getResponse(), 'index' => 'user'];
            case '/':
                $controller = new HomeController();
                return ['controller' => $controller->getResponse(), 'index' => 'home'];
            case '/login':
                $controller = new LoginController();
                return ['controller' => $controller->getResponse(), 'index' => 'login'];
            case '/inscription':
                $controller = new InscriptionController();
                return ['controller' => $controller->getResponse(), 'index' => 'inscription'];
            case '/logout':
                $controller = new LogoutController();
                return ['controller' => $controller->getResponse(), 'index' => 'logout'];
            case '/admin':
                $controller = new AdminController();
                return ['controller' => $controller->getResponse(), 'index' => 'admin'];
            case '/createTicket':
                $controller = new CreateTicketController();
                return ['controller' => $controller->getResponse(), 'index' => 'createTicket'];
            case '/ticketCreation':
                $controller = new TicketCreationController();
                return ['controller' => $controller->getResponse(), 'index' => 'ticketCreation'];
            case '/openedTicket':
                $controller = new OpenedTicketController();
                return ['controller' => $controller->getResponse(), 'index' => 'openedTicket'];
            case '/ticketDetail':
                $controller = new TicketDetailController();
                return ['controller' => $controller->getResponse(), 'index' => 'ticketDetail'];
            case '/addMessage':
                $controller = new CreateMessageController();
                return ['controller' => $controller->getResponse(), 'index' => 'createMessage'];
            case '/closedTicket':
                $controller = new ClosedTicketController();
                return ['controller' => $controller->getResponse(), 'index' => 'closedTicket'];
            case '/closeTicket':
                $controller = new CloseTicketController();
                return ['controller' => $controller->getResponse(), 'index' => "closeTicket"];
            case '/adminOpenedTicket':
                $controller = new AdminOpenedTicketController();
                return ['controller' => $controller->getResponse(), 'index' => 'AdminOpenedTicket'];
            case '/addAdminToTicket' :
                $controller = new AddAdminOnTicket();
                return ['controller' => $controller->getResponse(), 'index' => 'AddAdminOnTicket'];
            case '/progressTicket':
                $controller = new ProgressTicketController();
                return ['controller' => $controller->getResponse(), 'index' => 'progressTicket'];
            case '/adminProgressTicket':
                $controller = new AdminProgressController();
                return ['controller' => $controller->getResponse(), 'index' => 'AdminProgressTicket'];
            case '/adminClosedTicket':
                $controller = new AdminClosedTicketController();
                return ['controller' => $controller->getResponse(), 'index' => 'AdminClosedTicket'];
            case '/ticketsByAdmin' :
                $controller = new TicketByAdminController();
                return ['controller' => $controller->getResponse(), 'index' => 'ticketByAdmin'];
            default:
                $controller = new HomeController();
                return ['controller' => $controller->getResponse(), 'index' => 'home'];
                break;
        }
    }
}