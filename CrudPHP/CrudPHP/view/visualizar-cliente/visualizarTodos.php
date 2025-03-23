<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="visualizar.css" rel="stylesheet">
    <title>Buscar Todos os Clientes</title>
</head>
<body>

    <nav id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="../inserir-cliente/form_inserir.php">Cadastrar Cliente</a></li>
            <li><a href="visualizarTodos.php">Buscar Todos os Clientes</a></li>
            <li><a href="visualizarClienteNome.php">Buscar Cliente por Nome</a></li>
            <li><a href="visualizarClienteID.php">Buscar Cliente por ID</a></li>
            <li><a href="../atualizarDados-cliente/atualizarDados.php">Atualizar Dados Cliente</a></li>
            <li><a href="../deletarDados/deletarDados.php">Deletar Cliente</a></li>
        </ul>
    </nav>

    <div id="listaClientes">
        <h2>Lista de Clientes</h2>
        <?php
            require_once "../../Database.php";

            $localHost = 'localhost';
            $nomeBD = 'banco_sistema';
            $user = 'root';
            $senha = '';

            $bd = new Database($localHost, $nomeBD, $user, $senha);
            $conexao = $bd->getConnection();

            $bdClientes = new DBClientes($conexao);

            $listaClientes = $bdClientes->recovery();

            if (!empty($listaClientes)) {
                echo "<ul>";
                foreach ($listaClientes as $cliente) {
                    echo "<li class='li-cli'>ID: " . $cliente['id'] . " - Nome: " . $cliente['nome'] . " - CPF: " . $cliente['cpf'] . " - Email: " . $cliente['email'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhum cliente encontrado.</p>";
            }
        ?>
    </div>
</body>
</html>
