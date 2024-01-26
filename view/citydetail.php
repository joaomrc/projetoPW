<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Detail</title>
    <link rel="stylesheet" href="style.css">
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

        <label for="avaliacao">Avaliação de 0 a 5:</label>
        <input type="number" id="avaliacao" name="avaliacao" min="0" max="5" required>

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
        });

        function addComment() {
    var cityId = document.getElementById("city-id").value;
    var comment = document.getElementById("comentarioNovo").value;
    var rating = document.getElementById("avaliacao").value;

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Depois de adicionar o comentário e a avaliação, recarrega os comentários
            loadCityComments(cityId);
            document.getElementById("comentarioNovo").value = '';
            document.getElementById("avaliacao").value = '';
        }
    };

    xhr.open("POST", "addcomment.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("cityId=" + cityId + "&comment=" + comment + "&rating=" + rating);
}


function addRating() {
    var cityId = document.getElementById("rating-city-id").value;
    var ratingValue = document.getElementById("ratingValue").value;

    var formData = new FormData();
    formData.append('cityId', cityId);
    formData.append('rating', ratingValue);

    fetch('addrating.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Se a avaliação for adicionada com sucesso, recarregue as avaliações
            loadCityRatings(cityId);
            document.getElementById("ratingValue").value = '';
        } else {
            // Se houver um erro, exiba uma mensagem de erro
            console.error('Erro ao adicionar avaliação:', data.error);
        }
    })
    .catch(error => {
        console.error('Erro ao enviar avaliação:', error);
    });
}

        function loadCityRatings(cityId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Limpe as avaliações anteriores
            document.getElementById("city-ratings").innerHTML = '';

            // Adicione as novas avaliações apenas para a cidade correta
            var ratings = JSON.parse(xhr.responseText);
            ratings.forEach(function (rating) {
                var ratingDiv = document.createElement("div");
                ratingDiv.className = "rating";
                ratingDiv.textContent = 'Rating: ' + rating.rating;
                document.getElementById("city-ratings").appendChild(ratingDiv);
            });
        }
    };
    xhr.open("GET", "getratings.php?cityId=" + cityId, true);
    xhr.send();
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

        function loadCityComments(cityId) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var commentsContainer = document.getElementById("city-comments");
            commentsContainer.innerHTML = ''; // Limpa os comentários existentes

            var comments = JSON.parse(xhr.responseText);
            comments.forEach(function (comment) {
                var commentDiv = document.createElement("div");
                commentDiv.classList.add("comment");

                var userRating = comment.rating !== null ? ' - Rating: ' + comment.rating : '';
                commentDiv.innerHTML = '<strong>@' + comment.username + '</strong>' + userRating + ' ' + comment.comment;

                commentsContainer.appendChild(commentDiv);
            });
        }
    };
    xhr.open("GET", "getcomments.php?cityId=" + cityId, true);
    xhr.send();
}

    </script>
</div>
</body>
</html>
