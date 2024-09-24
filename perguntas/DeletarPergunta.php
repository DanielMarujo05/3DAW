<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $IdPergDeletar = $_POST["IdPergDeletar"];

    if (!file_exists("Perguntas.txt")) {
        echo "Arquivo não encontrado!";
    } else {
        // Lê todas as perguntas
        $arqPerg = fopen("Perguntas.txt", "r");
        $perguntas = [];

        while (($linha = fgets($arqPerg)) !== false) {
            $perguntas[] = $linha;
        }
        fclose($arqPerg);

        $novasPerguntas = [];
        $deletado = false;

        foreach ($perguntas as $linha) {
            $exp = explode(";", $linha);
            if (isset($exp[0]) && is_numeric($exp[0]) && intval($exp[0]) == $IdPergDeletar) {
                $deletado = true; // Marca que a pergunta foi encontrada e deletada
            } else {
                $novasPerguntas[] = $linha; // Mantém a pergunta na nova lista
            }
        }

        // Reabre o arquivo para escrita
        $arqPerg = fopen("Perguntas.txt", "w");
        foreach ($novasPerguntas as $novaLinha) {
            fwrite($arqPerg, $novaLinha);
        }
        fclose($arqPerg);

        echo $deletado ? "Pergunta com ID $IdPergDeletar deletada com sucesso!" : "Pergunta com ID $IdPergDeletar não encontrada.";
    }
}
?>
