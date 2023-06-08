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
    public string $adresse;
    public string $ville;
    public string $code_postal;
    public string $metier;
    public string $tel;
    public string $mail;
    public string $insta;
    public string $facebook;
    public string $twitter;
}

class UserRepository
{
    public DatabaseConnection $connection;

    // Verification de la correspondance username / password

    public function login($username, $password)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT id, username, password, name, firstname, role, adresse, ville, code_postal, metier, tel, mail, insta, facebook, twitter from login where username=? AND password=?'
        );
        $statement->execute([$username, $password]);
        $login = $statement->fetch();
        return $login;
    }

    // Cherche un utilisateur suivant son id 

    public function getLoginWithId($id)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT name, firstname, adresse, ville, code_postal, metier, tel, mail, insta, facebook, twitter FROM logins WHERE id=?'
        );
        $statement->execute([$id]);
        $loginWithId = $statement->fetch();
        return $loginWithId;
    }

    //Obtenir tous les utilisateurs dans un tableau

    public function getLoginUser(): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, username, password, name, firstname, role, adresse, ville, code_postal, metier, tel, mail, insta, facebook, twitter FROM logins ORDER BY role DESC"
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
            $login->adresse = $row['adresse'];
            $login->ville = $row['ville'];
            $login->code_postal = $row['code_postal'];
            $login->metier = $row['metier'];
            $login->tel = $row['tel'];
            $login->mail = $row['mail'];
            $login->insta = $row['insta'];
            $login->facebook = $row['facebook'];
            $login->twitter = $row['twitter'];


            $logins[] = $login;
        }

        return $logins;
    }

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
            $login->adresse = $row['adresse'];
            $login->ville = $row['ville'];
            $login->code_postal = $row['code_postal'];
            $login->metier = $row['metier'];
            $login->tel = $row['tel'];
            $login->mail = $row['mail'];
            $login->insta = $row['insta'];
            $login->facebook = $row['facebook'];
            $login->twitter = $row['twitter'];


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
