<?php
require_once 'model/CityModel.php';

class CityController {
    private $cityModel;

    public function __construct() {
        $this->cityModel = new CityModel();
    }

    public function getCities() {
        return $this->cityModel->getAllCities();
    }

    public function handleRequest() {
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';

        switch ($action) {
            case 'index':
                $this->index();
                break;
            case 'submit':
                $this->submit();
                break;
            default:
                $this->index();
        }
    }

    public function index() {
        $cities = $this->getCities();
        require 'view/index.php';
    }

    public function submit() {

    }
}
?>
