<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Kundenverwaltung</title>
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
<main>
    <!-- create client -->
    <section class="d-flex flex-row">

        <section class="d-flex flex-column m-5 pt-2 gap-3">
            <image class="w-100" src="img/i.jpg" alt="company logo"></image>
            <div class="d-flex justify-content-between align-items-center">

                <label><?php
                    session_start();
                    echo "User: " . strtoupper($_SESSION["username"]) ?></label>
                <form action="index.php" method="post">
                    <button type="submit" name="submit">Logout</button>
                </form>
            </div>
            <form action="createClient.php" method="post" class="d-flex w-100 justify-content-center">
                <section class="d-flex flex-column gap-3 w-100">
                    <input type="text" name="company_name" placeholder="company name" required>
                    <input type="text" name="contact_person" placeholder="contact person" required>
                    <input type="tel" name="phone" placeholder="phone number" required>
                    <input type="text" name="address" placeholder="address" required>
                    <button class="" type="submit" name="submit">create client</button>
                </section>
            </form>
        </section>


        <section id="clientlist" class="w-100 mt-5 me-5 flex-fill border">
            <header class="d-flex border">
                <div class="col d-flex justify-content-center align-items-center">company id</div>
                <div class="col d-flex justify-content-center align-items-center">company name</div>
                <div class="col d-flex justify-content-center align-items-center">contact person</div>
                <div class="col d-flex justify-content-center align-items-center">phone number</div>
                <div class="col-2 d-flex justify-content-center align-items-center">adress</div>
                <div class="col d-flex justify-content-center align-items-center">created by</div>
                <div class="col d-flex justify-content-center align-items-center">created at</div>
                <div class="col d-flex justify-content-center align-items-center">edited at</div>
                <div class="mx-2 d-flex justify-content-center align-items-center text-decoration-underline text-white">
                    edit
                </div>
                <div class="mx-2 d-flex justify-content-center align-items-center text-decoration-underline text-white">
                    delete
                </div>
            </header>
            <?php
            try {
                $pdo = new PDO('mysql:host=localhost;dbname=kundenverwaltung', 'seiberl', '');
                $sql = "SELECT * FROM client join company on client.company_id = company.company_id join contactperson on client.contactperson_id = contactperson.contactperson_id join user on client.user_id = user.user_id";
                foreach ($pdo->query($sql) as $row) { ?>
                    <div class="d-flex border py-3">
                        <div class="col d-flex justify-content-center align-items-center"
                             name="company_id"><?php echo $row['company_id'] ?></div>
                        <div class="col d-flex justify-content-center align-items-center"><?php echo $row['company_name'] ?></div>
                        <div class="col d-flex justify-content-center align-items-center"><?php echo $row['contactperson_name'] ?></div>
                        <div class="col d-flex justify-content-center align-items-center"><?php echo $row['phone'] ?></div>
                        <div class="col-2 d-flex justify-content-center align-items-center"><?php echo $row['adress'] ?></div>
                        <div class="col d-flex justify-content-center align-items-center"><?php echo $row['user_name'] ?></div>
                        <div class="col d-flex justify-content-center align-items-center"><?php echo $row['created_at'] ?></div>
                        <div class="col d-flex justify-content-center align-items-center"><?php echo $row['edited_at'] ?></div>
                        <div class="mx-2 d-flex justify-content-center align-items-center text-decoration-underline">
                            <form action="edit.php" method="post" class="d-flex">
                                <input class="d-none" type="text" name="client_id"
                                       value="<?php echo $row['client_id'] ?>">
                                <input class="d-none" type="text" name="user"
                                       value="<?php echo $_SESSION['username'] ?>">
                                <button class="border-0 bg-white" type="submit" name="submit">edit</button>
                            </form>
                        </div>
                        <div class="mx-2 d-flex justify-content-center align-items-center text-decoration-underline">
                            <form action="delete.php" method="post" class="d-flex">
                                <input class="d-none" type="text" name="client_id"
                                       value="<?php echo $row['client_id'] ?>">
                                <input class="d-none" type="text" name="user"
                                       value="<?php echo $_SESSION['username'] ?>">
                                <button class="border-0 bg-white" type="submit" name="submit">delete</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            if (isset($_SESSION["editState"])) {
                if ($_SESSION["editState"] == 1) {
                    echo "<p class ='d-flex justify-content-end m-2'>You do not have permission to edit!</p>";
                } else if ($_SESSION["editState"] == 2) {
                    echo "<p class ='d-flex justify-content-end m-2'>You do not have permission to delete!</p>";
                }
                $_SESSION["editState"] = 0;
            }

            ?>

        </section>
    </section>

</main>
</body>
</html>