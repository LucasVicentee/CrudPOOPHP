<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="atualizar.css" rel="stylesheet">
    <title>Atualizar Cliente</title>
</head>
<body>

    <nav id="sidebar">
        <h2>Menu</h2>
        <ul>
            <li><a href="../inserir-cliente/form_inserir.php">Cadastrar Cliente</a></li>
            <li><a href="../visualizar-cliente/visualizarTodos.php">Buscar Todos os Clientes</a></li>
            <li><a href="../visualizar-cliente/visualizarClienteNome.php">Buscar Cliente por Nome</a></li>
            <li><a href="../visualizar-cliente/visualizarClienteID.php">Buscar Cliente por ID</a></li>
            <li><a href="atualizarDados.php">Atualizar Dados Cliente</a></li>
            <li><a href="../deletarDados/deletarDados.php">Deletar Cliente</a></li>
        </ul>
    </nav>

    <div class="container">
        <form method="POST" action="" class="form-atualizar">
            <h2>Informe o ID do cliente para atualizar os seguintes dados</h2>
            <input type="text" id="id" name="id" placeholder="ID do cliente" class="input-field" required><br>
            <input type="text" id="nome" name="nome" placeholder="Nome" class="input-field" required><br>
            <input type="text" id="cpf" name="cpf" placeholder="CPF" class="input-field" required><br>
            <input type="email" id="email" name="email" placeholder="E-mail" class="input-field" required><br><br>
            <button type="submit" class="submit-btn">Atualizar Dados</button>
        </form>

        <?php 
        require_once "../../Database.php";

        $localHost = 'localhost';
        $dbName = 'banco_sistema';
        $usuario = 'root';
        $senha = '';

        $banco = new Database($localHost, $dbName, $usuario, $senha);
        $conexao = $banco->getConnection();

        $dbCliente = new DBClientes($conexao);

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['id']) && !empty($_POST['nome']) && !empty($_POST['cpf']) && !empty($_POST['email'])) {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $email = $_POST['email'];

            if ($dbCliente->update($id, $nome, $cpf, $email)) {
                echo "<p>Dados do cliente atualizados com sucesso.</p>";
            } else {
                echo "<p>Erro ao atualizar dados do cliente.</p>";
            }
        }
        ?>
    </div>
</body>
</html>
