<?php 

$servername = "localhost";
$username = "...";
$password = "";
$dbname = "...";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$departure = isset($_POST["departure"]) ? $_POST["departure"] : '';
$delivery = isset($_POST["delivery"]) ? $_POST["delivery"] : '';
$weight = isset($_POST["weight"]) ? $_POST["weight"] : '';
$volume = isset($_POST["volume"]) ? $_POST["volume"] : '';
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$surname = isset($_POST["surname"]) ? $_POST["surname"] : '';
$tel = isset($_POST["tel"]) ? $_POST["tel"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$message = isset($_POST["message"]) ? $_POST["message"] : '';

$okMessage = 'Your order has been submitted successfully: Thank you, we\'ll get back to you soon.';
$errorMessage = 'There was an error while submitting the order form. Please try again a bit later.';

$sql = "INSERT INTO order_table (departure, delivery, weight, volume, name, surname, tel, email, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt) {

    $stmt->bind_param("sssssssss", $departure, $delivery, $weight, $volume, $name, $surname, $tel, $email, $message);

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

header("refresh:5; url=../order.html");
?>