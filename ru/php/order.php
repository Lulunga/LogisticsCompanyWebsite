<?php 

$servername = "localhost";
$username = "...";
$password = "";
$dbname = "...";

// Устанавливаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем связь
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы
$departure = isset($_POST["departure"]) ? $_POST["departure"] : '';
$delivery = isset($_POST["delivery"]) ? $_POST["delivery"] : '';
$weight = isset($_POST["weight"]) ? $_POST["weight"] : '';
$volume = isset($_POST["volume"]) ? $_POST["volume"] : '';
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$surname = isset($_POST["surname"]) ? $_POST["surname"] : '';
$tel = isset($_POST["tel"]) ? $_POST["tel"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$message = isset($_POST["message"]) ? $_POST["message"] : '';

$okMessage = 'Ваш запрос успешно отправлен. Благодарим Вас, мы скоро свяжемся с Вами!';
$errorMessage = 'При отправке формы произошла ошибка. Пожалуйста, повторите попытку позже';

// Погдотавливаем SQL statement
$sql = "INSERT INTO order_table (departure, delivery, weight, volume, name, surname, tel, email, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    // Привязываем параметры
    $stmt->bind_param("sssssssss", $departure, $delivery, $weight, $volume, $name, $surname, $tel, $email, $message);

    // выполняем запрос
    if ($stmt->execute()) {
        echo $okMessage;
    } else {
        echo $errorMessage . ' ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo $errorMessage . ' ' . $stmt->error;
}

// Завершение соединения с базой данных
$conn->close();

//обновляем страницу
header("refresh:5; url=../order.html");
?>
