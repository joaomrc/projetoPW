<?php
class CityModel {
    private $data = array(
        array('id' => 1, 'continente' => 'América do Norte', 'país' => 'Estados Unidos', 'cidade' => 'Nova York', 'imagem' => 'imagens/novayork.jpg', 'descrição' => 'Nova Iorque, uma metrópole global nos Estados Unidos, é composta por cinco distintos distritos, cada um com sua própria personalidade. Manhattan destaca-se pelos icônicos arranha-céus e pontos turísticos como Central Park. Brooklyn é conhecido pela cena artística e atmosfera descontraída, enquanto Queens exibe uma notável diversidade étnica. O Bronx oferece atrações como o Jardim Zoológico e o Yankee Stadium. A cidade é famosa por sua arquitetura impressionante, incluindo a Estátua da Liberdade, e é um centro global de negócios, moda e gastronomia. Com um eficiente sistema de transporte público, Nova Iorque atrai visitantes e residentes com sua energia pulsante e diversidade cultural.'),
        array('id' => 2, 'continente' => 'Europa', 'país' => 'França', 'cidade' => 'Paris', 'imagem' => 'imagens/paris.jpg', 'descrição' => 'Paris, a cidade das luzes, é uma metrópole europeia que personifica a elegância e a sofisticação. Conhecida como o coração cultural da França, Paris é dividida em 20 bairros, cada um com um charme distinto. O icônico horizonte parisiense é dominado pela Torre Eiffel, símbolo inconfundível da cidade. A arquitetura parisiense encanta com edifícios históricos como a Catedral de Notre-Dame e o Louvre, lar da Mona Lisa. A margem do rio Sena oferece cenários românticos, pontes encantadoras e atrações à beira de água. Paris é reverenciada pela sua culinária de classe mundial, cafés charmosos e boutiques elegantes. Com uma atmosfera cultural rica, Paris é um destino globalmente aclamado, atraindo amantes da arte, moda e gastronomia de todo o mundo.'),
        array('id' => 3, 'continente' => 'Ásia', 'país' => 'Japão', 'cidade' => 'Tóquio', 'imagem' => 'imagens/toquio.jpg', 'descrição' => 'Tóquio, a capital vibrante do Japão, é uma metrópole futurista que harmoniza tradição e modernidade de maneira única. Composta por bairros distintos, como Shibuya, Shinjuku e Akihabara, a cidade oferece uma mistura fascinante de arranha-céus reluzentes, templos antigos e espaços urbanos movimentados. O panorama de Tóquio é adornado pela Torre de Tóquio e pelo Tokyo Skytree, proporcionando vistas panorâmicas deslumbrantes. A cultura pop japonesa floresce em Akihabara, enquanto a serenidade dos jardins tradicionais pode ser apreciada em lugares como o Palácio Imperial. A culinária local, desde sushi de alta qualidade em Tsukiji até os izakayas animados, é uma experiência gastronômica inigualável. Tóquio é um centro de inovação, tecnologia e moda, atraindo visitantes com sua combinação única de tradição e modernidade no cenário urbano pulsante.'),
        array('id' => 4, 'continente' => 'América do Sul', 'país' => 'Brasil', 'cidade' => 'Rio de Janeiro', 'imagem' => 'imagens/rio.jpg', 'descrição' => 'O Rio de Janeiro, conhecido como a Cidade Maravilhosa, é uma metrópole brasileira que cativa com sua beleza natural e energia vibrante. Com uma paisagem deslumbrante que inclui praias icônicas como Copacabana e Ipanema, montanhas imponentes como o Pão de Açúcar e a estátua do Cristo Redentor, a cidade é um espetáculo visual. Os bairros variados, como o boêmio Santa Teresa e o histórico Centro, oferecem uma rica tapeçaria cultural. O samba e o carnaval são partes intrínsecas da identidade carioca, enchendo as ruas de ritmo e celebração. A culinária local, com suas churrascarias e pratos tradicionais, reflete a diversidade cultural do Brasil. Com uma atmosfera descontraída e acolhedora, o Rio de Janeiro é um destino que combina beleza natural deslumbrante com uma vibrante cena cultural e social.',),
        array('id' => 5, 'continente' => 'África', 'país' => 'África do Sul', 'cidade' => 'Cidade do Cabo', 'imagem' => 'imagens/cabo.jpg', 'descrição' => 'A Cidade do Cabo, situada na ponta sul da África, é uma metrópole que encanta com sua beleza natural e rica herança cultural. Com a majestosa Table Mountain como pano de fundo, a cidade oferece vistas panorâmicas espetaculares. As praias douradas, como Camps Bay e Clifton, proporcionam momentos relaxantes à beira-mar, enquanto o Cabo da Boa Esperança, com suas falésias dramáticas, é um destino imperdível. A arquitetura diversificada e os bairros vibrantes, como Bo-Kaap, contam a história multicultural da cidade. A influência histórica e artística da Cidade do Cabo é evidente nos museus, galerias e eventos culturais. A gastronomia local destaca-se pela fusão de sabores africanos e europeus, oferecendo uma experiência culinária única. Com uma atmosfera descontraída e uma comunidade acolhedora, a Cidade do Cabo é um destino que combina paisagens deslumbrantes, cultura vibrante e hospitalidade calorosa.',),
        array('id' => 6, 'continente' => 'Oceania', 'país' => 'Austrália', 'cidade' => 'Sydney', 'imagem' => 'imagens/sydney.jpg', 'descrição' => 'Sydney, a deslumbrante metrópole australiana, é um espetáculo de contrastes entre modernidade e natureza exuberante. Com a icônica Sydney Opera House e a Sydney Harbour Bridge ornamentando o horizonte, a cidade oferece uma vista magnífica. As praias mundialmente famosas, como Bondi e Manly, são destinos ideais para os amantes do sol e do mar. Os bairros cosmopolitas, incluindo Darling Harbour e The Rocks, pulsam com vida, oferecendo uma variedade de experiências culturais e gastronômicas. Sydney é caracterizada pela harmonia entre o estilo de vida urbano e a serenidade dos extensos parques, como o Royal Botanic Garden. A cultura australiana é celebrada em festivais, eventos esportivos e museus, proporcionando uma experiência diversificada aos visitantes. Sydney é uma cidade onde a modernidade se encontra com a natureza, criando uma atmosfera única que atrai pessoas de todo o mundo.',),
    );
    

    public function getAllCities() {
        return $this->data;
    }

    public function adicionarComentarios($username, $cityId, $comment) {
        $db = new Database();

        $sql = "INSERT INTO comentarios (city_id, username, comment) VALUES (:cityId, :username, :comment)";
        $params = array(':cityId' => $cityId, ':username' => $username, ':comment' => $comment);

        try {
            $db->execute($sql, $params);
        } catch (PDOException $e) {
            echo 'Erro ao adicionar comentário: ' . $e->getMessage();
        }
    }

    public function getComentarios($cityId) {
        $db = new Database();
        $sql = "SELECT * FROM comentarios WHERE city_id = :cityId";
        $params = array(':cityId' => $cityId);

        try {
            $result = $db->query($sql, $params);

            return $result;
        } catch (PDOException $e) {
            echo 'Erro ao obter comentários: ' . $e->getMessage();
        }
    }
}
?>