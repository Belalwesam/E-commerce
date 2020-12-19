<?php
session_start();
//incdluing the data base
include('db.php');

//getting the amount of money spent on buying things
$moneySpent = $_SESSION['moneySpent'];

//getting the id og the user 
$id = $_SESSION['account'];

//getting the current balance
$query = "SELECT * from customers WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$currentBalance = mysqli_fetch_assoc($result);
//changing the current balance to new balance (after purchasing)
$newBalance =  $currentBalance['cardNumber'] - $moneySpent;

//when checking out
if(isset($_POST['submit'])) {
    $updateQuery = "UPDATE customers SET cardNumber = '$newBalance'";
    mysqli_query($conn , $updateQuery);
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" media="screen">
    <title>Checkout Page</title>
</head>
<body>
    <div class="container text-center">
        <h1 class="text-primary mt-5">Thank you <?php echo $currentBalance['name']; ?> for shopping at Beem Store.</h1>
        <h3 class="text-primary my-5">You've purchased items for $<?php echo $moneySpent; ?></h3>
        <h5 class="text-primary">Your items will be shipped to the the Address :</h5>
        <h4 class="text-primary my-4"><?php echo $currentBalance['address']; ?></h4>
        <form action="checkout.php" method="POST">
            <input type="submit" class="btn btn-outline-primary btn-lg" value="Proceed Checkout" name="submit">
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!--Bootstrap compiled javascript-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>