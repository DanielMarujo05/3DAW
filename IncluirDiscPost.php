<?php
$msg = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $sigla = $_POST["sigla"];
    $carga = $_POST["carga"];
    
    // Verifica se o arquivo já existe
    if (!file_exists("disciplinas.txt")) {
        // Cria o arquivo e escreve o cabeçalho se não existir
        $arqDisc = fopen("disciplinas.txt", "w") or die("Erro ao criar arquivo");
        $linha = "nome;sigla;carga\n";
        fwrite($arqDisc, $linha);
        fclose($arqDisc);
    }
    
    // Adiciona a nova disciplina ao final do arquivo
    $arqDisc = fopen("disciplinas.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $nome . ";" . $sigla . ";" . $carga . "\n";
    fwrite($arqDisc, $linha);
    fclose($arqDisc);
    
    $msg = "Disciplina registrada com sucesso!";
}
?>
  
<!DOCTYPE html>
<html>
<head>
    <title>Criar Nova Disciplina</title>
</head>
<body>
<h1>Criar Nova Disciplina</h1>
<form action="index.php" method="POST">
    Nome: <input type="text" name="nome" required>
    <br><br>
    Sigla: <input type="text" name="sigla" required>
    <br><br>
    Carga Horária: <input type="text" name="carga" required>
    <br><br>
    <input type="submit" value="Criar Nova Disciplina">
</form>
<p><?php echo htmlspecialchars($msg); ?></p>
<br>
</body>
</html>
