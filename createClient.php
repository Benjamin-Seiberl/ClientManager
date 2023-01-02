<?php
session_start();

$pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');

$statement = $pdo->prepare("INSERT INTO company (company_name) VALUES (?)");
$statement->execute(array($_POST["company_name"]));
$statement = $pdo->prepare("INSERT INTO contactperson (contactperson_name,phone,adress) VALUES (?,?,?)");
$statement->execute(array($_POST["contact_person"], $_POST["phone"], $_POST["address"]));

$company_id = $pdo->query("Select company_id from company where company_name = '" .$_POST["company_name"]. "'");
$contactperson_id = $pdo->query("Select contactperson_id from contactperson where contactperson_name = '" .$_POST["contact_person"]. "'");
$user_id = $pdo->query("Select user_id from user where user_name = '".$_SESSION["username"]."'");
$statement = $pdo->prepare("INSERT INTO client (company_id ,contactperson_id,user_id, created_at, edited_at) VALUES (?,?,?,?,?)");
$statement->execute(array($company_id->fetch()["company_id"],$contactperson_id->fetch()["contactperson_id"], $user_id->fetch()["user_id"], date('Y-m-d', time()) , date('Y-m-d', time()) ));
header("Location:create.php");