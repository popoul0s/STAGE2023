<?php

namespace Application\Controllers\Post;

require_once('src/lib/database.php');
require_once('src/model/comment.php');
require_once('src/model/post.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Comment\CommentRepository;
use Application\Model\Post\PostRepository;

class Post
{
    public function SelectPostExecute(string $identifier)
    {
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $post = $postRepository->getPost($identifier);

        $commentRepository = new CommentRepository();
        $commentRepository->connection = $connection;
        $comments = $commentRepository->getComments($identifier);

        require('templates/post.php');
    }



    /*  
     *    ______           __      ______      __   __     _______
     *   |  __  |         |  |    |  __  |    |  | |  |   |__   __|
     *   | |__| |         |  |    | |  | |    |  | |  |      | |
     *   |  __  |     __  |  |    | |  | |    |  | |  |      | |
     *   | |  | |    |  |_|  |    | |__| |    |  |_|  |      | |  
     *   |_|  |_|    |_______|    |______|    |_______|      |_|
     */

    public function AddPostExecute(string $title, string $content)
    {

        $postrepository = new PostRepository();
        $postrepository->connection = new DatabaseConnection();
        $success = $postrepository->createPost($title, $content);
        if (!$success) {
            throw new \Exception('Impossible d\'ajouter le post !');
        } else {
            header('Location: index.php');
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

    public function DelPostExecute(string $post)
    {
        $commentRepository = new CommentRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->delCommentAll($post);

        $postRepository = new PostRepository();
        $postRepository->connection = new DatabaseConnection();
        $success2 = $postRepository->delPost($post);
        if (!$success && !$success2) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        } else {
            header('Location: index.php');
        }
    }



    /*  
     *    ______      ______       _      _______
     *   |  ____|    |  __  \     |_|    |__   __|
     *   | |___      | |  \  |     _        | |
     *   |  ___|     | |   | |    | |       | |
     *   | |____     | |_ /  |    | |       | |  
     *   |______|    |______/     |_|       |_|
     */
    
    public function EditPostExecute(string $id, string $title, string $content)
    {

        $commentRepository = new PostRepository();
        $commentRepository->connection = new DatabaseConnection();
        $success = $commentRepository->editPost($id, $title, $content);
        if (!$success) {
            throw new \Exception('Impossible de modifier le Post !');
        } else {
            header('Location: index.php');
        }
    }

    public function editredirection($identifier)
    {   
        $connection = new DatabaseConnection();

        $postRepository = new PostRepository();
        $postRepository->connection = $connection;
        $post = $postRepository->getPost($identifier);
        require('./templates/edit_post.php');
    }
}
