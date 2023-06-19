<?php

namespace Application\Model\Profile;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class ProfileInfo
{
    public string $id_user;
    public string $tel;
    public string $ville;
    public string $code_postal;
    public string $adresse;
    public string $mail;
    public string $bio;
    public string $instagram;
}

class ProfileRepository
{
    public DatabaseConnection $connection;

    // Créer un profil

    public function profile($id_user, $tel, $ville, $code_postal, $adresse, $mail, $bio)
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO profiles(id_user, adress, tel, mail, bio, ville, code_postal) VALUES(?, ?, ?, ?, ?, ?, ?)'
        );
        $affectedLines = $statement->execute([$id_user, $adresse, $tel, $mail, $bio, $ville, $code_postal]);

        return ($affectedLines > 0);
    }

    public function profile_login(string $id_user)
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE logins SET info_plus=1 WHERE id=?'
        );
        $affectedLines = $statement->execute([$id_user]);

        return ($affectedLines > 0);
    }

    public function getprofile(string $id_user)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT adress, tel, mail, bio, instagram, ville, code_postal FROM profiles WHERE id_user=?'
        );
        $statement->execute([$id_user]);

        $profiles = [];
        while (($row = $statement->fetch())) {
            $profile = new ProfileInfo();
            $profile->tel = $row['tel'];
            $profile->adresse = $row['adress'];
            $profile->mail = $row['mail'];
            $profile->bio = $row['bio'];
            $profile->instagram = $row['instagram'];
            $profile->ville = $row['ville'];
            $profile->code_postal = $row['code_postal'];

            $profiles[] = $profile;
        }

        return $profiles;
    }

    public function getprofilebyID($id)
    {
        $statement = $this->connection->getConnection()->prepare(
            'SELECT bio FROM profiles WHERE id_user=?'
        );
        $statement->execute([$id]);
        $profileById = $statement->fetch();
        return $profileById;
    }

    public function delprofile($id_user)
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM profiles WHERE id_user=?'
        );
        $affectedLines = $statement->execute([$id_user]);

        return ($affectedLines > 0);
    }

    public function profile_unlogin(string $id_user)
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE logins SET info_plus=0 WHERE id=?'
        );
        $affectedLines = $statement->execute([$id_user]);

        return ($affectedLines > 0);
    }

    public function profileedit($id_user, $tel, $ville, $code_postal, $adresse, $mail, $bio)
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE profiles SET adress=?, tel=? , mail=?, bio=?, ville=?, code_postal=? WHERE id_user=?'
        );
        $affectedLines = $statement->execute([$adresse, $tel, $mail, $bio, $ville, $code_postal, $id_user]);

        return ($affectedLines > 0);
    }
}
