<?php
// car.php

// Подключение к базе данных
$host = 'localhost';
$db = 'car-rent';
$user = 'kronus';
$pass = '1234';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение ID автомобиля из URL
$car_id = intval($_GET['id']);

// Запрос к базе данных
$sql = "SELECT * FROM cars WHERE id = $car_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Получение данных автомобиля
    $car = $result->fetch_assoc();
} else {
    echo "Автомобиль не найден";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $car['make'] . ' ' . $car['model'] . ' ' . $car['year']; ?></title>
    <link rel="stylesheet" href="styles.css"> <!-- Стили (при необходимости) -->
</head>
<body>
    <div class="container">
        <h1><?php echo $car['make'] . ' ' . $car['model'] . ' ' . $car['year']; ?></h1>
        <img src="<?php echo $car['image1']; ?>" alt="<?php echo $car['make'] . ' ' . $car['model']; ?>">
        <p><strong>Описание:</strong> <?php echo $car['description']; ?></p>
        <p><strong>Расход топлива:</strong> <?php echo $car['fuel_consumption']; ?></p>
        <p><strong>Объем двигателя:</strong> <?php echo $car['engine_volume']; ?> л</p>
        <p><strong>Количество посадочных мест:</strong> <?php echo $car['seating_capacity']; ?></p>
        <p><strong>Передачи:</strong> <?php echo $car['transmission']; ?></p>
        <p><strong>Детское кресло:</strong> <?php echo $car['child_seat']; ?></p>
        <p><strong>Зарядное устройство:</strong> <?php echo $car['charger']; ?></p>
        <p><strong>Цвет:</strong> <?php echo $car['color']; ?></p>
        <p><strong>Тип:</strong> <?php echo $car['type']; ?></p>
        <img src="<?php echo $car['image2']; ?>" alt="Дополнительное фото 1">
        <img src="<?php echo $car['image3']; ?>" alt="Дополнительное фото 2">
        <a href="index.php">Назад</a>
    </div>
</body>
</html>
