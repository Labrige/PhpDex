//<?php
// Conexão com o banco de dados
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "phpdex";
//$conn = new mysqli($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
//    die("Falha na conexão: " . $conn->connect_error);
//}

// Obtenção dos dados da API
//$url = "https://pokeapi.co/api/v2/pokemon"; // Substitua pela URL da sua API
//$response = file_get_contents($url);
//$data = json_decode($response, true);

// Importação dos dados para o banco de dados
//foreach ($data as $pokemon) {
//    $numeroDex = $pokemon['id']; // Substitua pelos nomes reais das colunas
//    $nome = $pokemon['name'];
//    $tipo = $pokemon['types'][0]['type']['name'];
//    $habilidades = [];
//    foreach ($pokemon['abilities'] as $ability) {
//        $habilidades[] = $ability['ability']['name'];
//    }
//    $habilidades = implode(", ", $habilidades);
//    $sprite = $pokemon['sprites']['front_default'];
    // ...
    
//    $query = "INSERT INTO pokemons (numero_dex, nome, tipo, habilidades, sprite) VALUES ('$numeroDex', '$nome', '$tipo', '$habilidades', '$sprite')";  // Substitua pela sua tabela e colunas reais
//    if ($conn->query($query) === true) {
//        echo "Dados importados com sucesso.";
//    } else {
//        echo "Erro ao importar dados: " . $conn->error;
//    }
//}

//$conn->close();




// Conexão com o banco de dados
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "phpdex";
//$conn = new mysqli($servername, $username, $password, $dbname);
//if ($conn->connect_error) {
//    die("Falha na conexão: " . $conn->connect_error);
//}

// Obtenção dos dados da API
//while (!$allPokemonsImported) {
//   $url = "https://pokeapi.co/api/v2/pokemon?offset=" . (($currentPage - 1) * 20) . "&limit=20";// URL para listar todos os pokémons
//    $response = file_get_contents($url);
//    $pokemonData = json_decode($response, true);

    // Importação dos dados para o banco de dados

//    foreach ($pokemonData['results'] as $pokemon) {
//        $pokemonUrl = $pokemon['url'];
//        $pokemonResponse = file_get_contents($pokemonUrl);
//        $pokemonDetails = json_decode($pokemonResponse, true);

//        $numeroDex = $pokemonDetails['id']; // Substitua pelos nomes reais das colunas
//        $nome = $pokemonDetails['name'];
//        $tipo = $pokemonDetails['types'][0]['type']['name'];
//        $habilidades = [];
//        foreach ($pokemonDetails['abilities'] as $ability) {
//            $habilidades[] = $ability['ability']['name'];
//        }
//        $habilidades = implode(", ", $habilidades);
//        $sprite = $pokemonDetails['sprites']['front_default'];
        // ...
        
//        $query = "INSERT INTO pokemons (numeroDex, nome, tipo, habilidades, sprite) VALUES ('$numeroDex', '$nome', '$tipo', '$habilidades', '$sprite')";  // Substitua pela sua tabela e colunas reais
//        if ($conn->query($query) === true) {
//            echo "Dados importados com sucesso.";
//        } else {
//            echo "Erro ao importar dados: " . $conn->error;
//        }
//    }
//}

//   $currentPage++;
//    if ($currentPage > $pokemonData['count'] / 20) {
//        $allPokemonsImported = true;
//    }

//$conn->close();

//?>



<?php
// Conexão com o banco de dados
ini_set("max_execution_time","999999999");
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "phpdex";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Importação dos dados para o banco de dados
$currentPage = 1;
$allPokemonsImported = false;

while (!$allPokemonsImported) {
    // Obtenção dos dados da API
    $url = "https://pokeapi.co/api/v2/pokemon?offset=" . (($currentPage - 1) * 20) . "&limit=20";
    $response = file_get_contents($url);
    $pokemonData = json_decode($response, true);

    foreach ($pokemonData['results'] as $pokemon) {
        $pokemonUrl = $pokemon['url'];
        $pokemonResponse = file_get_contents($pokemonUrl);
        $pokemonDetails = json_decode($pokemonResponse, true);

        $numeroDex = $pokemonDetails['id']; // Substitua pelos nomes reais das colunas
        $nome = $pokemonDetails['name'];
        $tipo = $pokemonDetails['types'][0]['type']['name'];
        $habilidades = [];
        foreach ($pokemonDetails['abilities'] as $ability) {
            $habilidades[] = $ability['ability']['name'];
        }
        $habilidades = implode(", ", $habilidades);
        $sprite = $pokemonDetails['sprites']['front_default'];
        // ...
        
        $query = "INSERT INTO pokemons (numeroDex, nome, tipo, habilidades, sprite) VALUES ('$numeroDex', '$nome', '$tipo', '$habilidades', '$sprite')";  // Substitua pela sua tabela e colunas reais
        if ($conn->query($query) === true) {
            echo "Dados importados com sucesso.";
        } else {
            echo "Erro ao importar dados: " . $conn->error;
        }
    }

    $currentPage++;
    if ($currentPage > $pokemonData['count'] / 20) {
        $allPokemonsImported = true;
    }
}

$conn->close();
?>