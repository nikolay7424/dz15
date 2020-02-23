<?php


namespace Model;

use Core\Database;

/**
 * Class Article
 * @package Model
 */
class Article
{
    private $db;

    /**
     * Article constructor.
     * Starts PDO
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @param int $user_id
     * @return array
     * Selects all articles
     */
    public function getArticlesByUserId(int $user_id):array
    {
        $this->db->query("SELECT * FROM articles WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        $articles = $this->db->resultSet();
        return $articles;
    }

    /**
     * @param string $title
     * @param int $user_id
     * @param string $text
     * @return bool
     * Inserts new article
     */
    public function insertArticle(string $title, int $user_id, string $text):bool
    {
        $this->db->query('INSERT INTO articles (title, user_id, text) VALUES(:title, :user_id, :text);');
        $this->db->bind(':title', $title);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':text', $text);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param string $title
     * @param string $text
     * @param int $article_id
     * @param int $user_id
     * @return bool
     * updates article
     */
    public function updateArticle(string $title, string $text, int $article_id, int $user_id):bool
    {
        $this->db->query('UPDATE articles SET title = :title, text = :text WHERE id = :article_id AND user_id = :user_id');
        $this->db->bind(':title', $title);
        $this->db->bind(':text', $text);
        $this->db->bind(':article_id', $article_id);
        $this->db->bind(':user_id', $user_id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param int $article_id
     * @param int $user_id
     * @return bool
     * deletes article
     */
    public function deleteArticle(int $article_id, int $user_id):bool
    {
        $this->db->query('DELETE FROM articles WHERE id = :article_id AND user_id = :user_id');
        $this->db->bind(':article_id', $article_id);
        $this->db->bind(':user_id', $user_id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}