<?php
require_once 'model/citymodel.php';

class CityController {
    private $cityModel;

    public function __construct() {
        $this->cityModel = new CityModel();
    }

    public function getCities() {
        return $this->cityModel->getAllCities();
    }
}
?>
