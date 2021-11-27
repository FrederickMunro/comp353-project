<?php require_once '../database.php';
$ran = false;
if(isset($_POST['nameOfFacility']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $statement = $conn->prepare('SELECT * 
                                 FROM gnc353_2.Appointments 
                                 WHERE nameOfFacility = :nameOfFacility AND timeSlot > :startDate AND timeSlot < :endDate;');

    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statement->bindParam(':startDate', $_POST['startDate']);
    $statement->bindParam(':endDate', $_POST['endDate']);

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
            <label for='nameOfFacility'>Facility Name</label> <br>
                <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
            <label for='startDate'>Start Date</label> <br>
                <input type='datetime-local' name='startDate' id='startDate'> <br>
            <label for='endDate'>End Date</label> <br>
                <input type='datetime-local' name='endDate' id='endDate'> <br>
            <button type='submit'>Submit</button> <br>
        </form>
        <a href='../'>Return to menu</a>
    <?php } else { ?>
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
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
    <?php } ?>
</body>
</html>