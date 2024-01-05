<?php
require_once 'controller/citycontroller.php';
require_once 'view/cityview.php';

$cityController = new CityController();
$cityView = new CityView();

$cities = $cityController->getCities();
$cityView->showCities($cities);
?>
