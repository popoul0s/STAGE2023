<?php

namespace Application\Controllers\EditComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class EditComment
{
    public function execute(string $post, $author, array $input)
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
