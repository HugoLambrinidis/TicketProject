<?php

namespace Controller\Users;

use Controller;
use Base\UsersQuery;

class LoginController implements Controller\ControllerInterface
{

    public function getResponse()
    {
        echo "toto";
        if ($user = UsersQuery::create()->findOneByUserUsername($_POST['Username'])) {
            if ($user->getPassword() == $_POST['Password']) {
                $_SESSION['user'] = [
                    'id' => $user->getPrimaryKey(),
                    'name' => $user->getUserName(),
                    'lastname' => $user->getUserLastname(),
                    'username' => $user->getUserUsername()
                ];
                switch ($user->getUserUserType()) {
                    case 1 :
                        $_SESSION['user']['user_type'] = "user";
                        return [
                            'redirect_to' => 'user'
                        ];
                        break;
                    case 2 :
                        $_SESSION['user']['user_type'] = "admin";
                        return [
                            'redirect_to' => 'admin'
                        ];
                        break;
                    default:
                        $_SESSION['user']['user_type'] = "user";
                        return [
                            'redirect_to' => 'user'
                        ];
                        break;
             }

            } else {
                return [
                    'login' => 'wrong username/password',
                    'view' => 'home.twig'
                ];
            }
        } else {
            return [
                'login' => 'wrong username/password',
                'view' => 'home.twig'
            ];
        }
    }
}