var cart = [];
var summaryHTML = "";
// [ ] - Magyar változónevek átírása
// [ ] - Cleanup
// [x] - Terméknév észlelés class alapján


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

    xhr.onreadystatechange = function () {
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
        item.innerHTML = '<div class="cartitem">' +
        '<img src="' + data[i].image_url + '" alt="Kép" class="thumbnailPr">' +
        '<div class="row">' +
        '    <div class="col-lg-8">' +
        '        <p class="productname">'+ data[i].brand +'  <strong>'+ data[i].name +'</strong></p>' +
        '        <p class="productid">#'+ data[i].product_id +'</p>' +
        '        <p class="productprice">'+ data[i].price +' Ft</p>' +
        '    </div>' +
        '    <div class="col-lg-4">' +
        '        <div class="pr-btns-container">' +
        '            <input type="number" value="1" class="quantity" onchange="updateTotal()">' +
        '            <button type="button" class="btn btn-danger" onclick="removeFromCart(' + data[i].product_id + ')"><i class="fa fa-trash-o"></i></button>' +
        '        </div>' +
        '    </div>' +
        '</div>' +
        '</div>';
        productList.appendChild(item);
    }
    summarize();
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
    updateTotal();
}

function summarize() {
    var cartItems = document.getElementById('cart').getElementsByTagName('li');
    var termekSzamlalo = {};

    for (var i = 0; i < cartItems.length; i++) {
        var termekNeve = cartItems[i].getElementsByClassName('productname')[0].textContent;
        //alert(termekNeve)

        if (termekSzamlalo[termekNeve]) {
            termekSzamlalo[termekNeve]++;
        } else {
            termekSzamlalo[termekNeve] = 1;
        }
    }

    for (var termek in termekSzamlalo) {
        var cartItems = document.querySelectorAll('.cartitem');

        cartItems.forEach(function (cartItem) {
            if (cartItem.querySelector(".productname").textContent == termek) {
                var numberInput = cartItem.querySelector('input[type="number"]');
                //alert(numberInput.value);
                numberInput.value = termekSzamlalo[termek];
            }
        });
        //for (var j = 0; j < termekElemek.length; j++) {
        //    if (termekElemek[j].textContent === termek) {
        //        termekElemek[j].innerHTML += '<br>Kosárban: ' + termekSzamlalo[termek];
        //    }
        //}
    }
    removeDuplicates();
}

function prepareCart() {
    cart = getCartFromSession();
    var orderedIDs = cart.join(',');
    document.getElementById('ordered_products').value = orderedIDs;
    getSummary();
}

function prepareCartList() {
    cart = getCartFromSession();
    prepare();

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
    setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
}

function updateTotal() {
    var totalAmount = 0;
    var items = document.querySelectorAll('#cart .cartitem');

    items.forEach(function (item) {
        var priceText = item.querySelector('.productprice').textContent;
        var price = parseFloat(priceText.split(' ')[0]); // Kivonja az árat a szövegből
        var quantity = parseInt(item.querySelector('.quantity').value);
        var itemTotal = price * quantity;
        totalAmount += itemTotal;
    });

    document.getElementById('totalAmount').textContent = totalAmount.toFixed(2);
    updateCartList();
}

function gatherProductIds() {
    var productIds = [];
    var quantityInputs = document.querySelectorAll('.quantity');

    quantityInputs.forEach(function (input) {
        var productId = input.parentElement.parentElement.parentElement.querySelector('.productid').textContent;
        productId = productId.replace("#", "");
        var quantity = parseInt(input.value);

        // Az adott termékazonosítót annyiszor adjuk hozzá a listához, amennyi a quantity értéke
        for (var i = 0; i < quantity; i++) {
            productIds.push(parseInt(productId));
        }
    });

    console.log(productIds);
    return productIds;
}

function updateCartList() {
    cart = gatherProductIds();
    saveCartToSession();
}

function removeFromCart(item) {
    cart = getCartFromSession();
    for (var i = 0; i < cart.length; i++) {
        if (cart[i] == item) {
            delete cart[i];
        }
    }
    prepare();
}

function makeSummary() {
    var cartItems = document.querySelectorAll('.cartitem');
    summaryHTML = "";
    var totalAmount = 0;

    cartItems.forEach(function(item) {
      var productName = item.querySelector('.productname').textContent;
      var productID = item.querySelector('.productid').textContent;
      var quantity = parseInt(item.querySelector('.quantity').value);
      var price = parseFloat(item.querySelector('.productprice').textContent.split(' ')[1]);
      var imageURL = item.querySelector('.thumbnailPr').src;

      var itemTotal = quantity * price;
      totalAmount += itemTotal;

      summaryHTML += '<li>';
      summaryHTML += '<p><strong>Termék neve:</strong> ' + productName + '</p>';
      summaryHTML += '<p><strong>Termék azonosító:</strong> ' + productID + '</p>';
      summaryHTML += '<p><strong>Mennyiség:</strong> ' + quantity + '</p>';
      summaryHTML += '<p><strong>Ár:</strong> ' + itemTotal + ' Ft</p>';
      summaryHTML += '<img src="' + imageURL + '" alt="Termék kép" style="max-width: 100px; max-height: 100px;">';
      summaryHTML += '</li>';
    });

    summaryHTML += '</ul>';
    summaryHTML += '<p><strong>Összesen:</strong> ' + totalAmount + ' Ft</p>';
    alert(summaryHTML);
    saveSummaryToSession(summaryHTML);
}

function saveSummaryToSession(data) {
    sessionStorage.setItem('summary', JSON.stringify(data));
}

function getSummary() {
    var summary = JSON.parse(sessionStorage.getItem('summary'));
    alert(summary);
    document.getElementById('summary').value = summary;
}

function goToCheckout() {
    makeSummary();
    window.location.href = "checkout.html"
}