<?php

namespace Controller\Users;

use Controller;
use TicketsQuery;
use StatusQuery;
use MessagesQuery;

class UserController implements Controller\ControllerInterface
{

    public function getResponse()
    {
        if (!isset($_SESSION['user'])) {
            return [
                'redirect_to' => "home"
            ];
        }
        if ($_SESSION['user']['user_type'] == "admin") {
            return [
                'redirect_to' => "admin"
            ];
        }

        return [
            'user' => $_SESSION['user'],
            'view' => 'users/user.twig'
        ];
    }
}