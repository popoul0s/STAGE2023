<?php

namespace Application\Model\Comment;

require_once('src/lib/database.php');
require_once('src/model/login.php');
require_once('src/model/profile.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Login\UserRepository;
use Application\Model\Profile\ProfileRepository;

class Comment
{
    public string $author;
    public int $id_author;
    public string $frenchCreationDate;
    public string $comment;
    public string $id;
    public string $bio;
}

class CommentRepository
{
    public DatabaseConnection $connection;

    public function getComments(string $post): array
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM comments WHERE post_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$post]);

        $comments = [];
        while (($row = $statement->fetch())) {
            $userRepository = new UserRepository();
            $userRepository->connection = new DatabaseConnection();
            $author = $userRepository->getLoginWithId($row['author']);
            $profileRepository = new ProfileRepository();
            $profileRepository->connection = new DatabaseConnection();
            if(!empty($profileRepository->getprofilebyID($row['author']))){
                $bio = $profileRepository->getprofilebyID($row['author']);
                $comment = new Comment();
                $comment->id_author = $row['author'];
                $comment->author = ucfirst($author['name']) . ' ' . ucfirst($author['firstname']);
                $comment->frenchCreationDate = $row['french_creation_date'];
                $comment->comment = $row['comment'];
                $comment->id = $row['id'];
                $comment->bio = $bio['bio'];
    
                $comments[] = $comment;
            } else {
                $comment = new Comment();
                $comment->id_author = $row['author'];
                $comment->author = ucfirst($author['name']) . ' ' . ucfirst($author['firstname']);
                $comment->frenchCreationDate = $row['french_creation_date'];
                $comment->comment = $row['comment'];
                $comment->id = $row['id'];
                $comment->bio = '';
    
                $comments[] = $comment;
            }
        }

        return $comments;
    }

    public function createComment(string $post, string $author, string $comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }

    public function editComment(string $post, string $author, string $comment, string $id_comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE comments SET author=?, comment=?,comment_date=NOW() WHERE post_id=? AND id=?'
        );
        $affectedLines = $statement->execute(["$author", "$comment", $post, $id_comment]);

        return ($affectedLines > 0);
    }

    public function delComment(string $post, string $id_comment): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM comments WHERE post_id=? AND id=?'
        );
        $affectedLines = $statement->execute([$post, $id_comment]);

        return ($affectedLines > 0);
    }
    public function delCommentAll(string $post): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM comments WHERE post_id=?'
        );
        $affectedLines = $statement->execute([$post]);

        return ($affectedLines > 0);
    }
}
