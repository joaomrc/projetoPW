<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Detail</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>

<body>
<div class="city-detail" id="city-detail">
    <h2 id="city-name"></h2>
    <h3 id="city-country"></h3>
    <img src="" alt="City Image" id="city-image">
    <p id="city-description"></p>

    <div class="comment-section" id="comment-section">
    <h2>Comentários</h2>
    <form id="comment-form" onsubmit="addComment(); return false;">
        <input type="hidden" id="city-id" name="cityId" value="">
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
        <label for="comentarioNovo">Deixe um comentário:</label>
        <textarea id="comentarioNovo" placeholder="Escreva o seu comentário aqui..." name="comentarioNovo" required></textarea>
        <input type="submit" name="submitComment" value="Comentar">
    </form>
    <div id="city-comments"></div>
    </div>

<div class="footer-basic">
        <footer>
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">Serviços</a></li>
                <li class="list-inline-item"><a href="#">Sobre</a></li>
                <li class="list-inline-item"><a href="#">Termos</a></li>
                <li class="list-inline-item"><a href="#">Política de Privacidade</a></li>
            </ul>
            <p class="copyright">City Rating © 2024</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>

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
                loadCityComments(cityId);
                document.getElementById("comentarioNovo").value = '';
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
            star.innerHTML = '&#9733;';
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

    function showCityDetails(cityId, cityName, cityCountry, cityImage, cityDescription) {
        document.getElementById("city-name").textContent = cityName;
        document.getElementById("city-country").textContent = cityCountry;
        document.getElementById("city-image").src = cityImage;
        document.getElementById("city-description").textContent = cityDescription;
        document.getElementById("city-id").value = cityId;

        loadCityComments(cityId);

        loadCityRatings(cityId);

        document.getElementById("city-detail").classList.add("show-detail");
    }

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
