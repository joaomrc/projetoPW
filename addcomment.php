<?php
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cityId']) && isset($_POST['comment']) && isset($_POST['rating'])) {
        $cityId = $_POST['cityId'];
        $comment = $_POST['comment'];
        $rating = $_POST['rating'];
        $db = new Database();

        try {
            // Adiciona o comentário e a avaliação à tabela 'comentarios'
            $sql = "INSERT INTO comentarios (city_id, username, comment, rating) VALUES (?, ?, ?, ?)";
            $params = array($cityId, $_COOKIE['username'], $comment, $rating);
            $db->execute($sql, $params);
        } catch (PDOException $e) {
            echo 'Erro ao adicionar comentário: ' . $e->getMessage();
        }
    }
}
?>
