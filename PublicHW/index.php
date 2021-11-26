<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.PublicHealthWorker AS PublicHealthWorker');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Public Health Workers</title>
</head>
<body>
    <h1>Public Health Worker List</h1>
    <table>
        <thead>
            <tr>
                <td>Employee ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>SSN</td>
                <td>Facility Name</td>
                <td>Job</td>
                <td>Hourly Wage</td>
                <td>Start Date</td>
                <td>End Date</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['employeeID'] ?></td>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                    <td><?= $row['SSN'] ?></td>
                    <td><?= $row['nameOfFacility'] ?></td>
                    <td><?= $row['typeOfWorker'] ?></td>
                    <td><?= $row['hourlyWage'] ?></td>
                    <td><?= $row['startDate'] ?></td>
                    <td><?= $row['endDate'] ?></td>
                    <td>
                        <a href='./edit.php?employeeID=<?= $row['employeeID'] ?>&nameOfFacility=<?= $row['nameOfFacility'] ?>&startDate=<?= $row['startDate'] ?>'>Edit</a>
                        <a href='./delete.php?employeeID=<?= $row['employeeID'] ?>&nameOfFacility=<?= $row['nameOfFacility'] ?>&startDate=<?= $row['startDate'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>