<?php
$animal_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM medical_records WHERE animal_id = ?");
$stmt->execute([$animal_id]);
$records = $stmt->fetchAll();

$animal = null;
if ($animal_id) {
    $stmt2 = $pdo->prepare("SELECT * FROM animals WHERE id = ?");
    $stmt2->execute([$animal_id]);
    $animal = $stmt2->fetch();
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Медицинские записи</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h1>🏥 Медицинские записи</h1>
    <?php if ($animal): ?>
        <h2><?= htmlspecialchars($animal['name']) ?></h2>
    <?php endif; ?>
    
    <table>
        <tr><th>Дата</th><th>Диагноз</th><th>Лекарство</th></tr>
        <?php if (empty($records)): ?>
            <tr><td colspan="3">Нет медицинских записей</td></tr>
        <?php else: ?>
            <?php foreach ($records as $record): ?>
                <tr>
                    <td><?= $record['record_date'] ?></td>
                    <td><?= htmlspecialchars($record['diagnosis']) ?></td>
                    <td><?= htmlspecialchars($record['medicine']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
    <p><a href="?page=animals">← Назад</a></p>
</body>
</html>
