<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'viagens';
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter dados da viagem
if (isset($_GET['id'])) {
    $viagem_id = $_GET['id'];
    $sql = "SELECT * FROM viagens WHERE ID = $viagem_id";
    $result = $conn->query($sql);
    $viagem = $result->fetch_assoc();
}

// Verificar e processar a compra
if (isset($_POST['comprar'])) {
    $tipo_leito = $_POST['tipo_leito'];
    $sql = "INSERT INTO compras (viagem_id, tipo_leito) VALUES ('$viagem_id', '$tipo_leito')";
    if ($conn->query($sql)) {
        header("Location: confirmacao.php?compra=sucesso");
        exit();
    } else {
        $compra_erro = true;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Viagem</title>
</head>
<body>

<div class="container">
    <h1>Compra da Viagem</h1>
    <p><strong>Partida:</strong> <?php echo $viagem['Partida']; ?></p>
    <p><strong>Destino:</strong> <?php echo $viagem['Destino']; ?></p>
    <p><strong>Data de Partida:</strong> <?php echo $viagem['DataPartida']; ?></p>
    <p><strong>Preço:</strong> R$ <?php echo $viagem['Preco']; ?></p>

    <h2>Escolha o Tipo de Leito:</h2>
    <form method="POST" action="">
        <label for="tipo_leito">Tipo de Leito:</label>
        <select name="tipo_leito" id="tipo_leito" required>
            <option value="cama">Cama</option>
            <option value="poltrona">Poltrona</option>
            <option value="cama_casal">Cama Casal</option>
        </select>
        <button type="submit" name="comprar">Confirmar Compra</button>
    </form>

    <?php if (isset($compra_erro)): ?>
        <p style="color:red;">Erro na compra, tente novamente.</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
