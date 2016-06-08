<?php

namespace Controller;

class HomeController implements ControllerInterface
{

    public function getResponse()
    {
        if (isset($_SESSION['user'])) {
            switch ($_SESSION['user']['user_type']) {
                case 'user' :
                    return [
                        'redirect_to' => 'user'
                    ];
                    break;
                case 'admin' :
                    return [
                        'redirect_to' => 'user'
                    ];
                    break;
            }
        }
        return [
            'home' => '',
            'view' => 'home.twig'
        ];
    }

}