<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'city_rating';
    private $username = 'root'; 
    private $password = ''; 

    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }

    public function query($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function execute($sql, $params) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
    }
}
?>
