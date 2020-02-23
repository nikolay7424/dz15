<?php


namespace Core;

use PDO;
use PDOException;

/**
 * Class Database
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
 */
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $password = DB_PASS;
    private $dbname = DB_NAME;

    /**
     * @var PDO
     * database handler
     */
    private $dbh;
    private $stmt;
    private $error;

    /**
     * Database constructor.
     */
    public function __construct()
    {
        //set DSN
        $dsn = 'mysql:host='. $this->host .';dbname='. $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        //create pdo instance
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        }catch(PDOException $e){
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    /**
     * @param $sql
     * prepare statement with query
     */
    public function query(string $sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    /**
     * @param $param
     * @param $value
     * @param null $type
     * bind values
     */
    public function bind($param, $value, $type = null)
    {
        if(is_null($type))
        {
            switch (true)
            {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;

                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;

                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;

                default:
                    $type = PDO::PARAM_STR;
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    /**
     * @return mixed
     * execute the prepared statement
     */
    public function execute()
    {
        return $this->stmt->execute();
    }

    /**
     * @return mixed
     * get result set as an array of objects
     */
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * @return mixed
     * get result as an array
     */
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @return mixed
     * get row count
     */
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}