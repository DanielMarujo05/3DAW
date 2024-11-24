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

// Função para adicionar ou editar viagens
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $id = $_POST['id'] ?? null;
    $partida = $_POST['partida'];
    $destino = $_POST['destino'];
    $data_partida = $_POST['data_partida'];
    $preco = $_POST['preco'];

    if ($action == 'insert') {
        $sql = "INSERT INTO viagens (Partida, Destino, DataPartida, Preco) VALUES ('$partida', '$destino', '$data_partida', '$preco')";
        if ($conn->query($sql)) {
            header("Location: crud_viagens.php");
            exit();
        } else {
            echo "Erro: " . $conn->error;
        }
    } elseif ($action == 'update' && $id) {
        $sql = "UPDATE viagens SET Partida = '$partida', Destino = '$destino', DataPartida = '$data_partida', Preco = '$preco' WHERE ID = $id";
        if ($conn->query($sql)) {
            header("Location: crud_viagens.php");
            exit();
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}

// Excluir viagem
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM viagens WHERE ID = $id";
    if ($conn->query($sql)) {
        header("Location: crud_viagens.php");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
}

// Obter todas as viagens
$sql = "SELECT * FROM viagens";
$result = $conn->query($sql);

// Se existir um ID para editar, obtemos os dados da viagem
$viagem = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM viagens WHERE ID = $id";
    $result_edit = $conn->query($sql);
    $viagem = $result_edit->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administração de Viagens</title>
    <style>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Administração de Viagens</h1>

<!-- Formulário para adicionar ou editar viagem -->
<h2><?php echo $viagem ? 'Editar Viagem' : 'Adicionar Nova Viagem'; ?></h2>
<form action="crud_viagens.php" method="post">
    <input type="hidden" name="id" value="<?php echo $viagem['ID'] ?? ''; ?>">
    
    <label for="partida">Partida:</label>
    <input type="text" id="partida" name="partida" value="<?php echo $viagem['Partida'] ?? ''; ?>" required>

    <label for="destino">Destino:</label>
    <input type="text" id="destino" name="destino" value="<?php echo $viagem['Destino'] ?? ''; ?>" required>

    <label for="data_partida">Data de Partida:</label>
    <input type="date" id="data_partida" name="data_partida" value="<?php echo $viagem['DataPartida'] ?? ''; ?>" required>

    <label for="preco">Preço:</label>
    <input type="number" id="preco" name="preco" value="<?php echo $viagem['Preco'] ?? ''; ?>" required>

    <button type="submit" name="action" value="<?php echo $viagem ? 'update' : 'insert'; ?>">
        <?php echo $viagem ? 'Salvar Alterações' : 'Adicionar Viagem'; ?>
    </button>
</form>

<!-- Tabela de Viagens -->
<h2>Lista de Viagens</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Partida</th>
        <th>Destino</th>
        <th>Data de Partida</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['ID']; ?></td>
        <td><?php echo $row['Partida']; ?></td>
        <td><?php echo $row['Destino']; ?></td>
        <td><?php echo $row['DataPartida']; ?></td>
        <td><?php echo $row['Preco']; ?></td>
        <td>
            <a href="crud_viagens.php?id=<?php echo $row['ID']; ?>">Editar</a> |
            <a href="crud_viagens.php?action=delete&id=<?php echo $row['ID']; ?>" onclick="return confirm('Tem certeza que deseja excluir?');">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>

<?php
$conn->close();
?>
