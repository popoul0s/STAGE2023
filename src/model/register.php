<?php

namespace Application\Model\Register;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class RegisterInfo
{
    public string $id_user;
    public string $username;
    public string $password;
    public string $name;
    public string $firstname;
}

class RegisterRepository
{
    public DatabaseConnection $connection;

    // Créer un utilisateur

    public function register(string $username, string $password, string $name, string $firstname)
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO logins(username, password, name, firstname) VALUES(?, ?, ?, ?)'
        );
        $affectedLines = $statement->execute([$username, $password, $name, $firstname]);

        return ($affectedLines > 0);
    }
}
