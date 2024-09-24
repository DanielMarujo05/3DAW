<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdPergEdit = $_POST["IdPergEdit"];
    $perguntaEncontrada = false;

    if (!file_exists("Perguntas.txt")) {
        $mensagem = "Arquivo não encontrado!";
    } else {
        $arqPerg = fopen("Perguntas.txt", "r") or die("Erro ao abrir arquivo");
        $linhas = [];

        while (($linhaAux = fgets($arqPerg)) !== false) {
            $exp = explode(";", $linhaAux);
            if (isset($exp[0]) && is_numeric($exp[0]) && intval($exp[0]) == $IdPergEdit) {
                $perguntaEdit = $linhaAux;
                $perguntaEncontrada = true;
                break;
            }
            $linhas[] = $linhaAux; // Armazenar outras perguntas
        }
        fclose($arqPerg);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Pergunta</title>
</head>
<body>
    <h1>Editar Pergunta</h1>

    <?php if ($perguntaEncontrada): ?>
        <?php
        $expPergunta = explode(";", $perguntaEdit);
        ?>
        <form action="SalvarEdicao.php" method="POST">
            <input type="hidden" name="IdPerg" value="<?php echo htmlspecialchars($expPergunta[0]); ?>">
            Título: <input type="text" name="titulo" value="<?php echo htmlspecialchars($expPergunta[1]); ?>"                     required><br>
            Resposta 1: <input type="text" name="resp1" value="<?php echo htmlspecialchars($expPergunta[2]); ?>"                 required><br>
            Resposta 2: <input type="text" name="resp2" value="<?php echo htmlspecialchars($expPergunta[3]); ?>"                 required><br>
            Resposta 3: <input type="text" name="resp3" value="<?php echo htmlspecialchars($expPergunta[4]); ?>"                 required><br>
            Resposta 4: <input type="text" name="resp4" value="<?php echo htmlspecialchars($expPergunta[5]); ?>"                 required><br>
            Resposta Correta: <select required name="opcaoCerta">
                <option>a</option>
                <option>b</option>
                <option>c</option>
                <option>d</option>
            </select>
            <br>
            <input type="submit" value="Salvar Alterações">
        </form>
    <?php else: ?>
        <h4>Nenhuma pergunta encontrada com o ID informado.</h4>
    <?php endif; ?>
</body>
</html>
