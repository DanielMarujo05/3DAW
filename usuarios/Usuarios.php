<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];


    if (!file_exists("usuarios.txt")) {

        $arqUsuario = fopen("usuarios.txt", "w") or die("Erro ao criar arquivo");
        $linha = "nome;email;senha\n";
        fwrite($arqUsuario, $linha);
        fclose($arqUsuario);
    }


    $arqUsuario = fopen("usuarios.txt", "a") or die("Erro ao abrir arquivo");
    $linha = $nome . ";" . $email . ";" . $senha . "\n";
    fwrite($arqUsuario, $linha);
    fclose($arqUsuario);

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Usuario Criado</title>
</head>
<body>

    <h1> Novo Usuário Criado com Sucesso!</h1>
    
</body>
</html>