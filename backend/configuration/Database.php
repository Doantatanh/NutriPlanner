<?php
require_once "DatabaseInfo.php";
class Database
{
    private $conn;

    public function __construct()
    {
        $host = DatabaseInfo::getDatabaseInfo();
        $username = DatabaseInfo::getDatabaseUsername();
        $password = DatabaseInfo::getDatabasePassword();
        $dbname = DatabaseInfo::getDatabaseName();
        $port = DatabaseInfo::getDatabasePort();

        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

        try {
            $this->conn = new PDO($dsn, $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Kết nối thất bại: " . $e->getMessage());
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}
