<?php
// Adatbázis kapcsolódás
$servername = "localhost";
$username = "om";
$password = "om";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Ellenőrzés a kapcsolódásra
if ($conn->connect_error) {
    die("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}


$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
$city = isset($_POST['city']) ? $_POST['city'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
$order_date = date("Y-m-d");
$ordered_products = isset($_POST['ordered_products']) ? $_POST['ordered_products'] : '';


// SQL lekérdezés az adatok beszúrásához
$sql = "INSERT INTO `orders` (`order_id`, `name`, `email`, `zipcode`, `city`, `address`, `telephone`, `comment`, `order_date`, `ordered_products`) VALUES (NULL, '$name', '$email', '$zipcode', '$city', '$address', '$telephone', '$comment', '$order_date', '$ordered_products');";

// Lekérdezés végrehajtása
if ($conn->query($sql) === TRUE) {
    // Az adatok sikeresen el lettek mentve az adatbázisba

    // Email küldése

    $order_id = $conn->insert_id;

    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // SMTP szerver címe
    $mail->SMTPAuth = true;
    $mail->Username = '3minus.perfumes@gmail.com'; // SMTP felhasználónév
    $mail->Password = 'ymvmtjhyaerecbtr'; // SMTP jelszó
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->CharSet = "UTF-8";
    $mail->Encoding = 'base64';

    $mail->setFrom('3minus.perfumes@gmail.com', '3minus');
    $mail->addAddress('farkasferdike@gmail.com', 'Címzett Név');

    $mail->isHTML(true);
    $mail->Subject = 'Rendelés megerősítése';
    $mail->Body = "Tisztelt $name!<br>Köszönjök megrendelését!<br>Rendelés azonosító: #$order_id<br><br>Megrendelt termékek azonosítói: $ordered_products<br>Szállítási adatok: $zipcode $city $address";

    if($mail->send()) {
        echo "Az adatok sikeresen el lettek mentve az adatbázisba, és emailt küldtünk a megadott címre.";
    } else {
        echo "Az adatok sikeresen el lettek mentve az adatbázisba, de probléma merült fel az email küldése során. Hiba: {$mail->ErrorInfo}";
    }

} else {
    echo "Hiba az adatok mentése során: " . $conn->error;
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>
