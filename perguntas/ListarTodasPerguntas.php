<?php

    $perguntas = [];

    if (!file_exists("Perguntas.txt")) {
        $mensagem = "Arquivo não encontrado!";
    } else {
        $arqPerg = fopen("Perguntas.txt", "r") or        die("Erro ao abrir arquivo");

        while (($linhaAux = fgets($arqPerg)) !==         false) {
            $perguntas[] = ($linhaAux); 
        }
        fclose($arqPerg);
    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Perguntas Encontradas</title>
</head>
<body>
    <h1>Perguntas Disponíveis!</h1>
    <h2>Lista de Perguntas:</h2>
    <ul>
        <?php
        echo !empty($perguntas) ? implode('', array_map(fn($pergunta) => '<li>' . htmlspecialchars($pergunta) . '</li>', $perguntas)) : '<li>' . htmlspecialchars(isset($mensagem) ? $mensagem : 'Nenhuma pergunta encontrada.') . '</li>';
        ?>
    </ul>
</body>
</html>
