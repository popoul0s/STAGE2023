<?php
session_start();
require_once('src/controllers/edit_user.php');
require_once('src/controllers/gest_user.php');
require_once('src/controllers/register.php');
require_once('src/controllers/del_comment.php');
require_once('src/controllers/edit_comment.php');
require_once('src/controllers/add_comment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/login.php');

use Application\Controllers\EditUser\EditUser;
use Application\Controllers\GestUser\GestUser;
use Application\Controllers\Register\Register;
use Application\Controllers\DelComment\DelComment;
use Application\Controllers\EditComment\EditComment;
use Application\Controllers\AddComment\AddComment;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;
use Application\Controllers\Login\Login;


try {
   if (isset($_GET['action']) && $_GET['action'] !== '') {
      switch ($_GET['action']) {

         case 'post':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];

               (new Post())->execute($identifier);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'addComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];

               (new AddComment())->execute($identifier, $_SESSION['id_user_verif'], $_POST);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'editredirection';
            (new EditComment())->editredirection();
            break;
         case 'editComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];

               (new EditComment())->execute($identifier, $_SESSION['id_user_verif'], $_POST);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'delredirection':
            (new DelComment())->delredirection();
            break;
         case 'delComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];
               $id_comment = $_GET['id_comment'];

               (new DelComment())->execute($identifier, $id_comment);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'register':
            if (isset($_POST['user']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['firstname'])) {
               $login = (new Register());
               $login->register($_POST['user'], $_POST['pw'], $_POST['name'], $_POST['firstname']);
            } else {
               (new Register())->execute();
            }
            break;
         case 'pageregister':
            $login = (new Register);
            $login->execute();
            break;

         case 'login':
            if (isset($_POST['user']) && isset($_POST['pw'])) {
               $login = (new Login);
               $login->login($_POST['user'], $_POST['pw']);
            } else {
               (new Login())->execute();
            }
         case 'pagelogin':
            (new Login())->execute();
            break;

         case 'destroysession':
            session_destroy();
            (new Homepage())->execute();
            header('Location:index.php');
            break;

         case 'un_login':
            session_destroy();
            (new Homepage())->execute();
            header('Location:index.php');
            break;

         case 'gest_user':
            (new GestUser())->execute();
            break;

         case 'edituser_redirection':
            (new EditUser())->edituser_redirection();
            break;
         case 'edit_user':
            (new EditUser())->execute($_POST);
            break;

         case 'seeprofile':
            (new Login())->executeSeeProfile();
            break;
         default:
            throw new Exception("La page que vous cherchez n'existe pas !!");
      }
   } else {
      (new Homepage())->execute();
   }
} catch (Exception $e) {
   $errorMessage = $e->getMessage();

   require('templates/error.php');
}
