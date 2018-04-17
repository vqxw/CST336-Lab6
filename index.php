<?php
    session_start();
    include 'functions.php';
    include 'database.php';
 
 if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
 }
 
 
 if (isset($_POST['itemName'])){
        $newItem = array();
        $newItem['name'] = $_POST['itemName'];
        $newItem['itemId'] = $_POST['itemId'];
        $newItem['price'] = $_POST['itemPrice'];
        $newItem['image'] = $_POST['itemImage'];
        
        //$found = false;
        
        foreach($_SESSION['cart'] as &$item){
            if($newItem['itemId'] == $item['itemId']){
                $item['quantity'] += 1;
                $found = true;
            }
        }
        
        if($found != true){
            
            $newItem['quantity'] = 1;
            array_push($_SESSION['cart'], $newItem);
        }
    }
 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <title>Products Page</title>
    </head>
    <body>
    <div class='container'>
        <div class='text-center'>
            
            <!-- Bootstrap Navagation Bar -->
            <nav class='navbar navbar-default - navbar-fixed-top'>
                <div class='container-fluid'>
                    <div class='navbar-header'>
                        <a class='navbar-brand' href='#'>Shopping Land</a>
                    </div>
                    <ul class='nav navbar-nav'>
                        <li><a href='index.php'>Home</a></li>
                        <li><a href='scart.php'>
                        <span class= 'glyphicon glyphicon-shopping-cart' aria-hidden= 'true'>
                        </span>Cart: <?php displayCartCount();?></a></li>
                    </ul>
                </div>
            </nav>
            <br /> <br /> <br />
            
            <!-- Search Form -->
            <form enctype="text/plain">
                <div class="form-group1">
                    <label for="pName1">Product Name</label>
                    <input type="text" class="form-control" name="query" id="pName" placeholder="Name">
                    <select  name="category">
                        <?php echo getCategoriesHTML(); ?>
                    </select>
                    
                    <br/>
                    Price:  
                    From: <input type="text" name="price-from" />
                    To: <input type="text" name="price-to" />
                    <br/>
                    Order Results by: 
                    <input type="radio" name="ordering" value="product"> Product 
                    <input type="radio" name="ordering" value="price"> Price
                    <br/>
                    <input name="show-images" type="checkbox"> Display Images
                    <br/>
                    
                </div>
                <input type="submit" value="Submit" class="btn btn-default">
                <br /><br />
            </form>


            <!-- Display Search Results -->
            <?php
                if (isset($_GET["category"]) && !empty($_GET["category"])) {
                    $category = $_GET["category"]; 
                }
                
                if (isset($_GET["price-from"]) && !empty($_GET["price-from"])) {
                    $priceFrom =  $_GET["price-from"]; 
                }
                
                if (isset($_GET["price-to"]) && !empty($_GET["price-to"])) {
                    $priceTo = $_GET["price-to"];
                }
                
                if (isset($_GET["ordering"]) && !empty($_GET["ordering"])) {
                    $ordering = $_GET["ordering"];
                }
                
                if (isset($_GET["show-images"]) && !empty($_GET["show-images"])) {
                    $showImages = $_GET["show-images"];
                }
                
                if (isset($_GET['query'])) {
                    $items = getMatchingItems($_GET['query'], $category, $priceFrom, $priceTo, $ordering, $showImages);
                }
            
                displayResults();
    
            ?>
            
        </div>
    </div>
   </body>
</html>