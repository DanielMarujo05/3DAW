<?php
// Abre o arquivo de disciplinas e cria um arquivo temporário para a alteração
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
  <h1>Alterar os dados de uma disciplina</h1>
  <?php
  $sigla = "";
  $n_sigla = "";
  $nome = "";
  $carga = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $sigla = $_POST["sigla"];
      $n_sigla = $_POST["n_sigla"];
      $nome = $_POST["nome"];
      $carga = $_POST["carga"];

      // Abre os arquivos para leitura e escrita
      $Disciplinas = fopen("disciplinas.txt", "w+") or die("Erro ao abrir arquivo!");
      $temp = fopen("temp.txt", "r") or die("Erro ao ler arquivo temporário!");

      $c = explode(";", fgets($temp)); // Lê a primeira linha do arquivo temporário
      while (!feof($temp)) {
          // Verifica se a sigla da disciplina corresponde à sigla a ser alterada
          if ($c[1] == $sigla) {
              // Se todos os campos foram preenchidos, altera a disciplina
              if (!($nome == "") && !($n_sigla == "") && !($carga == "")) {
                  $linha = $nome . ";" . $n_sigla . ";" . $carga . "\n";
                  fwrite($Disciplinas, $linha); // Escreve a nova linha no arquivo original
              }
          } else {
              // Caso contrário, reescreve a linha original
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

  <center><h2 style="color:green;">Os dados da disciplina foram alterados com sucesso!</h2></center>
  <p><a href="index.html">⇐ Retornar</a></p>
</body>
</html>
