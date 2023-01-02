<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kundenverwaltung</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<main class="d-flex flex-column justify-content-center align-items-center pt-5 w-25 m-auto">
    <?php
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');
    $sql = "SELECT * FROM client join company on client.company_id = company.company_id join contactperson on client.contactperson_id = contactperson.contactperson_id join user on client.user_id = user.user_id where client_id = '" . $_POST["client_id"] . "'";
    $row = $pdo->query($sql)->fetch();
    if (strtoupper($row["user_name"]) != strtoupper($_SESSION["username"])){
        $_SESSION["editState"] = 1;
        header("Location:create.php");
    }else
    ?>
    <image class="m-auto w-50" src="img/i.jpg" alt="company logo"></image>
    <form action="update.php" method="post" class="d-flex">
        <section class="d-flex flex-column">
            <input class="d-none" type="text" name="client_id" value="<?php echo $row['client_id'] ?>">
            <input class="d-none" type="text" name="company_id" value="<?php echo $row['company_id'] ?>">
            <label>Company name:</label>
            <input class="mb-4" type="text" name="company_name" placeholder="company name"
                   value="<?php echo $row['company_name'] ?>" required>
            <input class="d-none" name="contactperson_id" value="<?php echo $row['contactperson_id'] ?>">
            <label>Contact person name:</label>
            <input class="mb-4" type="text" name="contact_person" placeholder="contact person"
                   value="<?php echo $row['contactperson_name'] ?>" required>
            <label>Phone number:</label>
            <input class="mb-4" type="tel" name="phone" placeholder="phone number" value="<?php echo $row['phone'] ?>"
                   required>
            <label>Address:</label>
            <input class="mb-4" type="text" name="address" placeholder="address" value="<?php echo $row['adress'] ?>"
                   required>
            <input class="d-none mb-4" type="text" name="edited_at" value="<?php echo date('Y-m-d', time()) ?>"
                   required>
            <label class="text-white">-------------</label>
            <button class="mb-2" type="submit" name="submit">update client</button>
            <form class="" action="createClient.php">
                <button class="" type="submit" name="submit">Cancel</button>
            </form>
        </section>
    </form>


</main>
</body>
</html>
