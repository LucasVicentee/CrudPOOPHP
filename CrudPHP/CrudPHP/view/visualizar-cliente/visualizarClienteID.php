<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="visualizar.css" rel="stylesheet">
    <title>Buscar cliente por ID</title>
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
        <form method="POST" action="">
            <h2>Informe o ID do cliente</h2>
            <input type="text" id="id" name="id" placeholder="ID do cliente"><br><br>
            <button type="submit">Buscar Cliente</button>
        </form> 

        <?php 
            require_once "../../Database.php";

            $localHost = 'localhost';
            $nomeBD = 'banco_sistema';
            $user = 'root';
            $senha = '';

            $db = new Database($localHost, $nomeBD, $user, $senha);
            $conexaoBD = $db->getConnection();

            $dbClientes = new DBClientes($conexaoBD);

            if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id'])){
                $idCliente = $_POST['id'];

                $cliente = $dbClientes->recoveryById($idCliente);

                if($cliente){
                    echo "<h2>Dados do cliente</h2>";
                    echo "<p>ID: " . $cliente['id'] . " - Nome: " . $cliente['nome'] . " - CPF: " . $cliente['cpf'] . " - Email: " . $cliente['email'] . "</p>"; 
                } else {
                    echo "Erro ao exibir dados do cliente ID: " . $idCliente;
                }
            }
        ?>
    </div>
</body>
</html>
