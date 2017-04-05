<?php
    $LoginFailMessage = '';

    if (isset($_SESSION['userFullName'])) {
        header('Location: origin.php');
    } elseif (isset($_POST['submit'])) {
        include_once 'dbcom/connect.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM user WHERE username = '$username' AND accesskey = '$password'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            session_start();
            $row = $result->fetch_assoc();
            $_SESSION['userFullName'] = $row['fullname'];
            $_SESSION['id'] = $row['id'];
            header('Location: origin.php');
        } else {
            $LoginFailMessage = '<br><span style="color: red; box-sizing: border-box; padding: 0 20px;">Invalid username or password!</span>';
        }
    }
?>
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>LOGIN MIST HPTB</title>
    <link rel='stylesheet prefetch' href='../contents/vendors/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="styles/login.css">

</head>

<body>
<div class="pen-title">
    <h1>Hydraulic Pump Testing Bench - MIST</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
    <div class="toggle"><i class="fa fa-times fa-plus"></i></div>
    <div class="form">
        <h2>Login to the system</h2>
        <form action="" method="post" autocomplete="off">
            <input type="text" name="username" placeholder="username"/>
            <input type="password" name="password" placeholder="password"/>
            <button type="submit" name="submit" value="Login">Login</button>
        </form>
        <?=$LoginFailMessage?>
    </div>
    <div class="form">
        <h2>Create an account</h2><p>Please contact with administrator!</p>
    </div>
    <div class="cta"><a href="#">Forgot your password?</a></div>
</div>

<script src='../contents/vendors/jquery/3.1.0/jquery-3.1.0.min.js'></script>
<script src="scripts/login.js"></script>
</body>
</html>