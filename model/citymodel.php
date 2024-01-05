<?php

class CityModel {
    private $data = array(
        array('id' => 1, 'continente' => 'América do Norte', 'país' => 'Estados Unidos', 'cidade' => 'Nova York'),
        array('id' => 2, 'continente' => 'Europa', 'país' => 'França', 'cidade' => 'Paris'),
        array('id' => 3, 'continente' => 'Ásia', 'país' => 'Japão', 'cidade' => 'Tóquio'),
        array('id' => 4, 'continente' => 'América do Sul', 'país' => 'Brasil', 'cidade' => 'Rio de Janeiro'),
        array('id' => 5, 'continente' => 'África', 'país' => 'África do Sul', 'cidade' => 'Cidade do Cabo'),
        array('id' => 6, 'continente' => 'Oceania', 'país' => 'Austrália', 'cidade' => 'Sydney'),
    );
    

    public function getAllCities() {
        return $this->data;
    }

}

?>
