<?php

namespace Application\Controllers\Login;

require_once('src/lib/database.php');
require_once('src/model/login.php');

use Application\Model\Login\UserRepository;
use Application\Lib\Database\DatabaseConnection;


class Login
{
    public function execute()
    {
        require('./templates/login.php');
    }

    public function login($username, $password)
    {
        if ($username != '' && $password != '') {
            $connection = new DatabaseConnection();

            $userRepository = new UserRepository();
            $userRepository->connection = $connection;
            $login = $userRepository->login($username, $password);
            if (!empty($login)) {
                $_SESSION['login'] = true;
                $_SESSION['role'] = $login['role'];
                $_SESSION['name'] = $login['name'];
                $_SESSION['firstname'] = $login['firstname'];
                $_SESSION['id_user_verif'] = $login['id'];
                header('Location: index.php');
            } else {
                $_SESSION['login'] = false;
                header('Location: index.php');
            }
        } else {
            require('./templates/error.php');
        }
    }
    public function executeSeeProfile()
    {
        require('./templates/profile.php');
    }
}
