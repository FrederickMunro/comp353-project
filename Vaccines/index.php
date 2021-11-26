<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.Vaccines AS Vaccines');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccines</title>
</head>
<body>
    <h1>Vaccines List</h1>
    <table>
        <thead>
            <tr>
                <td>Vaccine Name</td>
                <td>Vaccine Status</td>
                <td>Approval Date</td>
                <td>Suspension Date</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['vaccineType'] ?></td>
                    <td><?= $row['statusOfVaccine'] ?></td>
                    <td><?= $row['dateOfApproval'] ?></td>
                    <td><?= $row['suspensionDate'] ?></td>
                    <td>
                        <a href='./edit.php?vaccineType=<?= $row['vaccineType'] ?>&statusOfVaccine=<?= $row['statusOfVaccine'] ?>'>Edit</a>
                        <a href='./delete.php?vaccineType=<?= $row['vaccineType'] ?>&statusOfVaccine=<?= $row['statusOfVaccine'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>