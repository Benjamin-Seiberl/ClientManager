<?php
session_start();
if (isset($_POST["username"])) {
    $pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');
    $sql = "Select * from user where user_name = '" . $_POST["username"] . "'";
    $sql = $pdo->query($sql);
    if ($sql->rowCount() == 0) {
        $_SESSION["loginState"] = 1;
        header("Location:index.php") ;
    } else {
        if ($_POST["pw"] === $sql->fetch()["password"]) {
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["loginState"] = 0;
            header("Location:create.php");
        } else {
            $_SESSION["loginState"] = 2;
            header("Location:index.php") ;
        }
    }

}