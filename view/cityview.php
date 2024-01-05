<?php

class CityView {
    public function showCities($cities) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>City Rating</title>
            <link rel="stylesheet" href="style.css">
        </head>
        <body>
            <div class="container">
                <h1>CITY RATING</h1>

                <div class="cities-container">
                <?php foreach ($cities as $city): ?>
    <div class="city-card">
        <h2><?= $city['cidade'] ?></h2>
        <h3><?= $city['país'] ?> (<?= $city['continente'] ?>)</h3>
                        
        <!-- Adiciona formulário de avaliação aqui -->
        <form action="?action=submit" method="post">
            <input type="hidden" name="city_id" value="<?= $city['id'] ?>">
                                
            <div class="rate">
                <?php echo $this->generateRatingInputs($city); ?>
            </div>
                                
            <input class="city-input" type="text" name="comment" placeholder="Escreva um comentário..." required>
            <button type="submit" class="submit-btn">Enviar</button>
        </form>
    </div>
<?php endforeach; ?>
                </div>
            </div>
        </body>
        </html>
        <?php
    }

    private function generateRatingInputs($selectedRating) {
        $inputs = '';
        if (isset($selectedRating)) {
            for ($i = 5; $i >= 1; $i--) {
                $checked = ($i == $selectedRating) ? 'checked' : '';
                $inputs .= "
                    <input type='radio' id='star$i' name='rate' value='$i' $checked />
                    <label for='star$i' title='$i stars'>$i stars</label>
                ";
            }
        } else {
            // Caso o campo 'rating' não esteja definido, gere inputs vazios
            for ($i = 5; $i >= 1; $i--) {
                $inputs .= "
                    <input type='radio' id='star$i' name='rate' value='$i' />
                    <label for='star$i' title='$i stars'>$i stars</label>
                ";
            }
        }
        return $inputs;
    }
}
?>
