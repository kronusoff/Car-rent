<?php
$host = 'localhost';
$db = 'car_rent';
$user = 'kronus';
$pass = '1234';

// Подключение к PostgreSQL
$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Ошибка подключения: " . pg_last_error());
} else {
    echo "Подключение успешно!";
}

// Получение ID автомобиля из URL
$car_id = intval($_GET['id']);

// Запрос к базе данных с использованием подготовленного выражения
$query = "SELECT * FROM cars WHERE id = $1";
$result = pg_query_params($conn, $query, array($car_id));

if ($result && pg_num_rows($result) > 0) {
    // Получение данных автомобиля
    $car = pg_fetch_assoc($result);
} else {
    echo "Автомобиль не найден";
    exit();
}

pg_free_result($result);
pg_close($conn);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' ' . $car['year']); ?></title>
    <link rel="stylesheet" href="/assets/mobirise/css/mbr-additional.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' ' . $car['year']); ?></h1>
        <img src="<?php echo htmlspecialchars($car['image1']); ?>" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
        <p><strong>Описание:</strong> <?php echo htmlspecialchars($car['description']); ?></p>
        <p><strong>Расход топлива:</strong> <?php echo htmlspecialchars($car['fuel_consumption']); ?></p>
        <p><strong>Объем двигателя:</strong> <?php echo htmlspecialchars($car['engine_volume']); ?> л</p>
        <p><strong>Количество посадочных мест:</strong> <?php echo htmlspecialchars($car['seating_capacity']); ?></p>
        <p><strong>Передачи:</strong> <?php echo htmlspecialchars($car['transmission']); ?></p>
        <p><strong>Детское кресло:</strong> <?php echo htmlspecialchars($car['child_seat']); ?></p>
        <p><strong>Зарядное устройство:</strong> <?php echo htmlspecialchars($car['charger']); ?></p>
        <p><strong>Цвет:</strong> <?php echo htmlspecialchars($car['color']); ?></p>
        <p><strong>Тип:</strong> <?php echo htmlspecialchars($car['type']); ?></p>
        <?php for ($i = 2; $i <= 6; $i++): ?>
            <?php if (!empty($car["image$i"])): ?>
                <img src="<?php echo htmlspecialchars($car["image$i"]); ?>" alt="Дополнительное фото <?php echo $i - 1; ?>">
            <?php endif; ?>
        <?php endfor; ?>
        <a href="index.php">Назад</a>
    </div>
</body>
</html>
