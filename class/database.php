<?php
class Database
{

    private $host = "localhost";

    private $database = "dckap_product";

    private $user_name = "root";

    private $password = "";

    public $connection;

    public function __construct()
    {

        error_reporting(E_ERROR | E_WARNING | E_PARSE);

    }

    public function getConnection()
    {
        $this->connection = null;
        try
        {

            $this->connection = new PDO("mysql:host=" . $this->host . "; dbname=" . $this->database, $this->user_name, $this->password);
            $this
                ->connection
                ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $exception)
        {
            echo "Database connection Error: " . $exception->getMessage();
        }
        return $this->connection;
    }

}

?>
