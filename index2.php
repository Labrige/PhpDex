<?php
$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "phpdex";

// Estabelece a conexão com o banco de dados
$conexao = mysqli_connect($servidor, $usuario, $senha, $banco);

// Verifica se houve erro na conexão
if (!$conexao) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Verifica se foi enviado um ID pelo usuário
if (isset($_GET['numeroDex'])) {
    // Obtém o ID digitado pelo usuário
    $id = $_GET['numeroDex'];

    // Consulta SQL para buscar os dados correspondentes ao ID
    $consulta = "SELECT nome, tipo, habilidades, sprite FROM pokemons WHERE numeroDex = $id";

    // Executa a consulta
    $resultado = mysqli_query($conexao, $consulta);

    // Verifica se houve erro na consulta
    if (!$resultado) {
        die("Falha na consulta: " . mysqli_error($conexao));
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>PhpDex</title>
    <link rel="stylesheet" href="style.css">
    <audio controls loop autoplay style="display:none">
        <source src=" imgs\som1.mp3" type="audio/mpeg">
        Seu navegador não suporta a reprodução de áudio.
    </audio>

</head>

<body>
    <form method="GET" action="">
        <label for="numeroDex">Digite o número da Pokédex do Pokémon:</label>
        <input type="text" name="numeroDex">
        <button type="submit">Buscar</button>
    </form>

    <?php if (isset($resultado) && mysqli_num_rows($resultado) > 0) { ?>
    <div class="container">
        <img src="imgs\img3.png" alt="Minha Imagem">

        <table class="tabela tabela1">
            <tr>
                <th></th>
            </tr>
            <?php mysqli_data_seek($resultado, 0); ?>
            <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><?php echo $linha['nome']; ?></td>
                <td><?php echo $linha['tipo']; ?></td>
            </tr>
            <?php } ?>
        </table>



        <table class="tabela tabela3">
            <tr>
                <th></th>
            </tr>
            <?php mysqli_data_seek($resultado, 0); ?>
            <?php while ($linha = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
                <td><img id="img-poke" src=" <?php echo $linha['sprite']; ?>" alt="Sprite do Pokémon"></td>
            </tr>
            <?php } ?>
        </table>
    </div>
    <?php } ?>
</body>

</html>