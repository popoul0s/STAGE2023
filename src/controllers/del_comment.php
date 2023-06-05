<?php

namespace Application\Controllers\DelComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class DelComment
{
    public function execute(string $post, string $id_comment)
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
}
