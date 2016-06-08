<?php

namespace Controller\Users;

use Base\UsersQuery;
use Controller;

class InscriptionController implements Controller\ControllerInterface
{

    private $user_entitie;
    private $valid = true;

    public function getResponse()
    {
        if($user = UsersQuery::create()->findOneByUserUsername($_POST['Username'])) {
            return [
                'view' => 'home.twig',
                'inscription' => [
                    'user_exist' => 'user already exist'
                ]
            ];
        }
        if (strlen($_POST['Name']) < 3) {
            $response['inscription']['nameError'] = 'too short';
            $this->valid = false;

        }
        if (strlen($_POST['Lastname']) < 3) {
            $response['inscription']['lastnameError'] = 'too short';
            $this->valid = false;

        }
        if (strlen($_POST['Username']) < 3) {
            $response['inscription']['usernameError'] = 'too short';
            $this->valid = false;

        }
        if (strlen($_POST['Password']) < 3) {
            $response['inscription']['passwordError'] = 'too short';
            $this->valid = false;
        }

        if ($this->valid) {
            $this->user_entitie = new \Users();
            $this->user_entitie->setUserName($_POST['Name']);
            $this->user_entitie->setUserLastname($_POST['Lastname']);
            $this->user_entitie->setUserUsername($_POST['Username']);
            $this->user_entitie->setPassword($_POST['Password']);
            $this->user_entitie->setUserUserType($_POST['UserType']);
            $this->user_entitie->save();
            $user = UsersQuery::create()->findOneByUserUsername($_POST['Username']);
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
            }
        }
        $response['view'] = 'home.twig';
        return $response;
    }
}