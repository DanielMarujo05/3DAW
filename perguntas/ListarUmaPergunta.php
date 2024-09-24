<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdPerg = $_POST["IdPerg"];

    if (!file_exists("Perguntas.txt")) {
        $linha = "Arquivo nao encontrado!";
    } else {
        $arqPerg = fopen("Perguntas.txt", "r") or die("Erro ao abrir arquivo");
        $perguntaListar = null;

        while (($linhaAux = fgets($arqPerg)) !== false) {
            $exp = explode(";", $linhaAux);
            if (isset($exp[0]) && is_numeric($exp[0]) && intval($exp[0]) == $IdPerg) {
                $perguntaListar = ($linhaAux);
                break; 
            }
        }
        fclose($arqPerg);
    }
}

?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Pergunta Encontrada</title>
    </head>
    <body>
        <h1>Pergunta Desejada!</h1>
        <h2>Pergunta:</h2>
        <h4><?php echo isset($perguntaListar) ? htmlspecialchars($perguntaListar) : 'Nenhuma pergunta                 encontrada.'; ?>
        </h4>
    </body>
    </html>
