<?php

if (!isset($_COOKIE['username'])) {
    header('Location: login.php');
    exit();
}
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
                <header>
                    <h1>City Rating</h1>
        
                    <div>   
                        <label>Bem vindo/a,</label> 
                        <span><?=$_COOKIE['username']?></span>
                        <label>!</label> 
                        <a href="logout.php">Sair</a>    
                    </div>
                </header>

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

                                loadCityComments(cityId);

                                cityDetail.classList.add("show-detail");
                            });
                        });
                    });

                    function loadCityComments(cityId) {
                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                document.getElementById("city-comments").innerHTML = xhr.responseText;
                            }
                        };
                        xhr.open("GET", "getcomments.php?cityId=" + cityId, true);
                        xhr.send();
                    }

                    document.getElementById("comment-form").addEventListener("submit", function (event) {
                        event.preventDefault();
                        
                        var cityId = document.getElementById("city-id").value;
                        var comentarioNovo = document.getElementById("comentarioNovo").value;

                        var xhr = new XMLHttpRequest();
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                loadCityComments(cityId);
                                document.getElementById("comentarioNovo").value = '';
                            }
                        };

                        xhr.open("POST", "index.php", true);
                        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                        xhr.send("submitComment=true&cityId=" + cityId + "&comentarioNovo=" + comentarioNovo);
                    });
                    function showCityDetails(cityId, cityName, cityCountry, cityImage, cityDescription) {
                        alert("Detalhes da cidade:\n\nNome: " + cityName + "\nPaís: " + cityCountry + "\nDescrição: " + cityDescription);
                    }
                </script>
            </div>
        </body>
        </html>
        <?php
    }
}
?>