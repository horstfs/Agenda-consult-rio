<!DOCTYPE html>
<html>
<head>
    
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
        <nav>
            <ul>
                <li><a href="cliente.php">cadastro</a></li>
                <li><a href="agenda.php">Agendar Consulta</a></li>
                <li><a href="todas_consultas.php">Exibir Agendamentos</a></li>
            </ul>
        </nav>
    </header>
    <h1>Cadastro de Cliente</h1>
    <form method="post" action="processo_cadastro_cliente.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="telefone">Telefone:</label>
        <input type="text" name="telefone"><br>

        <input type="submit" value="Cadastrar Cliente">
    </form>
</body>
</html>
