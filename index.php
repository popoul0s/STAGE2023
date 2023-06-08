<?php
session_start();
require_once('src/controllers/edit_user.php');
require_once('src/controllers/gest_user.php');
require_once('src/controllers/register.php');
require_once('src/controllers/comment.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/post.php');
require_once('src/controllers/login.php');
require_once('src/controllers/profile.php');

use Application\Controllers\EditUser\EditUser;
use Application\Controllers\GestUser\GestUser;
use Application\Controllers\Register\Register;
use Application\Controllers\Comment\Comment;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Post\Post;
use Application\Controllers\Login\Login;
use Application\Controllers\Profile\Profile;


try {
   if (isset($_GET['action']) && $_GET['action'] !== '') {
      switch ($_GET['action']) {

         case 'post':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];

               (new Post())->SelectPostExecute($identifier);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'addPost':
            (new Post())->AddPostExecute($_POST['title'], $_POST['content']);
            break;
         case 'editPostredirection':
            (new Post())->editredirection($_GET['id']);
            break;
         case 'editPost':
            (new Post())->EditPostExecute($_GET['id'], $_POST['title'], $_POST['content']);
            break;

         case 'delPost':
            (new Post())->DelPostExecute($_GET['id']);
            break;

         case 'addComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];

               (new Comment())->AddCommentExecute($identifier, $_SESSION['id_user_verif'], $_POST);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'editredirection';
            (new Comment())->editredirection();
            break;
         case 'editComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];

               (new Comment())->EditCommentExecute($identifier, $_SESSION['id_user_verif'], $_POST);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'delredirection':
            (new Comment())->delredirection();
            break;
         case 'delComment':
            if (isset($_GET['id']) && $_GET['id'] > 0) {
               $identifier = $_GET['id'];
               $id_comment = $_GET['id_comment'];

               (new Comment())->DelCommentExecute($identifier, $id_comment);
            } else {
               throw new Exception('Aucun identifiant de billet envoyé');
            }
            break;

         case 'register':
            if (isset($_POST['user']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['firstname'])) {
               $login = (new Register());
               $login->register($_POST['user'], $_POST['pw'], $_POST['name'], $_POST['firstname']);
               var_dump($_FILES['pp']);
            } else {
               (new Register())->execute();
            }
            break;
         case 'registergest':
            if (isset($_POST['user']) && isset($_POST['pw']) && isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['role'])) {
               (new Register())->registergest($_POST['user'], $_POST['pw'], $_POST['name'], $_POST['firstname'], $_POST['role']);
            } else {
               (new Register())->executegest();
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

         case 'un_login':
            session_destroy();
            header('Location:index.php');
            break;

         case 'dellogin':
            (new Login())->dellogin($_GET['id_user']);
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
            (new Profile())->executeSeeProfile($_GET['id_user']);
            break;
         case 'profileredirection':
            (new Profile())->profileredirection();
            break;
         case 'createprofile':
            (new Profile())->profileadd($_GET['id_user'], $_POST['number'], $_POST['ville'], $_POST['code_postal'], $_POST['adresse'], $_POST['mail'], $_POST['bio']);
            break;
         case 'delprofile':
            (new Profile())->profileremove($_GET['id_user']);
            break;
         case 'editprofileredirection':
            (new Profile())->editprofileredirection($_GET['id_user']);
            break;
         case 'editprofile':
            (new Profile())->profileedit($_GET['id_user'], $_POST['number'], $_POST['ville'], $_POST['code_postal'], $_POST['adresse'], $_POST['mail'], $_POST['bio']);
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
