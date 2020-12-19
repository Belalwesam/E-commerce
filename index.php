<?php
$msg = '';
//Start the session 
session_start();
//connecting to the database
include('db.php');
//creating the account
if (isset($_POST['create'])) {
    //retrieving data from the submitted create account form 
    $fullName = $_POST['fullName'];
    $address = $_POST['Address'];
    $login = $_POST['createlogin'];
    $password = $_POST['createpassword'];
    $cardNumber = $_POST['cardNumber'];
    $query = "INSERT INTO customers (name , address , login , password , cardNumber ) VALUES ('$fullName' , '$address' , '$login' , '$password' , 1000);";
    mysqli_query($conn, $query);
}

if (isset($_POST['login'])) {
    $loginName = $_POST['username'];
    $loginPassword = $_POST['password'];
    $query = "SELECT login , password , id FROM customers WHERE login = '$loginName' AND password = '$loginPassword';";
    $result = mysqli_query($conn, $query);
    $customre = mysqli_fetch_assoc($result);
    if (empty($customre)) {
        $msg = '<p style="color: red;">*Login/password is incorrect .</p>';
    } else {
        header('Location: store.php?id=' . $customre['id']);
    }
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
    <link rel="stylesheet" href="home.css">
    <title>Welcome</title>
</head>
<body>
    <div class="container text-center text-primary">
        <h1 class="my-5">Welcome to Beem Store</h1>
        <p class="lead">Please choose one of the follwoing</p>
        <div class="my-4">
            <button class="btn btn-outline-primary px-4" id="loginBtn">Log In</button>
            <button class="btn btn-outline-primary" id="createBtn">Create Account</button>
        </div>
    </div>
    <div class="login <?php if ($msg != '') : ?>
                               <?php echo 'show'; ?>
                            <?php endif; ?>" id="login">
        <span class="closeBtn" id="closeBtn">X</span>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 offset-md-4">
                    <form action="index.php" method="post" id="form">
                        <?php if ($msg != '') : ?>
                            <?php echo $msg ?>
                        <?php endif; ?>
                        <div class="form-group">
                            <label>Log in</label>
                            <input type="text" name="username" class="form-control" placeholder="Log in" id="loginName">
                        </div>
                        <div class="form-group mb-4">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Your password" id="loginPas">
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Log in" name="login" id="loginSubmit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="createAccount login" id="createAccount">
        <span class="closeBtn" id="closeAccountBtn">X</span>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 offset-md-4">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="createForm">
                        <div class="form-group">
                            <input type="text" name="fullName" class="form-control" id="nameCreate" placeholder="Full name">
                            <small style="color:#fff; display:none;" id="namesmall">*Must be only letters and spaces</small>
                        </div>
                        <div class="form-group">
                            <input type="text" name="Address" class="form-control" id="Address" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <input type="text" name="createlogin" class="form-control" id="createlogin" placeholder="Log in">
                            <small style="color:#fff; display:none;" id="loginsmall">*Please choose at max a 5 letters Log in</small>
                        </div>
                        <div class="form-group">
                            <input type="password" name="createpassword" class="form-control" id="passwordCreate" placeholder="Password">
                            <small style="color:#fff; display:none;" id="passwordsmall">*Must be at least 8 charecters long</small>
                        </div>
                        <div class="form-group">
                            <input type="password" name="createRepassword" class="form-control" id="repasswordCreate" placeholder="Re-type Password">
                            <small style="color:#fff; display:none;" id="resmall">*Passwords don't match</small>
                        </div>
                        <div class="form-group">
                            <input type="text" name="cardNumber" class="form-control" id="cardNumber" placeholder="Credit Card Number">
                            <small style="color:#fff; display:none;" id="cardshow">*Enter the 10 digits of your credit card number</small>
                        </div>
                        <input type="submit" name="create" value="Create Account" class="btn btn-primary btn-block" id="createSubmit">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--bootstrap CDN-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!--Bootstrap compiled javascript-->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="home.js" type="text/javascript"></script>
</body>
</html>