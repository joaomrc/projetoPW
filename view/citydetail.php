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

    <form action="?action=submit" method="post" class="city-form">
        <input type="hidden" name="city_id" id="city-id" value="">
        
        <div class="rate" id="city-rating">
        </div>

        <input class="city-input" type="text" name="comment" placeholder="Escreva um comentário..." required>
        <button type="submit" class="submit-btn">Enviar</button>
    </form>
    <script>

        document.addEventListener("DOMContentLoaded", function () {
            var cityCard = document.querySelector('.city-card');
            if (cityCard) {
                cityCard.classList.add('selected');
            }
        });
    </script>
</div>

</body>
</html>

