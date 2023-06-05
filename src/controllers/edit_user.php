<?php

namespace Application\Controllers\EditUser;

require_once('src/lib/database.php');
require_once('src/model/login.php');

use Application\Model\Login\UserRepository;
use Application\Lib\Database\DatabaseConnection;

class EditUser
{
    public function execute(array $input)
    {
        if (!empty($input['id']) && !empty($input['username']) && !empty($input['password']) && !empty($input['name']) && !empty($input['firstname']) && !empty($input['role'])) {
            $connection = new DatabaseConnection();

            $postRepository = new UserRepository();
            $postRepository->connection = $connection;
            $success = $postRepository->editUser($input['id'], $input['username'], $input['password'], $input['name'], $input['firstname'], $input['role']);
            if (!$success) {
                throw new \Exception("Impossible de modifier l'utilisateur !");
            } else {
                header('Location: index.php?action=gest_user');
            }
        } else {
            require('./templates/error.php');
        }
    }

    public function edituser_redirection()
    {
        $connection = new DatabaseConnection();

        $postRepository = new UserRepository();
        $postRepository->connection = $connection;
        $users = $postRepository->getLoginUserById($_GET['id'], $_GET['role']);

        require('templates/edit_user.php');
    }
}
