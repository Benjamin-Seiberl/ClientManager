<?php

$pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');
$sql = "UPDATE company SET company_name=? WHERE company_id=?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_POST["company_name"], $_POST["company_id"]]);
$sql = "UPDATE contactperson SET contactperson_name=?, phone=?, adress=? WHERE contactperson_id=?";
$stmt= $pdo->prepare($sql);
$stmt->execute([$_POST["contact_person"], $_POST["phone"],$_POST["address"], $_POST["contactperson_id"]]);
$sql = "UPDATE client SET edited_at=? WHERE client_id=?";
$stmt= $pdo->prepare($sql);
$stmt->execute([date('Y-m-d', time()), $_POST["client_id"]]);
header("Location:create.php");