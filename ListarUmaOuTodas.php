<?php
$disciplinas = [];
$buscarSigla = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $buscarSigla = $_POST["sigla"];

    // Abre o arquivo disciplinas.txt para leitura
    $arquivoDisciplinas = fopen("disciplinas.txt", "r") or die("Erro ao abrir arquivo!");

    // Percorre cada linha do arquivo
    while (($linha = fgets($arquivoDisciplinas)) !== false) {
        $dados = explode(";", trim($linha));

        // Se o campo sigla estiver vazio, lista todas as disciplinas
        if (empty($buscarSigla)) {
            $disciplinas[] = [
                'nome' => $dados[0],
                'sigla' => $dados[1],
                'carga' => $dados[2]
            ];
        } else {
            // Se uma sigla específica foi fornecida, lista apenas a disciplina com essa sigla
            if ($dados[1] == $buscarSigla) {
                $disciplinas[] = [
                    'nome' => $dados[0],
                    'sigla' => $dados[1],
                    'carga' => $dados[2]
                ];
                break; // Sai do loop, pois já encontrou a disciplina desejada
            }
        }
    }

    fclose($arquivoDisciplinas);
}
?>

<html>
<body>
  <h1>Listar Disciplinas</h1>

  <form method="POST" action="ListarUmaOuTodas.php">
    Sigla da disciplina (deixe em branco para listar todas): 
    <input type="text" name="sigla">
    <br><br>
    <input type="submit" value="Listar Disciplinas">
  </form>

  <?php if (!empty($disciplinas)): ?>
    <h2>Resultado:</h2>
    <table border="1">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Sigla</th>
          <th>Carga Horária</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($disciplinas as $disciplina): ?>
          <tr>
            <td><?php echo htmlspecialchars($disciplina['nome']); ?></td>
            <td><?php echo htmlspecialchars($disciplina['sigla']); ?></td>
            <td><?php echo htmlspecialchars($disciplina['carga']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <p style="color: red;">Nenhuma disciplina encontrada.</p>
  <?php endif; ?>
</body>
</html>
