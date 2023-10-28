<?php
// Receba o parâmetro "data" da URL (por exemplo, 2023-10-28)
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

// Consulta SQL para verificar se há agendamentos para a data especificada
$sql = "SELECT COUNT(*) AS total FROM agendamentos WHERE data_agendamento = '$data'";

$result = $conn->query($sql);

$response = array('agendado' => false);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if ($row['total'] > 0) {
        $response['agendado'] = true;
    }
}

header('Content-Type: application/json');
echo json_encode($response);

// Fechando a conexão com o banco de dados
$conn->close();
?>
