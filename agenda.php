


<!DOCTYPE html>
<html>
<head>
    <title>Agenda de Consultas</title>
    <link rel="stylesheet" type="text/css" href="style.css"> <!-- Link para o arquivo de estilos CSS -->
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
    <h1>Agenda de Consultas</h1>
    
    <!-- Div para conter o calendário -->
    <div id="calendario"></div>

    <!-- Adicione um script para carregar e exibir o calendário -->
    <script src="agenda.js"></script>


    
    <!-- Aqui você pode exibir o calendário e os agendamentos disponíveis/ocupados. Use JavaScript para torná-lo interativo. -->
    
    <form method="post" action="processo_agendamento.php">
        <label for="data">Data:</label>
        <input type="date" name="data" required><br>

        <label for="hora">Hora:</label>
        <input type="time" name="hora" required><br>

        <label for="dentista">Dentista:</label>
        <input type="text" name="dentista" required><br>

        <label for="cliente_id">Cliente:</label>
        <select name="cliente_id" required>
            <?php
            // Conexão com o banco de dados (substitua com suas credenciais)
            $host = "localhost";
            $username = "root";
            $password = "";
            $database = "odonto_db";

            $conn = new mysqli($host, $username, $password, $database);

            if ($conn->connect_error) {
                die("Erro na conexão com o banco de dados: " . $conn->connect_error);
            }

            // Consulta para obter a lista de clientes
            $sql = "SELECT id, nome FROM clientes";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
            }
            ?>

        </select><br>

        <input type="submit" value="Agendar Consulta">
    </form>
</body>
</html>
