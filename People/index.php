<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.People');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>List of People</h1>
    <table>
        <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Middle Initial</td>
                <td>Date of Birth</td>
                <td>Medicare Card Number</td>
                <td>Medicare Issue Date</td>
                <td>Medicare Expiry Date</td>
                <td>Telephone</td>
                <td>Address</td>
                <td>City</td>
                <td>Province</td>
                <td>Postal Code</td>
                <td>Citizenship</td>
                <td>Email</td>
                <td>Passport Number</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                    <td><?= $row['middleInitial'] ?></td>
                    <td><?= $row['dateOfBirth'] ?></td>
                    <td><?= $row['medicareCardNumber'] ?></td>
                    <td><?= $row['issueDateOfMedicare'] ?></td>
                    <td><?= $row['expiryDateOfMedicare'] ?></td>
                    <td><?= $row['telephone'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['city'] ?></td>
                    <td><?= $row['Province'] ?></td>
                    <td><?= $row['postalCode'] ?></td>
                    <td><?= $row['citizenship'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['passportNumber'] ?></td>
                    <td>
                        <a href='./edit.php?firstName=<?= $row['firstName'] ?>&lastName=<?= $row['lastName'] ?>&middleInitial=<?= $row['middleInitial'] ?>'>Edit</a>
                        <a href='./delete.php?firstName=<?= $row['firstName'] ?>&lastName=<?= $row['lastName'] ?>&middleInitial=<?= $row['middleInitial'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>