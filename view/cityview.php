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
                        <div class="city-card" data-city-id="<?= $city['id'] ?>">
                            <h2><?= $city['cidade'] ?></h2>
                            <h3><?= $city['país'] ?> (<?= $city['continente'] ?>)</h3>

                            <div class="city-info" data-city-id="<?= $city['id'] ?>" data-city-name="<?= $city['cidade'] ?>" data-city-country="<?= $city['país'] ?>" data-city-image="<?= $city['imagem'] ?>" data-city-description="<?= $city['descrição'] ?>"></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php include 'citydetail.php'; ?>

                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        var cityCards = document.querySelectorAll(".city-card");
                        var cityDetail = document.getElementById("city-detail");

                        cityCards.forEach(function (card) {
                            card.addEventListener("click", function () {
                                var cityId = this.getAttribute("data-city-id");
                                var cityName = this.querySelector("h2").textContent;
                                var cityCountry = this.querySelector("h3").textContent;
                                var cityImage = this.querySelector(".city-info").getAttribute("data-city-image");
                                var cityDescription = this.querySelector(".city-info").getAttribute("data-city-description");

                                document.getElementById("city-name").textContent = cityName;
                                document.getElementById("city-country").textContent = cityCountry;
                                document.getElementById("city-image").src = cityImage;
                                document.getElementById("city-description").textContent = cityDescription;
                                document.getElementById("city-id").value = cityId;

                                cityDetail.classList.add("show-detail");
                            });
                        });
                    });
                </script>
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
