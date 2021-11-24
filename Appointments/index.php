<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2/Tables/Appointments');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>Facility</td>
                <td>Time Slot</td>
                <td>First Name</td>
                <td>Last Name</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['nameOfFacility'] ?></td>
                    <td><?= $row['timeSlot'] ?></td>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>