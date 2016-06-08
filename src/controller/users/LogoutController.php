<?php

namespace Controller\Users;

use Controller;

class LogoutController implements Controller\ControllerInterface
{
    public function getResponse() {
        session_destroy();
        return [
            'redirect_to' => 'home'
        ];
    }
}