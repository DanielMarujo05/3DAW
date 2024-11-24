<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Compra</title>
</head>
<body>

<div class="container">
    <h1>Confirmação de Compra</h1>

    <?php if (isset($_GET['compra']) && $_GET['compra'] == 'sucesso'): ?>
        <p>Obrigado pela sua compra! Sua viagem foi confirmada.</p>
    <?php else: ?>
        <p>Ocorreu um erro. Tente novamente mais tarde.</p>
    <?php endif; ?>
</div>

</body>
</html>
