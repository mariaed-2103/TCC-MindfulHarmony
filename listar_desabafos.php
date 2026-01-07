<?php
session_start();

// Conexão com o banco de dados (usando PDO)
$servername = "localhost";
$username = "root";
$password = "";
$database = "mindful_harmony";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Verifique se o ID do usuário está definido na sessão
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario = $_SESSION['id_usuario'];

        // Consulta para listar os desabafos do usuário específico
        $sql = "SELECT id, desabafo, data, hora FROM tb_diario WHERE id_usuario = :id_usuario";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();

        $desabafos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!empty($desabafos)) {
            foreach ($desabafos as $row) {
                $id = $row['id'];
                $desabafo = $row['desabafo'];
                $data = $row['data'];
                $hora = $row['hora'];

                echo "<li>";
                echo "<strong>Data:</strong> $data | <strong>Hora:</strong> $hora<br>";
                echo "$desabafo<br>";
                echo "</li>";
            }
        } else {
            echo "<li>Nenhum desabafo encontrado para este usuário.</li>";
        }
    } else {
        echo "<li>ID do usuário não definido na sessão. Faça login para acessar seus desabafos.</li>";
    }
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}
?>
