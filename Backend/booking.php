<?php
// Подключение к базе данных PostgreSQL
$host = "localhost"; // Адрес сервера
$dbname = "car_rental"; // Имя базы данных
$user = "postgres"; // Имя пользователя
$password = "1234d"; // Пароль пользователя

try {
    // Создаем подключение к базе данных
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Проверяем, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получаем данные из формы
        $name = $_POST["user-name"];
        $phone = $_POST["user-phone"];

        // Проверяем, что все поля заполнены
        if (empty($name) || empty($phone)) {
            echo "Пожалуйста, заполните все поля формы.";
            exit;
        }

        // SQL-запрос для добавления данных в таблицу бронирований
        $sql = "INSERT INTO bookings (name, phone) VALUES (:name, :phone)";
        $stmt = $pdo->prepare($sql);
        
        // Выполняем запрос с параметрами
        $stmt->execute(['name' => $name, 'phone' => $phone]);
        
        // Сообщение об успешной отправке формы
        echo "Спасибо, ваша заявка успешно отправлена!";
    }
} catch (PDOException $e) {
    // В случае ошибки подключения к базе данных или выполнения запроса
    echo "Ошибка: " . $e->getMessage();
}
?>
