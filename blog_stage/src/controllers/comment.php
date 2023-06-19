<?php

namespace Application\Controllers\Comment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/login.php');

use Application\Model\Login\UserRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class Comment
{

    /*  
     *    ______           __      ______      __   __     _______
     *   |  __  |         |  |    |  __  |    |  | |  |   |__   __|
     *   | |__| |         |  |    | |  | |    |  | |  |      | |
     *   |  __  |     __  |  |    | |  | |    |  | |  |      | |
     *   | |  | |    |  |_|  |    | |__| |    |  |_|  |      | |  
     *   |_|  |_|    |_______|    |______|    |_______|      |_|
     */
    public function AddCommentExecute(string $post, int $author, array $input)
    {
        $comment = null;
        if (!empty($author) && !empty($input['comment'])) {
            $comment = $input['comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->createComment($post, $author, $comment);
        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }



    /*  
     *    ______      __   __      _____      _____
     *   |  ____|    |  | |  |    |  _  |    |  _  |
     *   | |____     |  | |  |    | |_| |    | |_| |
     *   |____  |    |  | |  |    |  ___|    |  ___|
     *    ____| |    |  |_|  |    | |        | |         _
     *   |______|    |_______|    |_|        |_|        |_|
     */

    public function DelCommentExecute(string $post, string $id_comment)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->delComment($post, $id_comment);
        if (!$success) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }

    public function delredirection()
    {
        $_SESSION['modeComment'] = 'del';
        require('./templates/edit.php');
    }



    /*  
     *    ______      ______       _      _______
     *   |  ____|    |  __  \     |_|    |__   __|
     *   | |___      | |  \  |     _        | |
     *   |  ___|     | |   | |    | |       | |
     *   | |____     | |_ /  |    | |       | |  
     *   |______|    |______/     |_|       |_|
     */

    public function EditCommentExecute(string $post, $author, array $input)
    {
        $comment = null;
        if (!empty($input['comment'])) {
            $comment = $input['comment'];
            $id_comment = $_GET['id_comment'];
        } else {
            throw new \Exception('Les données du formulaire sont invalides.');
        }

        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->editComment($post, $author, $comment, $id_comment);
        if (!$success) {
            throw new \Exception('Impossible de modifier le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }

    public function editredirection()
    {
        $_SESSION['modeComment'] = 'edit';
        require('./templates/edit.php');
    }
}


?>
