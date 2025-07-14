<?php
include 'conexao.php';

$erro = "";
$titulo = "";
$conteudo = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $conteudo = trim($_POST['conteudo'] ?? '');

    if (empty($titulo) || empty($conteudo)) {
        $erro = "Por favor, preencha todos os campos.";
    } else {
        $sql = "INSERT INTO posts (titulo, conteudo) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $titulo, $conteudo);
            $stmt->execute();
            header("Location: admin.php");
            exit();
        } else {
            $erro = "Erro ao preparar a consulta.";
        }
    }
}

$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Admin Blog</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<h1>Administração do Blog</h1>

<?php if ($erro): ?>
    <p class="error"><?=htmlspecialchars($erro)?></p>
<?php endif; ?>

<form method="post" action="admin.php">
    <input type="text" name="titulo" placeholder="Título" value="<?=htmlspecialchars($titulo)?>" required />
    <textarea name="conteudo" placeholder="Conteúdo" rows="6" required><?=htmlspecialchars($conteudo)?></textarea>
    <button type="submit">Postar</button>
</form>

<h2>Postagens Existentes</h2>

<?php if ($result->num_rows > 0): ?>
    <?php while($row = $result->fetch_assoc()): ?>
        <div class="post">
            <strong><?=htmlspecialchars($row['titulo'])?></strong>
            <p><?=nl2br(htmlspecialchars($row['conteudo']))?></p>
            <a class="delete" href="delete_post.php?id=<?= (int)$row['id'] ?>" onclick="return confirm('Excluir este post?')">Excluir</a>
        </div>
    <?php endwhile; ?>
<?php else: ?>
    <p>Nenhuma postagem encontrada.</p>
<?php endif; ?>

<a href="index.php" style="display:block; margin-top:30px; text-align:center; color:#007bff;">Voltar para o blog público</a>

</body>
</html>