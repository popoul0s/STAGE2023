<?php

namespace Application\Model\Post;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Post
{
    public string $title;
    public string $frenchCreationDate;
    public string $content;
    public string $identifier;
}

class PostRepository
{
    public DatabaseConnection $connection;

    public function getPost(string $identifier): Post
    {
        $statement = $this->connection->getConnection()->prepare(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin') AS french_creation_date FROM posts WHERE id = ?"
        );
        $statement->execute([$identifier]);

        $row = $statement->fetch();
        $post = new Post();
        $post->title = $row['title'];
        $post->frenchCreationDate = $row['french_creation_date'];
        $post->content = $row['content'];
        $post->identifier = $row['id'];

        return $post;
    }

    public function getPosts(): array
    {
        $statement = $this->connection->getConnection()->query(
            "SELECT id, title, content, DATE_FORMAT(creation_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM posts ORDER BY creation_date DESC LIMIT 0, 5"
        );
        $posts = [];
        while (($row = $statement->fetch())) {
            $post = new Post();
            $post->title = $row['title'];
            $post->frenchCreationDate = $row['french_creation_date'];
            $post->content = $row['content'];
            $post->identifier = $row['id'];

            $posts[] = $post;
        }

        return $posts;
    }
    public function createPost(string $title, string $content): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'INSERT INTO posts(title, content, creation_date) VALUES(?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$title, $content]);

        return ($affectedLines > 0);
    }

    public function editPost(string $id, string $title, string $content): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'UPDATE posts SET title=?, content=? ,creation_date=NOW() WHERE id=?'
        );
        $affectedLines = $statement->execute(["$title", "$content", $id]);

        return ($affectedLines > 0);
    }

    public function delPost(string $post): bool
    {
        $statement = $this->connection->getConnection()->prepare(
            'DELETE FROM posts WHERE id=?'
        );
        $affectedLines = $statement->execute([$post]);

        return ($affectedLines > 0);
    }
}
