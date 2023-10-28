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
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

// Validando os dados (adapte as validações conforme necessário)
if (empty($nome) || empty($email)) {
    echo "Por favor, preencha todos os campos obrigatórios.";
} else {
    // Inserindo o novo cliente no banco de dados
    $sql = "INSERT INTO clientes (nome, email, telefone) VALUES ('$nome', '$email', '$telefone')";

    if ($conn->query($sql) === true) {
        echo "Cliente cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar o cliente: " . $conn->error;
    }
}

// Fechando a conexão com o banco de dados
$conn->close();
?>
