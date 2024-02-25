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
$typeFilter = isset($_GET['ptype']) ? $_GET['ptype'] : null;

$minPrice = isset($_GET['minprice']) ? $_GET['minprice'] : 0;
$maxPrice = isset($_GET['maxprice']) ? $_GET['maxprice'] : 100000;

$brands = isset($_GET['brands']) ? $_GET['brands'] : null;
$gender = isset($_GET['gender']) ? $_GET['gender'] : null;

$orderby = isset($_GET['orderby']) ? $_GET['orderby'] : "abc_asc";

$search = isset($_GET['search']) ? $_GET['search'] : null;

$sql = "SELECT product_id, name, thumbnail, price, url, gender, brand, brand_friendly, strength, ptype FROM products";

$wused = false;

// Ha meg van adva árparaméter, akkor szűrjük az áron
if ($typeFilter !== null) {
    $sql .= " WHERE ptype = '$typeFilter'";
    $wused = true;
}

if ($minPrice !== null && $maxPrice !== null) {
  if ($wused == true) {
    $sql .= " AND ";
  }

  if ($wused == false) {
    $sql .= " WHERE ";
    $wused = true;
  }

  $sql .= "price BETWEEN $minPrice AND $maxPrice";
}

if (!empty($brands)) {
  $brandList = implode("','", $brands);
  
  if ($wused) {
      $sql .= " AND ";
  } else {
      $sql .= " WHERE ";
      $wused = true;
  }

  $sql .= "brand_friendly IN ('$brandList')";
}

if (!empty($gender)) {
  $genderList = implode("','", $gender);
  
  if ($wused) {
      $sql .= " AND ";
  } else {
      $sql .= " WHERE ";
      $wused = true;
  }

  $sql .= "gender IN ('$genderList')";
}

if (!empty($search)) {
  if ($wused) {
      $sql .= " AND ";
  } else {
      $sql .= " WHERE ";
      $wused = true;
  }

  $sql .= "searchname LIKE '%$search%'";
}

if ($orderby == "abc_asc") {
  $sql .= " ORDER BY name ASC";
} elseif ($orderby == "abc_desc") {
  $sql .= " ORDER BY name DESC";
} elseif ($orderby == "price_asc") {
  $sql .= " ORDER BY price ASC";
} elseif ($orderby == "price_desc") {
  $sql .= " ORDER BY price DESC";
}




$result = $conn->query($sql);
?>



<!doctype html>
<html lang="hu">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/x-icon" href="favicon.ico">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link href="https://fonts.cdnfonts.com/css/florentia" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300&family=Noto+Sans+Indic+Siyaq+Numbers&family=Roboto+Slab:wght@300&display=swap"
    rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

<script src="https://kit.fontawesome.com/8cd5027783.js" crossorigin="anonymous"></script>
<script src="shopSystem.js"></script>


  <title>3minus Webshop</title>
</head>

<body onload="updateVal(); loadCart()">

  <div>
    <div class="row header">
      <div class="col-lg-3">
        <img src="src/logo.png" alt="" class="logo">
      </div>
      <div class="col-lg-9 nav-center">
        <nav class="navbar navbar-expand-lg navbar-dark nav-design nav-custom">
          <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="index.html">Kezdőlap</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Parfümök</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Parfümolajok</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Szettek</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Minták</a>
                </li>
              </ul>

              <ul class="navbar-nav ml-auto">
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link text-white" href="cart.html"><i class="fas fa-shopping-cart navcart"></i></a>
                </li>
            </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <section>
      <div class="content-area">
        <div class="content-area-inner">
          <div class="row">
            <div class="col-lg-3 sidebar">

                <form id="filterform" name="filterform">
                  <div class="price-input-container">
                    <p class="p-sidebar">Ár (Ft)</p>
                    <hr class='hr-sidebar'>
                    <div class="price-input">
                        <div class="price-field">
                            <div id="input-center">
                              <?php 
                                echo "<input type='number' class='min-input' value='$minPrice' id='min-price' name='minprice'><p>  -  </p>";
                                echo "<input type='number' class='max-input' value='$maxPrice' id='max-price' name='maxprice'>";
                              ?>
