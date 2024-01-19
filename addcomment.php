<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cityId']) && isset($_POST['comment'])) {
        $cityId = $_POST['cityId'];
        $comment = $_POST['comment'];
        $db = new Database();

        try {
            $sql = "INSERT INTO comentarios (city_id, username, comment) VALUES (?, ?, ?)";
            $params = array($cityId, $_COOKIE['username'], $comment);
            $db->execute($sql, $params);
        } catch (PDOException $e) {
            echo 'Erro ao adicionar comentário: ' . $e->getMessage();
        }
    }
}
?>
