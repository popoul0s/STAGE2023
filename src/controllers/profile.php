<?php

namespace Application\Controllers\Profile;

require_once('src/lib/database.php');
require_once('src/model/profile.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Profile\ProfileRepository;

class Profile
{
    public function profileredirection()
    {
        require('./templates/profile.php');
    }

    public function editprofileredirection($id_user)
    {
        $connection = new DatabaseConnection();

        $profileRepository = new ProfileRepository();
        $profileRepository->connection = $connection;
        $profiles = $profileRepository->getprofile($id_user);
        require('./templates/edit_profile.php');
    }

    public function profileadd($id_user, $tel, $ville, $code_postal, $adresse, $mail, $bio)
    {
        if (!empty($id_user) && !empty($tel) && !empty($ville) && !empty($code_postal) && !empty($adresse) && !empty($mail) && !empty($bio)) {
            $profilerepository = new ProfileRepository();
            $profilerepository->connection = new DatabaseConnection();
            $success = $profilerepository->profile($id_user, $tel, $ville, $code_postal, $adresse, $mail, $bio);

            $success2 = $profilerepository->profile_login($id_user);
            if (!$success && !$success2) {
                throw new \Exception('Impossible d\'ajouter le profil !');
            } else {
                $_SESSION['info_validate'] = true;
                header('Location: index.php');
            }
        } else {
            header('Location: index.php?action=profileredirection');
        }
    }

    public function profileremove($id_user)
    {
        if (!empty($id_user)) {
            $profilerepository = new ProfileRepository();
            $profilerepository->connection = new DatabaseConnection();
            $success = $profilerepository->delprofile($id_user);

            $success2 = $profilerepository->profile_unlogin($id_user);
            if (!$success && !$success2) {
                throw new \Exception('Impossible d\'ajouter le profil !');
            } else {
                $_SESSION['info_validate'] = false;
                header('Location: index.php');
            }
        } else {
            header('Location: index.php?action=profileredirection');
        }
    }

    public function profileedit($id_user, $tel, $ville, $code_postal, $adresse, $mail, $bio)
    {
        if (!empty($id_user) && !empty($tel) && !empty($ville) && !empty($code_postal) && !empty($adresse) && !empty($mail) && !empty($bio)) {
            $profilerepository = new ProfileRepository();
            $profilerepository->connection = new DatabaseConnection();
            $success = $profilerepository->profileedit($id_user, $tel, $ville, $code_postal, $adresse, $mail, $bio);

            if (!$success) {
                throw new \Exception('Impossible d\'ajouter le profil !');
            } else {
                $_SESSION['info_validate'] = true;
                header('Location: index.php?action=seeprofile&id_user=' . $id_user);
            }
        } else {
            header('Location: index.php?action=profileredirection');
        }
    }

    public function executeSeeProfile($id_user)
    {
        $connection = new DatabaseConnection();

        $profileRepository = new ProfileRepository();
        $profileRepository->connection = $connection;
        $profiles = $profileRepository->getprofile($id_user);

        require('./templates/seeprofile.php');
    }
}
