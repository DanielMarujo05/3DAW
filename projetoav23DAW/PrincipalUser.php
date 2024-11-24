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

// Função de busca
$viagens = [];
if (isset($_GET['buscar'])) {
    $buscar = $_GET['buscar'];
    $sql = "SELECT * FROM viagens WHERE Partida LIKE '%$buscar%' OR Destino LIKE '%$buscar%'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $viagens[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca de Viagens</title>
    <style>
        /* Estilos do layout */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        label, input, button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .viagem {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .viagem h3 {
            margin: 0;
        }
        .viagem p {
            margin: 5px 0;
        }
        .viagem a {
            color: #007bff;
            text-decoration: none;
        }
        .viagem a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Bem-vindo à Viação</h1>

    <!-- Formulário de busca -->
    <form method="GET" action="">
        <label for="buscar">Pesquisar Viagens:</label>
        <input type="text" name="buscar" id="buscar" placeholder="Digite o destino ou a partida" value="<?php echo $_GET['buscar'] ?? ''; ?>" required>
        <button type="submit">Buscar</button>
    </form>

    <!-- Exibindo resultados de viagens -->
    <?php if (isset($_GET['buscar']) && count($viagens) > 0): ?>
        <h2>Viagens Encontradas</h2>
        <?php foreach ($viagens as $viagem): ?>
            <div class="viagem">
                <h3><?php echo $viagem['Partida']; ?> → <?php echo $viagem['Destino']; ?></h3>
                <p><strong>Data de Partida:</strong> <?php echo $viagem['DataPartida']; ?></p>
                <p><strong>Preço:</strong> R$ <?php echo $viagem['Preco']; ?></p>
                <a href="comprar.php?id=<?php echo $viagem['ID']; ?>">Comprar</a>
            </div>
        <?php endforeach; ?>
    <?php elseif (isset($_GET['buscar']) && count($viagens) == 0): ?>
        <p>Nenhuma viagem encontrada para o termo: "<?php echo $_GET['buscar']; ?>"</p>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
