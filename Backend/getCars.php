<?php
// Настройки подключения к базе данных PostgreSQL
$host = 'localhost';
$dbname = 'car_rental';
$user = 'postgres';
$password = '1234';

// Подключение к базе данных
try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    exit();
}

// Получение данных об автомобилях
$query = $pdo->query("SELECT * FROM cars");
$cars = $query->fetchAll(PDO::FETCH_ASSOC);

// Возвращаем данные в формате JSON
header('Content-Type: application/json');
echo json_encode($cars);
?>