<!--                               <input type="number"
                                     class="min-input"
                                     value="<>"
                                     id="min-price"
                                     name="minprice"
                                     > -->
                              <!-- <p>  -  </p>
                              <input type="number"
                                     class="max-input"
                                     value="100000"
                                     id="max-price"
                                     name="maxprice"
                                     > -->
                            </div>
                        </div>
                    </div>
                    <div class="slider-container">
                        <div class="price-slider">
                        </div>
                    </div>

                  </div>

          
            <!-- Slider -->
            <div class="range-input"> 
              <?php
                echo "<input type='range' class='min-range' min='0' max='99500' value='$minPrice' step='100' onchange='filterProducts()'>";
                echo "<input type='range' class='max-range' min='500' max='100000' value='$maxPrice' step='100' onchange='filterProducts()'>";
              ?>

            </div> 



            

            <p class='p-sidebar'>Nem</p>
            <hr class='hr-sidebar'>
            <?php
              if (!empty($gender) && in_array("male", $gender))
              {
                echo "<input type='checkbox' id='male' name='gender[]' value='male' checked>";
                echo "<label for='male'> Férfi</label><br>";
              } else {
                echo "<input type='checkbox' id='male' name='gender[]' value='male'>";
                echo "<label for='male'> Férfi</label><br>";
              };

              if (!empty($gender) && in_array("female", $gender))
              {
                echo "<input type='checkbox' id='female' name='gender[]' value='female' checked>";
                echo "<label for='female'> Női</label>";
              } else {
                echo "<input type='checkbox' id='female' name='gender[]' value='female'>";
                echo "<label for='female'> Női</label>";
              };
              
              echo "<p class='p-sidebar'>Márka</p><hr class='hr-sidebar'>";

              if (!empty($brands) && in_array("disney", $brands))
              {
                echo "<input type='checkbox' id='disney' name='brands[]' value='disney' checked>";
                echo "<label for='disney'> Disney</label><br>";
              } else {
                echo "<input type='checkbox' id='disney' name='brands[]' value='disney'>";
                echo "<label for='disney'> Disney</label><br>";
              }

              if (!empty($brands) && in_array("marvel", $brands))
              {
                echo "<input type='checkbox' id='marvel' name='brands[]' value='marvel' checked>";
                echo "<label for='marvel'> Marvel</label><br>";
              } else {
                echo "<input type='checkbox' id='marvel' name='brands[]' value='marvel'>";
                echo "<label for='marvel'> Marvel</label><br>";
              }

              if (!empty($brands) && in_array("air_val", $brands))
              {
                echo "<input type='checkbox' id='air_val' name='brands[]' value='air_val' checked>";
                echo "<label for='air_val'> Air Val</label><br>";
              } else {
                echo "<input type='checkbox' id='air_val' name='brands[]' value='air_val'>";
                echo "<label for='air_val'> Air Val</label><br>";
              }

              
            
            ?>
            <input type="submit" value="Szűrés" id="filterButton" class="cartbtn submitbtn"><br>
                
                <select name="orderby" id="orderby" hidden>
                  <option value="abc_asc">ABC szerint (növekvő)</option>
                  <option value="abc_desc">ABC szerint (csökkenő)</option>
                  <option value="price_asc">Ár szerint (növekvő)</option>
                  <option value="price_desc">Ár szerint (csökkenő)</option>
                </select>
            </form>
            </div>
            <div class="col-lg-9">
              
                <select name="orderby_select" id="orderby_select" onchange = "submitFilterForm()" class="form-select">
                  <option value="abc_asc">ABC szerint (növekvő)</option>
                  <option value="abc_desc">ABC szerint (csökkenő)</option>
                  <option value="price_asc">Ár szerint (növekvő)</option>
                  <option value="price_desc">Ár szerint (csökkenő)</option>
                </select>
                <?php 
                echo "<script defer>";
                echo "var select = document.getElementById('orderby_select');";
                echo "select.value = '$orderby';";
                echo "var select_fake = document.getElementById('orderby');";
                echo "select_fake.value = select.value;";
                echo "</script>";
                ?>
              <div class="products" id="products">
              <?php
              // Ellenőrizd az eredményeket
    if ($result->num_rows > 0) {
        // Az árparaméter alapján szűrt termékek megjelenítése kártyák formájában
        while($row = $result->fetch_assoc()) {
            echo '<div class="product-card">';
            echo '<a href="product_page.php?id=' . $row["product_id"] .'"><div class="pr-img-container"><img src="' . $row["thumbnail"] . '" alt="' . $row["name"] . '"></div></a>';
            echo '<p class="pr-brand-name">'. $row["brand"] .'</p>';
            echo '<div class="pr-text-container"><a href="product_page.php?id=' . $row["product_id"] .'"><h3>' . $row["name"] . '</h3></a></div>';
            echo '<div class="pr-button-container"><p>' . $row["price"] . ' Ft</p>';
            echo '<button class="cartbtn" onclick="addToCart(' . $row["product_id"] . ', 1)">Kosárba</button></div>';
            echo '</div>';
        }
    } else {
        echo "<p class='message'>Nem található a paramétereknek megfelelő termék.</p>";
    }

// Adatbázis kapcsolat lezárása
$conn->close();
?>
              </div>
            </div>
          </div>

                  
          
        </div>
        


        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>


      </div>



    </section>
    <br><br><br><br><br><br><br><br><br><br><br><br>

  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
    <script src="ui.js"></script>

    
    <div id="snackbar">A termék a kosárba került!</div>



</body>


</html>

