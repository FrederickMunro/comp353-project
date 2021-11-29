<?php require_once '../database.php';
$ran = false;
if(isset($_POST['nameOfFacility']) && isset($_POST['requestedDate'])) {
    $statement = $conn->prepare('SELECT PublicHealthWorker.employeeID ,PublicHealthWorker.firstName, PublicHealthWorker.lastName, People.email ,PublicHealthWorker.hourlyWage
                                 FROM PublicHealthWorker
                                 INNER JOIN People ON PublicHealthWorker.firstName = People.firstName
                                 INNER JOIN WorkSchedule ON PublicHealthWorker.employeeID = WorkSchedule.publicHealthWorkerID
                                 Where PublicHealthWorker.typeOfWorker = "Nurse" AND PublicHealthWorker.nameOfFacility = :nameOfFacility AND WorkSchedule.dayOfWeek != :requestedDate
                                 GROUP BY employeeID
                                 ORDER BY hourlyWage ASC;');

    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
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
    <title>Nurses Schedule</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php if($ran == false){ ?>
        <h1>Nurses Schedule</h1>
        <form action='./index.php' method='post'>
            <label for='nameOfFacility'>Facility Name</label> <br>
                <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
            <label for='requestedDate'>Date</label> <br>
                <input type='date' name='requestedDate' id='requestedDate'> <br>
            <button type='submit'>Submit</button> <br>
        </form>
        <a href='../'>Return to menu</a>
    <?php } else { ?>
    <h1>Nurses Schedule</h1>
    <table>
        <thead>
            <tr>
                <td>Employee ID</td>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Email</td>
                <td>Hourly Wage</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['employeeID'] ?></td>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['hourlyWage'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
    <?php } ?>
</body>
</html>