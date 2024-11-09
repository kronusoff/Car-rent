<?php
// Подключение к базе данных
$host = 'localhost';
$dbname = 'car_rental';
$user = 'postgres';
$password = '1234';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Получаем ID автомобиля из URL-параметра
$car_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($car_id > 0) {
    // Извлекаем полную информацию об автомобиле из базы данных
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
    $stmt->execute([$car_id]);
    $car = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$car) {
        echo "Автомобиль не найден.";
        exit();
    }
} else {
    echo "Некорректный ID автомобиля.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($car['name']) . " " . htmlspecialchars($car['model']); ?></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container my-5">
    <h1 class="text-center"><?php echo htmlspecialchars($car['name']) . " " . htmlspecialchars($car['model']) . " " . htmlspecialchars($car['year']); ?></h1>
    <div class="row mt-5">
        <div class="col-md-6">
            <img src="<?php echo htmlspecialchars($car['image_url']); ?>" class="img-fluid" alt="<?php echo htmlspecialchars($car['name']); ?>">
        </div>
        <div class="col-md-6">
            <p><strong>Расход топлива:</strong> <?php echo htmlspecialchars($car['fuel_consumption']); ?></p>
            <p><strong>Объем двигателя:</strong> <?php echo htmlspecialchars($car['engine_capacity']); ?> л</p>
            <p><strong>Передачи:</strong> <?php echo htmlspecialchars($car['transmission']); ?></p>
            <p><strong>Цена за день:</strong> <?php echo htmlspecialchars($car['price_per_day']); ?> BYN</p>
            <p><strong>Описание:</strong> <?php echo nl2br(htmlspecialchars($car['description'])); ?></p>
            <a href="index.html" class="btn btn-primary mt-3">Назад к автопарку</a>
        </div>
    </div>
</div>

<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
