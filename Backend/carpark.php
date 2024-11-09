<?php
// Подключение к базе данных
$host = 'localhost';
$db = 'car_rent';
$user = 'kronus';
$pass = '1234';

$conn = pg_connect("host=$host dbname=$db user=$user password=$pass");

if (!$conn) {
    die("Ошибка подключения: " . pg_last_error());
}

// Запрос к базе данных для получения списка автомобилей
$sql = "SELECT * FROM cars";
$result = pg_query($conn, $sql);

if (!$result) {
    die("Ошибка выполнения запроса: " . pg_last_error());
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автопарк</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container my-5">
    <div class="row">
        <?php while ($car = pg_fetch_assoc($result)): ?>
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <img src="<?php echo htmlspecialchars($car['image1']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($car['make'] . ' ' . $car['model']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($car['make'] . ' ' . $car['model'] . ' ' . $car['year']); ?></h5>
                        <p class="card-text"><?php echo htmlspecialchars($car['description']); ?></p>
                        <a href="car.php?id=<?php echo $car['id']; ?>" class="btn btn-primary">Подробнее</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
pg_close($conn);
?>
