<?php require_once '../database.php';
$ran = false;
$ranTwo = false;
$noRecords = false;
if(isset($_POST['nameOfFacility']) && isset($_POST['requestedDate'])) {
    $statement = $conn->prepare('SELECT PublicHealthWorker.firstName, PublicHealthWorker.lastName, PublicHealthWorker.typeOfWorker, WorkSchedule.dayOfWeek
                                 FROM PublicHealthWorker
                                 INNER JOIN WorkSchedule ON PublicHealthWorker.employeeID = WorkSchedule.publicHealthWorkerID
                                 Where PublicHealthWorker.nameOfFacility = :nameOfFacility AND WorkSchedule.dayOfWeek = :requestedDate;');

    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statement->bindParam(':requestedDate', $_POST['requestedDate']);

    if($statement->execute())
        if($statement->rowCount() > 0)
            $ran = true;
        else{
            $ran = true;
            $noRecords = true;
        }

    $statementTwo = $conn->prepare('SELECT * FROM Appointments
                                    WHERE nameOfFacility = :nameOfFacility AND timeSlot > :morningTime AND timeSlot < :nightTime AND firstName IS NOT NULL;');

    $morning = strtotime($_POST['requestedDate']);
    $morningTime = date('Y-m-d 00:00:00',$morning);

    $night = strtotime($_POST['requestedDate']);
    $nightTime = date('Y-m-d 23:59:00',$night);
   

    $statementTwo->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statementTwo->bindParam(':morningTime', $morningTime);
    $statementTwo->bindParam(':nightTime', $nightTime);


    if($statementTwo->execute())
        $ranTwo = true;
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
            <label for='nameOfFacility'>Facility Name</label> <br>
                <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
            <label for='requestedDate'>Date</label> <br>
                <input type='date' name='requestedDate' id='requestedDate'> <br>
            <button type='submit'>Submit</button> <br>
        </form>
        <a href='../'>Return to menu</a>
    <?php } else if($noRecords == true) { ?>
        <h1>No Records Found!</h1>
        <a href='../'>Return to menu</a>
    <?php } else { ?>
    <h1>Worker Schedule</h1>
    <table>
        <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Position</td>
                <td>Date</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                    <td><?= $row['typeOfWorker'] ?></td>
                    <td><?= $row['dayOfWeek'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <h1>Appointment Schedule</h1>
    <table>
        <thead>
            <tr>
                <td>Facility Name</td>
                <td>Time Slot</td>
                <td>First Name</td>
                <td>Last Name</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statementTwo->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['nameOfFacility'] ?></td>
                    <td><?= $row['timeSlot'] ?></td>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
    <?php } ?>
</body>
</html>