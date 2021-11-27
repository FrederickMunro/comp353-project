<?php require_once '../database.php';
$ran = false;
if(isset($_POST['requestedDate'])) {
    $statement = $conn->prepare('SELECT vf.nameOfFacility, address, phone, capacity, operatingHours
                                 FROM VaccinationFacility vf
                                 LEFT JOIN WorkSchedule ws ON ws.nameOfFacility = vf.nameOfFacility AND dayOfWeek = :requestedDate 
                                 LEFT JOIN PublicHealthWorker phw ON phw.employeeID = ws.publicHealthWorkerID
                                 WHERE dayOfWeek IS NULL OR 
                                 NOT EXISTS(SELECT *
                                            FROM PublicHealthWorker phw
                                            LEFT JOIN WorkSchedule ws ON phw.employeeID = ws.publicHealthWorkerID
                                            WHERE dayOfWeek = :requestedDate AND typeOfWorker = "Nurse")
                                 GROUP BY vf.nameOfFacility;
');

    $statement->bindParam(':requestedDate', $_POST['requestedDate']);

    if($statement->execute())
        $ran = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php if($ran == false){ ?>
        <h1>Appointments</h1>
        <form action='./index.php' method='post'>
            <label for='requestedDate'>Date</label> <br>
                <input type='date' name='requestedDate' id='requestedDate'> <br>
            <button type='submit'>Submit</button> <br>
        </form>
        <a href='../'>Return to menu</a>
    <?php } else { ?>
    <h1>Appointment List</h1>
    <table>
        <thead>
            <tr>
                <td>Facility Name</td>
                <td>Address</td>
                <td>Phone Number</td>
                <td>Capacity</td>
                <td>Operating Hours</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['nameOfFacility'] ?></td>
                    <td><?= $row['address'] ?></td>
                    <td><?= $row['phone'] ?></td>
                    <td><?= $row['capacity'] ?></td>
                    <td><?= $row['operatingHours'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
    <?php } ?>
</body>
</html>