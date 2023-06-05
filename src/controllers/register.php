<?php

namespace Application\Controllers\Register;

require_once('src/lib/database.php');
require_once('src/model/register.php');

use Application\Model\Register\RegisterRepository;
use Application\Lib\Database\DatabaseConnection;

class Register
{
    public function execute()
    {
        require('./templates/register.php');
    }

    public function register($username, $password, $name, $firstname)
    {
        if ($username != '' && $password != '') {
            $connection = new DatabaseConnection();

            $userRepository = new RegisterRepository();
            $userRepository->connection = $connection;
            $post = $userRepository->register($username, $password, $name, $firstname);

            header('Location: index.php');
        } else {
            require('./templates/error.php');
        }
    }
}
