<?php include 'db.php'; ?>

<?php
$result = $db->query('SELECT * FROM links ORDER BY id DESC');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel de Imagens</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Imagens extráidas dos links:</h1>
    <button onclick="window.location.href='admin.php'">Ir para página admin</button>
</header>

<main>

    <div class="galeria">
        <?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <div class="card">
                <a href="<?= htmlspecialchars($row['url']) ?>" target="_blank">
                    <img src="proxy.php?url=<?= urlencode('https://www.instagram.com/p/' . explode('/', $row['url'])[4] . '/media/?size=l') ?>" 
                         width="100%" 
                         height="125%" 
                         alt="Imagem do projeto <?= htmlspecialchars($row['nome']) ?>">
                </a>
                <p><?= htmlspecialchars($row['nome']) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</main>
</body>
</html>




