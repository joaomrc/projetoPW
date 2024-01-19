<?php
require_once 'controller/citycontroller.php';
require_once 'view/cityview.php';

$canComment = true;
    
    if(!isset($_COOKIE['username'])) header('Location: login.php');
    
    if(isset($_GET['code'])){
        $code = $_GET['code'];
        $currentMovie = getFilme($code)[0];
        $comentarios = getComentarios($code);
    }
    
    if(isset($_POST['submit'])){
        adicionarComentarios($_COOKIE['username'], $_GET['code'], $_POST['comentarioNovo']);
    }


$cityController = new CityController();
$cityView = new CityView();

$cities = $cityController->getCities();
$cityView->showCities($cities);
?>