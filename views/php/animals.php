<?php
// Уже подключена database.php из index.php

$filter = $_GET['species'] ?? 'all';

if ($filter == 'cat') {
    $sql = "SELECT * FROM animals WHERE species = 'кот' OR species = 'кошка'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $animals = $stmt->fetchAll();
} elseif ($filter == 'dog') {
    $sql = "SELECT * FROM animals WHERE species = 'собака'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $animals = $stmt->fetchAll();
} else {
    $sql = "SELECT * FROM animals";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $animals = $stmt->fetchAll();
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Наши животные</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #4CAF50; color: white; padding: 20px; text-align: center; }
        .header span { color: #ffd700; }
        .card { background: white; border-radius: 15px; padding: 15px; text-align: center; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        .card img { height: 200px; width: 100%; object-fit: cover; border-radius: 15px; }
        .btn { display: inline-block; padding: 8px 15px; background: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin: 5px; }
        .footer { text-align: center; padding: 20px; margin-top: 40px; background: #333; color: white; }
        .filter-buttons { display: flex; gap: 15px; justify-content: center; margin: 20px 0; }
        .filter-buttons a { padding: 10px 20px; background: #ddd; text-decoration: none; color: #333; border-radius: 5px; }
    </style>
</head>
<body>
<div class="header">
    <h1>Наши <span>животные</span></h1>
</div>

<div style="max-width:1200px; margin:0 auto; padding:20px;">
    <div class="filter-buttons">
        <a href="?page=animals&species=all">Все</a>
        <a href="?page=animals&species=cat">Кошки</a>
        <a href="?page=animals&species=dog">Собаки</a>
    </div>

    <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(280px,1fr)); gap:30px;">
        <?php foreach ($animals as $animal): ?>
            <div class="card">
                <img src="<?= htmlspecialchars($animal['photo_url']) ?>">
                <h3><?= htmlspecialchars($animal['name']) ?></h3>
                <p><?= htmlspecialchars($animal['species']) ?> • <?= $animal['age'] ?> мес.</p>
                <a href="?page=moreDetails&id=<?= $animal['id'] ?>" class="btn">Подробнее</a>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="footer">
    <p><a href="?page=foundation">На главную</a></p>
</div>
</body>
</html>
