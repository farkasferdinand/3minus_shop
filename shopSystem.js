var cart = [];

// [ ] - Magyar változónevek átírása
// [ ] - Cleanup


function addToCart(productId) {
    cart.push(productId);
    saveCartToSession();
    snackbarAddedToCart();
    //alert("Hozzáadva");
}

function prepare() {
    // AJAX kérés küldése a PHP szkriptnek
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "product.php", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");

    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // PHP válasza
            var response = JSON.parse(xhr.responseText);
            updateProductList(response);
        }
    };

    xhr.send(JSON.stringify({ products: cart }));
}

function updateProductList(data) {
    // HTML listához adatok hozzáadása
    var productList = document.getElementById("cart");
    productList.innerHTML = '';

    for (var i = 0; i < data.length; i++) {
        var item = document.createElement("li");
        item.innerHTML = '<strong>' + data[i].name + '</strong><br>' +
                         'Ár: ' + data[i].price + ' Ft' + '<br>' +
                         '<img src="' + data[i].image_url + '" alt="Kép" class="thumbnailPr">';
        productList.appendChild(item);
    }
}

function removeDuplicates() {
    var cart = document.getElementById("cart");
    var items = cart.getElementsByTagName("li");
    var uniqueItems = [];

    for (var i = 0; i < items.length; i++) {
        var currentItem = items[i].innerHTML;

        if (uniqueItems.indexOf(currentItem) === -1) {
            uniqueItems.push(currentItem);
        } else {
            cart.removeChild(items[i]);
            i--; // Adjust the loop counter after removing an item
        }
    }
}

function summarize() {
    var cartItems = document.getElementById('cart').getElementsByTagName('li');
    var termekSzamlalo = {};

    for (var i = 0; i < cartItems.length; i++) {
        var termekNeve = cartItems[i].getElementsByTagName('strong')[0].textContent;

        if (termekSzamlalo[termekNeve]) {
            termekSzamlalo[termekNeve]++;
        } else {
            termekSzamlalo[termekNeve] = 1;
        }
    }

    for (var termek in termekSzamlalo) {
        var termekElemek = document.querySelectorAll('li strong');
        for (var j = 0; j < termekElemek.length; j++) {
            if (termekElemek[j].textContent === termek) {
                termekElemek[j].innerHTML += '<br>Kosárban: ' + termekSzamlalo[termek];
            }
        }
    }
    removeDuplicates();
}

function prepareCart() {
    cart = getCartFromSession();
    var orderedIDs = cart.join(',');
    document.getElementById('ordered_products').value = orderedIDs;
}

function prepareCartList() {
    cart = getCartFromSession();
    prepare();
    summarize();
}

function loadCart() {
    cart = getCartFromSession();
}

function saveCartToSession() {
    sessionStorage.setItem('cart', JSON.stringify(cart));
}

function getCartFromSession() {
    var storedCart = sessionStorage.getItem('cart');
    return storedCart ? JSON.parse(storedCart) : [];

    
}

function snackbarAddedToCart() {
    // Get the snackbar DIV
    var x = document.getElementById("snackbar");
  
    // Add the "show" class to DIV
    x.className = "show";
  
    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
  }

