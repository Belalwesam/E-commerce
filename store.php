<?php
//starting the session
session_start();

//including the database
include('db.php');

//to display the amount of money
$id = $_GET['id'];

$queryAmount = "SELECT cardNumber from customers WHERE id = '$id'";
$resultAmount = mysqli_query($conn, $queryAmount);
$amount = mysqli_fetch_assoc($resultAmount);

///to display the products
$query = "SELECT * from products";
$result = mysqli_query($conn, $query);
$products = mysqli_fetch_all($result, MYSQLI_ASSOC);

//when checking out
if (isset($_POST['checkout'])) {
    $_SESSION['moneySpent'] = $_POST['hidden'];
    $_SESSION['account'] = $_POST['account'];
    header('Location: checkout.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" media="screen">
    <!--Custome CSS-->
    <link rel="stylesheet" href="store.css">
    <title>Beem Store</title>
</head>
<body>
    <div class="cart btn btn-warning btn-lg">Cart (<span id="cart-counter">0</span>)</div>
    <form method="post" action="store.php" id="float-form">
        <input type="hidden" id="hidden" name="hidden" value = 0>
        <input type="hidden" name="account" value= <?php echo $id; ?>>
        <input type="submit" value="checkout" class="btn btn-success btn-lg" id="checkout" name="checkout">
    </form>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="#">Beem Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Current balance : $<span id="amount" data-balance = <?php echo $amount['cardNumber'];?> ><?php echo $amount['cardNumber'];?></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Log out</a>
                </li>
            </ul>
        </div>
    </nav>
    <section id="store" class="my-5 py-5">
        <div class="container">
            <h1 class="text-center text-primary">Feel free to check our products below</h1>
            <div class="row my-5">
                <?php foreach ($products as $product) : ?>
                    <div class="col-12 col-md-4 my-4 py-2">
                        <div class="border">
                            <div class="product-image text-center mb-2">
                                <img src="<?php echo $product['image']; ?>" alt="Not There" class="img-fluid">
                            </div>
                            <div class="product-info text-center">
                                <h6 class="list-group-item product-title text-primary"><?php echo $product['title']; ?></h6>
                                <h5 class="list-group-item text-primary">$<?php echo $product['price']; ?></h5>
                                <button class="btn btn-outline-primary mb-3 addToCartBtn" id="addtocartBtn" data-price=<?php echo $product['price']; ?>>Add to cart</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!--Bootstrap compiled javascript-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--Custome JS-->
    <script src="store.js" type="text/javascript"></script>
</body>
</html>