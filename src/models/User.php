<?php


namespace Model;

use Core\Database;

/**
 * Class User
 * @package Model
 */
class User
{
    private $db;
    private $token;
    private $id;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->db = new Database();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param mixed $token
     */
    public function setToken($token): void
    {
        $this->token = $token;
    }

    /**
     * Token validation
     * @return bool
     * @throws \Exception
     */
    public function isTokenValid()
    {
        $this->db->query("SELECT * FROM users WHERE token = :token");
        $this->db->bind(':token', $this->token);
        $this->db->execute();
        if ($this->db->execute()) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * @return mixed
     * Selects user id based on token
     */
    public function getUserIdByToken()
    {
        $this->db->query('SELECT id FROM users WHERE token = :token');
        $this->db->bind(':token', $this->token);
        $row = $this->db->single();
        return $row['id'];
    }
}
