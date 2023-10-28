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

// Recebendo dados do formulário
$data = $_POST['data'];
$hora = $_POST['hora'];
$dentista = $_POST['dentista'];
$cliente_id = $_POST['cliente_id'];

// Validando os dados (adapte as validações conforme necessário)
if (empty($data) || empty($hora) || empty($dentista) || empty($cliente_id)) {
    echo "Por favor, preencha todos os campos obrigatórios.";
} else {
    // Inserindo o novo agendamento no banco de dados
    $sql = "INSERT INTO agendamentos (data_agendamento, hora_agendamento, dentista, cliente_id) VALUES ('$data', '$hora', '$dentista', '$cliente_id')";

    if ($conn->query($sql) === true) {
        echo "Agendamento cadastrado com sucesso!";
        header("Location: agenda.php");
    } else {
        echo "Erro ao cadastrar o agendamento: " . $conn->error;
    }
}

// Fechando a conexão com o banco de dados
$conn->close();
?>
