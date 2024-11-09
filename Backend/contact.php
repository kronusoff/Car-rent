<?php
// Подключение к базе данных PostgreSQL
$host = "localhost";
$dbname = "car_rental";
$user = "postgres";
$password = "1234d"; // Укажите ваш пароль

try {
    // Создаем подключение
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Проверка, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получаем данные из формы
        $email = $_POST["email"] ?? '';
        $name = $_POST["name"] ?? '';
        $phone = $_POST["phone"] ?? '';
        $message = $_POST["message"] ?? '';

        // Проверяем, что все поля заполнены
        if (empty($email) || empty($name) || empty($phone) || empty($message)) {
            echo "Пожалуйста, заполните все поля.";
            exit;
        }

        // Добавление данных в таблицу контактов
        $sql = "INSERT INTO contacts (email, name, phone, message) VALUES (:email, :name, :phone, :message)";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute([
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'message' => $message
        ]);

        echo "Спасибо, ваше сообщение отправлено!";
    }
} catch (PDOException $e) {
    echo "Ошибка: " . $e->getMessage();
}
?>
