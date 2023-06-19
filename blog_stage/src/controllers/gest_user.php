<?php

namespace Application\Controllers\GestUser;

require_once('src/lib/database.php');
require_once('src/model/login.php');

use Application\Model\Login\UserRepository;
use Application\Lib\Database\DatabaseConnection;


class GestUser
{
    public function execute()
    {
        $connection = new DatabaseConnection();

        $postRepository = new UserRepository();
        $postRepository->connection = $connection;
        $users = $postRepository->getLoginUser();

        require('templates/gest_user.php');
    }

}
