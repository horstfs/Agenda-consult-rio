<!DOCTYPE html>
<html>
<head>
    <title>Agendamentos para o Dia</title>
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
    <style>
        
        /* Estilo para a lista de agendamentos */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        
        li {

            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
        }
        
        /* Estilo para o texto do agendamento */
        li p {
            margin: 0;
        }
        
        /* Estilo para o texto do agendamento (cliente e dentista) */
        li p {
            margin: 0;
        }
        
        /* Estilo para a mensagem de "Não há agendamentos" */
        .no-appointments {
            background-color: white;
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        </style>
    <h1>Agendamentos para o Dia</h1>
    
    <?php
    // Receba o parâmetro "data" da URL (por exemplo, 2023-01-28)
    $data = $_GET['data'];

    // Conecte-se ao banco de dados (substitua com suas credenciais)
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "odonto_db";
    $conn = new mysqli($host, $username, $password, $database);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consulta SQL para obter os agendamentos para a data especificada
    $sql = "SELECT a.*, c.nome as cliente_nome FROM agendamentos a
            LEFT JOIN clientes c ON a.cliente_id = c.id
            WHERE a.data_agendamento = '$data'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2>Agendamentos para o dia $data:</h2>";
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>Cliente: " . $row['cliente_nome'] . " - Dentista: " . $row['dentista'] ." - Data: ". $row['data_agendamento'] ." - Horario: ".$row['hora_agendamento'] ."</li>";
        }
        echo "</ul>";
    } else {
        echo "Não há agendamentos para este dia.";
    }

    // Fechando a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>
