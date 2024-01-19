<?php
require_once 'database.php';

if (isset($_GET['cityId'])) {
    $cityId = $_GET['cityId'];
    $db = new Database();

    try {
        $sql = "SELECT * FROM comentarios WHERE city_id = " . $cityId;

        $result = $db->query($sql);

        foreach ($result as $comment) {
            echo '<div class="comment">';
            echo '<strong>@' . $comment['username'] . '</strong> ' . $comment['comment'];
            echo '</div>';
        }
    } catch (PDOException $e) {

        echo 'Erro ao obter comentários: ' . $e->getMessage();
    }
} else {
    echo 'Parâmetro cityId não fornecido.';
}
?>
