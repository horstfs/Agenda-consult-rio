<!DOCTYPE html>
<html>
<head>
    <title>Consultas Agendadas</title>
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
    <h1>Consultas Agendadas</h1>

    <table>
        <tr>
            <th>Data</th>
            <th>Hora</th>
            <th>Dentista</th>
            <th>Cliente</th>
        </tr>

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

        // Consulta para obter as consultas agendadas em ordem decrescente por data
        $sql = "SELECT a.data_agendamento, a.hora_agendamento, a.dentista, c.nome as cliente_nome 
                FROM agendamentos a
                INNER JOIN clientes c ON a.cliente_id = c.id
                ORDER BY a.data_agendamento DESC"; // Ordenar por data em ordem decrescente
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['data_agendamento'] . "</td>";
                echo "<td>" . $row['hora_agendamento'] . "</td>";
                echo "<td>" . $row['dentista'] . "</td>";
                echo "<td>" . $row['cliente_nome'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhuma consulta agendada.</td></tr>";
        }

        // Fechando a conexão com o banco de dados
        $conn->close();
        ?>
    </table>
</body>
</html>
