<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');
$sql = "Select * from user where user_name = '" . $_POST["username"] . "'";

if($pdo->query($sql)->rowCount() == 0){
    if ($_POST["pw"] == $_POST["pw2"]) {
        $_SESSION["username"] = $_POST["username"];
        $statement = $pdo->prepare("INSERT INTO user (user_name, password) VALUES (?,?)");
        $statement->execute(array($_POST["username"],$_POST["pw"]));
        $_SESSION["registerState"] = 0;
        header("Location:create.php");
    } else {
        $_SESSION["registerState"] = 2;
        header("Location:register.php");
    }
}else{
    $_SESSION["registerState"] = 1;
    header("Location:register.php");
}