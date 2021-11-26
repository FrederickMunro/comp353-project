<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.VaccinationFacility AS VaccinationFacility');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Facilities</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Vaccination Facility List</h1>
    <table>
        <thead>
            <tr>
                <td>Manager ID</td>
                <td>Facility Name</td>
                <td>Operating Hours</td>
                <td>Address</td>
                <td>Phone Number</td>
                <td>Type of Facility</td>
                <td>Capacity</td>
                <td>Appointsments/WalkIn</td>
                <td>Web Address</td>
                <td>Number of Workers</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['managerID'] ?></td>
                    <td><?= $row['nameOfFacility'] ?></td>
                    <td><?= $row['operatingHours'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['typeOfFacility'] ?></td>
                    <td><?= $row['capacity'] ?></td>
                    <td><?= $row['appointmentWalkIn'] ?></td>
                    <td><?= $row['webAddress'] ?></td>
                    <td><?= $row['numberOfWorkers'] ?></td>
                    <td>
                        <a href='./edit.php?nameOfFacility=<?= $row['nameOfFacility'] ?>'>Edit</a>
                        <a href='./delete.php?nameOfFacility=<?= $row['nameOfFacility'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>