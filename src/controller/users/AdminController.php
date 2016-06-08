<?php

namespace Controller\Users;

use Controller;

class AdminController implements Controller\ControllerInterface
{
    public function getResponse()
    {

        if (!isset($_SESSION['user'])) {
            return [
                'redirect_to' => "home"
            ];
        }

        if ($_SESSION['user']['user_type'] == "user") {
            return [
                'redirect_to' => "user"
            ];
        }

        return [
            'admin' => $_SESSION['user'],
            'view' => 'users/admin.twig'
        ];
    }
}