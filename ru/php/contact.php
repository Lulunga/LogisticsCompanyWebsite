<?php

$servername = "localhost";
$username = "...";
$password = "";
$dbname = "...";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = isset($_POST["name"]) ? $_POST["name"] : '';
$surname = isset($_POST["surname"]) ? $_POST["surname"] : '';
$tel = isset($_POST["tel"]) ? $_POST["tel"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$need = isset($_POST["need"]) ? $_POST["need"] : '';
$message = isset($_POST["message"]) ? $_POST["message"] : '';

$okMessage = 'Контактная форма успешно отправлена. Благодарим Вас, мы скоро свяжемся с Вами!';
$errorMessage = 'При отправке формы произошла ошибка. Пожалуйста, повторите попытку позже';

$sql = "INSERT INTO contact_table (name, surname, tel, email, need, message) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("ssssss", $name, $surname, $tel, $email, $need, $message);

    if ($stmt->execute()) {
        echo $okMessage;
    } else {
        echo $errorMessage . ' ' . $stmt->error;
    }

    $stmt->close();
} else {
    echo $errorMessage . ' ' . $stmt->error;
}

$conn->close();

header("refresh:5; url=../contacts.html");
?>
