<?php

class CityModel {
    private $data = array(
        array('continente' => 'América do Norte', 'país' => 'Estados Unidos', 'cidade' => 'Nova York'),
        array('continente' => 'Europa', 'país' => 'França', 'cidade' => 'Paris'),
        array('continente' => 'Ásia', 'país' => 'Japão', 'cidade' => 'Tóquio'),
        array('continente' => 'América do Sul', 'país' => 'Brasil', 'cidade' => 'Rio de Janeiro'),
        array('continente' => 'África', 'país' => 'África do Sul', 'cidade' => 'Cidade do Cabo'),
        array('continente' => 'Oceania', 'país' => 'Austrália', 'cidade' => 'Sydney'),
    
    );

    public function getAllCities() {
        return $this->data;
    }

    // Adicione mais métodos conforme necessário para manipular dados fictícios da cidade
}

?>
