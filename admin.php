<?php include 'db.php'; ?>

<?php
// Adicionar link
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url']) && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $url = $_POST['url'];
    $stmt = $db->prepare('INSERT INTO links (nome, url) VALUES (:nome, :url)');
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':url', $url);
    $stmt->execute();
}

// Remover link
if (isset($_POST['remover_id'])) {
    $id = $_POST['remover_id'];
    $stmt = $db->prepare('DELETE FROM links WHERE id = :id');
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

// Buscar todos os links
$result = $db->query('SELECT * FROM links ORDER BY id DESC');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel Administrativo</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Painel Administrativo</h1>
    <button onclick="window.location.href='painel-img.php'">Ir para página pública</button>
</header>

<main>
    <section>
        <h2>Adicionar novo link</h2>
        <form method="POST">
            <input type="text" name="nome" placeholder="Nome do projeto" required>
            <input type="url" name="url" placeholder="Link do Instagram" required>
            <button type="submit">Adicionar</button>
        </form>
    </section>

    <section>
        <h2>Links cadastrados</h2>
        <table>
            <tr><th>ID</th><th>Nome</th><th>URL</th><th>Ações</th></tr>
            <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['nome']) ?></td>
                    <td><a href="<?= htmlspecialchars($row['url']) ?>" target="_blank">Ver Post</a></td>
                    <td>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="remover_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="remover">Remover</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </section>
</main>
</body>
</html>

