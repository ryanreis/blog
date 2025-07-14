<?php
include 'conexao.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "DELETE FROM posts WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
}

header("Location: index.php");
exit();
?>