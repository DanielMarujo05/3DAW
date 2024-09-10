<?php
// Abre o arquivo de disciplinas e cria um arquivo temporário para manter as outras disciplinas
$Disciplinas = fopen("disciplinas.txt", "r") or die("Erro ao ler arquivo!");
$temp = fopen("temp.txt", "w+") or die("Erro ao criar arquivo!");

$c = explode(";", fgets($Disciplinas)); // Lê a primeira linha e divide os campos por ";"
while (!feof($Disciplinas)) {
    // Escreve a linha original no arquivo temporário
    $linha = $c[0] . ";" . $c[1] . ";" . $c[2];
    fwrite($temp, $linha . "\n");
    $c = explode(";", fgets($Disciplinas)); // Lê a próxima linha
}

fclose($temp); // Fecha o arquivo temporário
fclose($Disciplinas); // Fecha o arquivo original
?>

<html>
<body>
  <h1>Deletar os dados de uma disciplina</h1>
  <?php
    $sigla = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $sigla = $_POST["sigla"];

        // Abre os arquivos para leitura e escrita
        $Disciplinas = fopen("disciplinas.txt", "w+") or die("Erro ao abrir arquivo!");
        $temp = fopen("temp.txt", "r") or die("Erro ao ler arquivo temporário!");

        $c = explode(";", fgets($temp)); // Lê a primeira linha do arquivo temporário
        while (!feof($temp)) {
            // Verifica se a sigla da disciplina não corresponde à sigla a ser deletada
            if ($c[1] != $sigla) {
                // Escreve as disciplinas restantes no arquivo original
                $linha = $c[0] . ";" . $c[1] . ";" . $c[2];
                fwrite($Disciplinas, $linha . "\n");
            }
            $c = explode(";", fgets($temp)); // Lê a próxima linha do arquivo temporário
        }

        fclose($temp); // Fecha o arquivo temporário
        fclose($Disciplinas); // Fecha o arquivo original
        unlink("temp.txt"); // Exclui o arquivo temporário
    }
  ?>      

  <center><h2 style="color:green;">Os dados da disciplina foram deletados com sucesso!</h2></center>
  <p><a href="index.html">⇐ Retornar</a></p>
</body>
</html>
