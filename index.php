<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kundenverwaltung</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<main class="d-flex flex-column justify-content-center w-25 m-auto">


    <?php
    session_start();
    ?>
    <image class="m-auto w-30 pt-5" src="img/i.jpg" alt="company logo"></image>
    <form action="login.php" method="post" class="d-flex w-75  m-auto flex-column px-5 gap-1">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="pw" placeholder="Password" required>
        <button class="mt-3" type="submit" name="submit">Login</button>
        <a class="d-flex justify-content-center mt-2" href="register.php">register new user</a>
    </form>

    <?php
    if (isset($_SESSION["loginState"])) {
        if ($_SESSION["loginState"] == 1) {
            echo "<p class ='d-flex justify-content-center mt-5'>Username not found!</p>";
        } else if ($_SESSION["loginState"] == 2) {
            echo "<p class ='d-flex justify-content-center mt-5'>Wrong Password!</p>";
        }
    }
    ?>


</main>
</body>
</html>

