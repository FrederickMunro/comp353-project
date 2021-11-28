<?php require_once '../database.php';

$statement = $conn->prepare('SELECT  PublicHealthWorker.firstName,  PublicHealthWorker.lastName, People.telephone, count(publicHealthWorkerID) AS VaccinesGiven
                             FROM People, Vaccination
                             INNER JOIN PublicHealthWorker ON PublicHealthWorker.employeeID = Vaccination.publicHealthWorkerID
                             WHERE PublicHealthWorker.firstName = People.firstName AND PublicHealthWorker.typeOfWorker = "Nurse"
                             GROUP BY publicHealthWorkerID
                             ORDER BY vaccinesGiven DESC;');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nurses Report</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Nurses Report List</h1>
    <table>
        <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Phone Number</td>
                <td>Number of Vaccines Given</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                    <td><?= $row['telephone'] ?></td>
                    <td><?= $row['VaccinesGiven'] ?></td>
                    <td>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
</body>
</html>