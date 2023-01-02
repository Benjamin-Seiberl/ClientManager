<?php
    session_start();

    $pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');
    $sql = "SELECT * FROM client join company on client.company_id = company.company_id join contactperson on client.contactperson_id = contactperson.contactperson_id join user on client.user_id = user.user_id where client_id = '" . $_POST["client_id"] . "'";
    $stmt = $pdo->query($sql);
    $row = $stmt->fetch();
    if (strtoupper($row["user_name"]) == strtoupper($_SESSION["username"])){
        $company_id = $row["company_id"];
        $contactperson_id = $row["contactperson_id"];
        $sql = "DELETE FROM client WHERE client_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST["client_id"]]);
        $sql = "DELETE FROM company WHERE company_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$company_id]);
        $sql = "DELETE FROM contactperson WHERE contactperson_id=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$contactperson_id]);
    }
    $_SESSION["editState"] = 2;
    header("Location:create.php");