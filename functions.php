<?php

function displayResults() {
    global $items;
    
    if (isset($items)) {
        echo "<table class = 'table'>";
        
        foreach ($items as $item) {
            $itemName = $item['name'];
            $itemPrice = $item['salePrice'];
            $itemImage = $item['thumbnailImage'];
            $itemId = $item['itemId'];
            
            // display items as table rows
            echo "<tr>";
            echo "<td> <img src = '$itemImage'></td>";
            echo "<td> <h4> $itemName</h4></td>";
            echo "<td> <h4> $itemPrice</h4></td>";
            
            // hidden input element containing the item name
            echo "<form method = 'post'>";
            echo "<input type = 'hidden' name = 'itemName' value = '$itemName'>";
            echo "<input type = 'hidden' name = 'itemId' value = '$itemId'>";
            echo "<input type = 'hidden' name = 'itemImage' value = '$itemImage'>";
            echo "<input type = 'hidden' name = 'itemPrice' value = '$itemPrice'>";
            
            //echo "<td> <button class = 'btn btn-warning'> Add </button> </td>";      
            // echo "</form>";
            
            if (isset($_POST['itemId']) && $_POST['itemId'] == $itemId) {
                echo '<td><button class = "btn btn-success">Added</button></td>';
            } else {
                echo '<td><button class = "btn btn-warning">Add</button></td>';
            }
            
            echo "</form>";
            
            echo "</tr>";
        }
        echo "</table>";
    }
}

function displayCart() {
    if(isset($_SESSION['cart'])) {
        echo "<table class = 'table'>";
        foreach($_SESSION['cart'] as $item) {
            $itemName = $item['name'];
            $itemPrice = $item['price'];
            $itemImage = $item['image'];
            $itemId = $item['id'];
            $itemQuant = $item['quantity'];
            
            // Display item as table row
            echo "<tr>";
            echo "<td><img src='$itemImage'></td>";
            echo "<td><h4>$itemName</h4></td>";
            echo "<td><h4>$itemPrice</h4></td>";
            echo "<td><h4>$itemQuant</h4></td>";
            // echo "</tr>";
            
            // hidden input element containing the item name
            echo '<form method = "post">';
            echo "<input type = 'hidden' name = 'itemId' value = '$itemId'>";
            echo "<td><input type = 'text' name = 'update' class = 'form-control' placeHolder = '$itemQuant'></td>";    
            echo '<td><button class = "btn btn-danger"> Update </button></td>';      
            echo '</form>';
            
            echo "<form method = 'post'>";
            echo "<input type = 'hidden' name = 'removeId' value = '$itemId'>";
            echo "<td><button class = 'btn btn-danger'> Remove </button> </td>";      
            echo "</form>";
            
            echo "</tr>";
        }
    
    echo "</table>";
    
    }
}

function displayCartCount() {
    echo count($_SESSION['cart']);
}

?>