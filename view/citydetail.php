<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Detail</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
<div class="city-detail" id="city-detail">
    <h2 id="city-name"></h2>
    <h3 id="city-country"></h3>
    <img src="" alt="City Image" id="city-image">
    <p id="city-description"></p>

    <div class="comment-section" id="comment-section">
    <h2>Comentários</h2>
    <div id="city-comments"></div>

    <form id="comment-form" onsubmit="addComment(); return false;">
        <input type="hidden" id="city-id" name="cityId" value="">
        <label for="comentarioNovo">Deixe um comentário:</label>
        <textarea id="comentarioNovo" name="comentarioNovo" required></textarea>

        <label for="avaliacao">Avaliação:</label>

        <div class="rating-container">
                    <input type="radio" id="star5" name="rating" value="5" />
                    <label for="star5" title="5 stars">&#9733;</label>
                    <input type="radio" id="star4" name="rating" value="4" />
                    <label for="star4" title="4 stars">&#9733;</label>
                    <input type="radio" id="star3" name="rating" value="3" />
                    <label for="star3" title="3 stars">&#9733;</label>
                    <input type="radio" id="star2" name="rating" value="2" />
                    <label for="star2" title="2 stars">&#9733;</label>
                    <input type="radio" id="star1" name="rating" value="1" />
                    <label for="star1" title="1 star">&#9733;</label>
        </div>

        <input type="submit" name="submitComment" value="Comentar">
    </form>
</div>

</form>
    </div>
    <script>
       document.addEventListener("DOMContentLoaded", function () {
        var cityCard = document.querySelector('.city-card');
        if (cityCard) {
            cityCard.classList.add('selected');
        }

        loadRatingStars();
    });

    function addComment() {
        var cityId = document.getElementById("city-id").value;
        var comment = document.getElementById("comentarioNovo").value;
        var rating = document.querySelector('input[name="rating"]:checked') ? document.querySelector('input[name="rating"]:checked').value : null;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Depois de adicionar o comentário e a avaliação, recarrega os comentários
                loadCityComments(cityId);
                document.getElementById("comentarioNovo").value = '';
                // Limpa as seleções de estrelas
                document.querySelectorAll('input[name="rating"]').forEach(input => input.checked = false);
            }
        };

        xhr.open("POST", "addcomment.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("cityId=" + cityId + "&comment=" + comment + "&rating=" + rating);
    }

    function loadRatingStars() {
        var ratingStarsContainer = document.getElementById('rating-stars');

        for (var i = 5; i >= 1; i--) {
            var star = document.createElement('span');
            star.className = 'star';
            star.setAttribute('data-rating', i);
            star.innerHTML = '&#9733;'; // Caractere de estrela
            star.addEventListener('click', function () {
                var rating = this.getAttribute('data-rating');
                setRatingStars(rating);
            });

            ratingStarsContainer.appendChild(star);
        }
    }

    function setRatingStars(rating) {
        var stars = document.querySelectorAll('.star');

        stars.forEach(function (star) {
            if (star.getAttribute('data-rating') <= rating) {
                star.classList.add('checked');
            } else {
                star.classList.remove('checked');
            }
        });
    }

    // Função para mostrar os detalhes da cidade
    function showCityDetails(cityId, cityName, cityCountry, cityImage, cityDescription) {
         // Implemente a lógica para exibir os detalhes da cidade (pode ser semelhante ao código já existente)
         document.getElementById("city-name").textContent = cityName;
         document.getElementById("city-country").textContent = cityCountry;
        document.getElementById("city-image").src = cityImage;
        document.getElementById("city-description").textContent = cityDescription;
        document.getElementById("city-id").value = cityId;

        // Carrega os comentários da cidade
        loadCityComments(cityId);

        // Carrega as avaliações da cidade
        loadCityRatings(cityId);

        // Adiciona a classe para mostrar os detalhes
        document.getElementById("city-detail").classList.add("show-detail");
    }

    // Função auxiliar para converter o rating em estrelas usando Font Awesome
    function getStarRating(rating) {
        var stars = '';
        for (var i = 1; i <= 5; i++) {
            stars += '<span class="fa fa-star' + (i <= rating ? ' checked' : '') + '"></span>';
        }
        return stars;
    }

    </script>
</div>
</body>
</html>
