<?php

namespace Application\Controllers\AddComment;

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/login.php');

use Application\Model\Login\UserRepository;
use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;

class AddComment
{
    public function execute(string $post, int $author, array $input)
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
}
