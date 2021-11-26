<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.Appointments');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
<body>
    <h1>Appointment List</h1>
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
                    <td>
                        <a href='./edit.php?nameOfFacility=<?= $row['nameOfFacility'] ?>&timeSlot=<?= $row['timeSlot'] ?>'>Edit</a>
                        <a href='./delete.php?nameOfFacility=<?= $row['nameOfFacility'] ?>&timeSlot=<?= $row['timeSlot'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>