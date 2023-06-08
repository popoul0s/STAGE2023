<?php

namespace Application\Model\Login;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class LoginInfo
{
    public string $id_user;
    public string $username;
    public string $password;
    public string $name;
    public string $firstname;
    public string $role;
    public string $info;
}

class UserRepository
{
    public DatabaseConnection $connection;

    // Verification de la correspondance username / password

    public function login($username, $password)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT id, username, password, name, firstname, role, info_plus from logins where username=? AND password=?'
        );
        $statement->execute([$username, $password]);
        $login = $statement->fetch();
        return $login;
    }

    // Cherche un utilisateur suivant son id 

    public function getLoginWithId($id)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT name, firstname FROM logins WHERE id=?'
        );
        $statement->execute([$id]);
        $loginWithId = $statement->fetch();
        return $loginWithId;
    }

    //Obtenir tous les utilisateurs dans un tableau

    public function getLoginUser(): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, password, name, firstname, role, info_plus FROM logins ORDER BY role DESC"
        );
        $statement->execute();

        $login = [];
        while (($row = $statement->fetch())) {
            $login = new LoginInfo();
            $login->id_user = $row['id'];
            $login->username = $row['username'];
            $login->password = $row['password'];
            $login->name = $row['name'];
            $login->firstname = $row['firstname'];
            $login->role = $row['role'];
            $login->info = $row['info_plus'];


            $logins[] = $login;
        }

        return $logins;
    }
    /*
// User possédant le role admin

    public function getLoginAdmin(): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, password, name, firstname, role FROM logins WHERE role='admin'"
        );
        $statement->execute();

        $login = [];
        while (($row = $statement->fetch())) {
            $login = new LoginInfo();
            $login->id_user = $row['id'];
            $login->username = $row['username'];
            $login->password = $row['password'];
            $login->name = $row['name'];
            $login->firstname = $row['firstname'];
            $login->role = $row['role'];


            $logins[] = $login;
        }

        return $logins;
    }
*/

    public function getLoginUserById($id, $role): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, password, name, firstname, role, info_plus FROM logins WHERE id=? AND role=?"
        );
        $statement->execute([$id, $role]);

        $login = [];
        while (($row = $statement->fetch())) {
            $login = new LoginInfo();
            $login->id_user = $row['id'];
            $login->username = $row['username'];
            $login->password = $row['password'];
            $login->name = $row['name'];
            $login->firstname = $row['firstname'];
            $login->role = $row['role'];
            $login->info = $row['info_plus'];


            $logins[] = $login;
        }

        return $logins;
    }

    // Mettre à jour un utilisateur

    public function editUser(int $id, string $username, string $password, string $name, string $firstname, string $role): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE logins SET username=?, password=?, name=?, firstname=?, role=?  WHERE id=?'
        );
        $affectedLines = $statement->execute(["$username", "$password", "$name", "$firstname", "$role", $id]);

        return ($affectedLines > 0);
    }
    public function delUser(string $id): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM logins WHERE id=?'
        );
        $affectedLines = $statement->execute([$id]);

        return ($affectedLines > 0);
    }
}
