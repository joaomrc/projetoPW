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
            echo '<strong>@' . $comment['username'] . '</strong>';
    
            // Print star ratings based on the numerical rating
            if ($comment['rating'] !== null) {
                $stars = intval($comment['rating']); // Convert rating to integer
                for ($i = 0; $i < $stars; $i++) {
                    echo '<i class="fa fa-star"></i>';
                }
                for ($i = 0; $i < (5 - $stars); $i++) {
                    echo '<i class="far fa-star"></i>';
                }
            }
    
            // Print the rest of the comment
            echo ' ' . $comment['comment'];
            echo '</div>';
        }
    } catch (PDOException $e) {
        echo 'Erro ao obter comentários: ' . $e->getMessage();
    }
} else {
    echo 'Parâmetro cityId não fornecido.';
}
?>
