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
    <image class="m-auto w-30" src="img/i.jpg" alt="company logo"></image>
    <form action="registerUser.php" method="post" class="d-flex w-75 m-auto flex-column px-5 gap-1 ">
        <input type="text" name="username" placeholder="username" required>
        <input type="password" name="pw" placeholder="Password" required>
        <input type="password" name="pw2" placeholder="Password" required>
        <button class="mt-3" type="submit" name="submit">Register</button>
        <a class="d-flex justify-content-center mt-2" href="index.php">back to login</a>
    </form>

    <?php
    if (isset($_SESSION["registerState"])) {
        if ($_SESSION["registerState"] == 1) {
            echo "<p class ='d-flex justify-content-center mt-5'>Username already in use!</p>";
        } else if ($_SESSION["registerState"] == 2) {
            echo "<p class ='d-flex justify-content-center mt-5'>Passwords do not match!</p>";
        }
    }
    ?>


</main>
</body>
</html>

