<?php
include 'conexao.php';

// Buscar posts ordenados por mais recentes
$sql = "SELECT id, titulo, conteudo FROM posts ORDER BY id DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Blog Simples</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<h1>Blog Simples</h1>

<a href="add_post.php" class="btn-add">Adicionar Novo Post</a>

<?php
if ($result->num_rows > 0) {
    while ($post = $result->fetch_assoc()) {
        // Escapa dados para evitar XSS
        $id = (int)$post['id'];
        $titulo = htmlspecialchars($post['titulo']);
        $conteudo = nl2br(htmlspecialchars($post['conteudo']));
        echo "<div class='post'>";
        echo "<h2>$titulo</h2>";
        echo "<p>$conteudo</p>";
        echo "<a href='delete_post.php?id=$id' class='delete' onclick='return confirm(\"Tem certeza que deseja deletar este post?\");'>Deletar</a>";
        echo "</div>";
    }
} else {
    echo "<p>Nenhum post encontrado.</p>";
}
?>

</body>
</html>