<?php require_once '../database.php';

$statement = $conn->prepare('SELECT vf.nameOfFacility, address, typeOfFacility, capacity, numberOfWorkers, newTable.givenDoses, newTableTwo.futureVaccines
                             FROM VaccinationFacility vf, 
                                        (SELECT nameOfFacility, Count(nameOfFacility) AS givenDoses
                                         FROM Vaccination
                                         GROUP BY nameOfFacility) newTable,
                                        (SELECT nameOfFacility, count(nameOfFacility) AS futureVaccines
                                         FROM Appointments
                                         WHERE firstName IS NOT NULL AND timeSlot > :todaysDate
                                         GROUP BY nameOfFacility) AS newTableTwo
                             WHERE vf.nameOfFacility = newTable.nameOfFacility AND vf.nameOfFacility = newTableTwo.nameOfFacility
                             GROUP BY vf.nameOfFacility
                             ORDER BY givenDoses ASC;');

$todaysDate = date("Y-m-d H:i:s");

$statement->bindParam(':todaysDate', $todaysDate);


$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vaccination Facility Report</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Vaccination Facility List</h1>
    <table>
        <thead>
            <tr>
                <td>Facility Name</td>
                <td>Address</td>
                <td>Type of Facility</td>
                <td>Capacity</td>
                <td>Number of Workers</td>
                <td>Number of Vaccines Administered</td>
                <td>Number of Future Appointments</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['nameOfFacility'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['typeOfFacility'] ?></td>
                    <td><?= $row['capacity'] ?></td>
                    <td><?= $row['numberOfWorkers'] ?></td>
                    <td><?= $row['givenDoses'] ?></td>
                    <td><?= $row['futureVaccines'] ?></td>
                    <td>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
</body>
</html>