<?php
$animal_id = $_GET['id'] ?? 0;
$animal = null;
if ($animal_id) {
    $stmt = $pdo->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt->execute([$animal_id]);
    $animal = $stmt->fetch();
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Усыновление</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 600px; margin: 0 auto; }
        input, textarea { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <h1>🐾 Форма усыновления</h1>
    <?php if ($animal): ?>
        <p>Вы хотите усыновить: <strong><?= htmlspecialchars($animal['name']) ?></strong></p>
    <?php endif; ?>
    <form action="/?q=adoptions" method="POST">
        <input type="hidden" name="animal_id" value="<?= $animal_id ?>">
        <input type="text" name="adopter_name" placeholder="Ваше имя" required>
        <input type="tel" name="adopter_phone" placeholder="Ваш телефон" required>
        <input type="date" name="adoption_date" required>
        <button type="submit">Отправить заявку</button>
    </form>
    <p><a href="?page=animals">← Назад</a></p>
</body>
</html>
