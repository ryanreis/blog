<?php
include 'conexao.php';

$titulo = $conteudo = "";
$erro = "";

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
            header("Location: index.php");
            exit();
        } else {
            $erro = "Erro ao preparar a consulta.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Adicionar Post</title>
<link rel="stylesheet" href="style.css" />
</head>
<body>

<h1>Adicionar Novo Post</h1>

<?php if ($erro): ?>
<p class="error"><?=htmlspecialchars($erro)?></p>
<?php endif; ?>

<form method="post" action="add_post.php">
    <input type="text" name="titulo" placeholder="Título" value="<?=htmlspecialchars($titulo)?>" required />
    <textarea name="conteudo" placeholder="Conteúdo" rows="6" required><?=htmlspecialchars($conteudo)?></textarea>
    <button type="submit">Salvar Post</button>
</form>

<a href="index.php">Voltar ao Blog</a>

</body>
</html>