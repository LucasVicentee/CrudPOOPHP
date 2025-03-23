<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="deletar.css" rel="stylesheet">
    <title>Deletar dados Cliente</title>
</head>
<body>

    <nav id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="../inserir-cliente/form_inserir.php">Cadastrar Cliente</a></li>
            <li><a href="../visualizar-cliente/visualizarTodos.php">Buscar Todos os Clientes</a></li>
            <li><a href="../visualizar-cliente/visualizarClienteNome.php">Buscar Cliente por Nome</a></li>
            <li><a href="../visualizar-cliente/visualizarClienteID.php">Buscar Cliente por ID</a></li>
            <li><a href="../atualizarDados-cliente/atualizarDados.php">Atualizar Dados Cliente</a></li>
            <li><a href="deletarDados.php">Deletar Cliente</a></li>
        </ul>
    </nav>

    <div class="container">
        <h2>Deletar dados do cliente</h2>
        <form method="POST" action="">
            <h3>Informe o ID do cliente</h3>
            <input type="text" id="id" name="id" placeholder="ID do cliente" required>
            <button type="submit">Apagar</button>
        </form>

        <?php 
        require_once "../../Database.php";

        $localHost = 'localhost';
        $dbName = 'banco_sistema';
        $usuario = 'root';
        $senha = '';

        $db = new Database($localHost, $dbName, $usuario, $senha);
        $conexao = $db->getConnection();

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])) {
            $id = $_POST['id'];
            $dbCliente = new DBClientes($conexao);

            if ($dbCliente->delete($id)) {
                echo "<p>Dados do cliente $id deletados com sucesso.</p>";
            } else {
                echo "<p>Erro ao deletar dados do cliente.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
