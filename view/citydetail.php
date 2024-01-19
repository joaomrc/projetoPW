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
            <input type="submit" name="submitComment" value="Comentar">
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
            var commentInput = document.getElementById("comentarioNovo").value;
            if (commentInput.trim() !== "") {
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
    
                        loadCityComments(cityId);
                    }
                };
                xhr.open("POST", "addcomment.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("cityId=" + cityId + "&comment=" + encodeURIComponent(commentInput));
            }
        }

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
    </script>
</div>
</body>
</html>
