<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST["titulo"];
    $resposta1 = $_POST["resp1"];
    $resposta2 = $_POST["resp2"];
    $resposta3 = $_POST["resp3"];
    $resposta4 = $_POST["resp4"];
    $respostaCerta = $_POST["respCerta"];
    

    if (!file_exists("Perguntas.txt")) {
        $arqPerg = fopen("Perguntas.txt", "w") or die("Erro ao criar arquivo");
        $linha = "Id;Título;resp1;resp2;resp3;resp4;OpçãoCerta\n";
        fwrite($arqPerg, $linha);
        fclose($arqPerg);
    }

    $arqPerg = fopen("Perguntas.txt", "r") or die("Erro ao abrir arquivo");
    $Ids = [];
    
    while (($linhaAux = fgets($arqPerg)) !== false) {
        $exp = explode(";", $linhaAux);
        if (isset($exp[0]) && is_numeric($exp[0])) {
            $Ids[] = intval($exp[0]);
        }
    }
    fclose($arqPerg);

    
    $IdPergunta = 1;
    while (in_array($IdPergunta, $Ids)) {
    $IdPergunta++;
    }

    // Adiciona a nova pergunta ao arquivo
    $arqPerg = fopen("Perguntas.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $IdPergunta . ";" . $titulo . ";" . $resposta1 . ";" . $resposta2 . ";" . $resposta3 . ";" . $resposta4     . ";" . $respostaCerta . "\n";
    fwrite($arqPerg, $linha);
    fclose($arqPerg);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pergunta Criada</title>
</head>
<body>
    <h1>Pergunta Adicionada com Sucesso!</h1>
</body>
</html>