<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idPerg = $_POST["IdPerg"];
    $titulo = $_POST["titulo"];
    $resp1 = $_POST["resp1"];
    $resp2 = $_POST["resp2"];
    $resp3 = $_POST["resp3"];
    $resp4 = $_POST["resp4"];
    $opcaoCerta = $_POST["opcaoCerta"];

    $perguntaNova = "$idPerg;$titulo;$resp1;$resp2;$resp3;$resp4;$opcaoCerta\n";

    if (!file_exists("Perguntas.txt")) {
        die("Arquivo não encontrado!");
    }

    $linhas = file("Perguntas.txt");
    $linhaAlterada = false;

    foreach ($linhas as $key => $linha) {
        $exp = explode(";", $linha);
        if (isset($exp[0]) && $exp[0] == $idPerg) {
            $linhas[$key] = $perguntaNova;
            $linhaAlterada = true;
            break;
        }
    }

    if ($linhaAlterada) {
        file_put_contents("Perguntas.txt", implode("", $linhas));
        echo "<h1>Alterações salvas com sucesso!</h1>";
    } else {
        echo "<h1>Nenhuma pergunta encontrada para editar.</h1>";
    }
}
?>
