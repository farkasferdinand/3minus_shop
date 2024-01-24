<?php
// Adatbázis kapcsolat beállítása (módosítsd az adatokat a saját adatbázisodhoz)
$servername = "localhost";
$username = "om";
$password = "om";
$dbname = "webshop";

$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrizd a kapcsolatot
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Árparaméter ellenőrzése az URL-ben
$priceFilter = isset($_GET['price']) ? intval($_GET['price']) : null;

// Lekérdezés az árparaméter alapján
$sql = "SELECT product_id, name, thumbnail, price, url FROM products";

// Ha meg van adva árparaméter, akkor szűrjük az áron
if ($priceFilter !== null) {
    $sql .= " WHERE price = $priceFilter";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ár szerint szűrt Termék Kártyák</title>
    <style>
        .product-card {
            border: 1px solid #ccc;
            margin: 10px;
            padding: 10px;
            text-align: center;
        }
        .product-image {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

<?php
// Ellenőrizd az eredményeket
if ($result->num_rows > 0) {
    // Az árparaméter alapján szűrt termékek megjelenítése kártyák formájában
    while($row = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<img class="product-image" src="' . $row["thumbnail"] . '" alt="' . $row["name"] . '">';
        echo '<h3>' . $row["name"] . '</h3>';
        echo '<p>Ár: ' . $row["price"] . ' Ft</p>';
        echo '<a href="' . $row["url"] . '" target="_blank">Részletek</a>';
        echo '<button onclick="addToCart(' . $row["product_id"] . ')">Kosárba</button>';
        echo '</div>';
    }
} else {
    echo "Nincs elérhető termék a megadott áron az adatbázisban.";
}

// Adatbázis kapcsolat lezárása
$conn->close();
?>

<script>
    function addToCart(productId) {
        // Ebben a függvényben lehetne a kosárba helyezés logikáját megvalósítani
        alert("Termék hozzáadva a kosárhoz: " + productId);
    }
</script>

</body>
</html>
